<?php
/**
 * User: dshibin
 * Date: 2019/12/30
 * Time: 17:29
 * Note: logging every log
 */

namespace DebugLog\Log;

use DebugLog\Helper\Configs;

class Log
{

    protected static $instance = null;
    protected $data = [];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * 返回初始化实例类
     * @return Log|null
     */
    public static function getInstance(): ?Log
    {
        if (self::$instance instanceof self && !empty(self::$instance)) {
            return self::$instance;
        }
        return self::$instance = new self();
    }

    /**
     * 记录对应的信息
     * @param string $name
     * @param $log
     * @param $st
     * @param $ed
     * @param $data
     * @return bool|null
     */
    public function Log(string $name, $log, $st, $ed, $data): ?bool
    {
        if ($this->_checkAuth() && $this->_checkLevel($name)) {
            $this->data[$name][] = [
                'time' => $this->_time($st, $ed),
                'log' => $log,
                'data' => $data,
            ];
            return true;
        }
        return false;
    }

    /**
     * 记录堆栈信息
     * @return bool
     */
    public function LogStrace(): ?bool
    {
        foreach (array_slice(debug_backtrace(), -intval(Configs::getInstance()->get('debug_strace_num'))) as $strace) {
            if (!$this->Log('strace', 'strace', 0, 0, $strace)) {
                return false;
            }
        }
        return true;
    }

    /**
     * 获取日志信息
     * @return array
     */
    public function getLog(?string $logtype = null)
    {
        $this->LogStrace();
        return (!empty($logtype) && $this->data[$logtype]) ? $this->data[$logtype] : $this->data;
    }

    /**
     * 计算两个时间差
     * @param $st microtime返回的值
     * @param $ed microtime返回的值
     * @return float
     */
    protected function _time($st, $ed)
    {
        if (is_numeric($st) && is_numeric($ed)) {
            return $ed - $st;
        }
        $num = 1000;
        list($t1, $t2) = explode(" ", $st);
        list($t3, $t4) = explode(" ", $ed);
        $st = round((floatval($t1 * $num) + floatval($t2 * $num)), 3);
        $ed = round((floatval($t3 * $num) + floatval($t4 * $num)), 3);
        $time = $ed - $st;
        return round($time, 3);
    }

    /**
     * 校验是否要启用记录功能
     * @return bool
     */
    protected function _checkAuth(): ?bool
    {
        if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], Configs::getInstance()->get('debug_sign')) !== false && isset($_REQUEST[Configs::getInstance()->get('debug_level_sign')])) {
            return true;
        }
        return false;
    }

    /**
     * 校验记录的等级信息
     * @param string $name
     * @return bool|null
     */
    protected function _checkLevel(string $name): ?bool
    {
        if (!isset($_REQUEST[Configs::getInstance()->get('debug_level_sign')])) {
            return false;
        }
        $debugLevelType = $_REQUEST[Configs::getInstance()->get('debug_level_sign')];
        $debugLevelArr = Configs::getInstance()->get('debug_level');
        if (!isset($debugLevelArr[$debugLevelType])) {
            return false;
        }
        if (!in_array($name, $debugLevelArr[$debugLevelType], true)) {
            return false;
        }
        return true;
    }
}