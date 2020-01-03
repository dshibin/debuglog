<?php
/**
 * User: dshibin
 * Date: 2019/12/30
 * Time: 17:29
 * Note: 提供便捷操作的记录装饰类
 */

namespace DebugLog\Log;


use DebugLog\Helper\Configs;
use DebugLog\Helper\Responce;

class LogDecorate
{

    /**
     * 记录sql执行时间效率
     * @param $log
     * @param $st
     * @param $ed
     * @param array $data
     * @return bool|null
     */
    public static function Db($log, $st, $ed, $data = [])
    {
        return Log::getInstance()->Log('db', $log, $st, $ed, $data);
    }

    /**
     * 记录redis执行时间效率
     * @param $log
     * @param $st
     * @param $ed
     * @param array $data
     * @return bool|null
     */
    public static function Redis($log, $st, $ed, $data = [])
    {
        return Log::getInstance()->Log('redis', $log, $st, $ed, $data);
    }

    /**
     * 记录memcache执行时间效率
     * @param $log
     * @param $st
     * @param $ed
     * @param array $data
     * @return bool|null
     */
    public static function Memcache($log, $st, $ed, $data = [])
    {
        return Log::getInstance()->Log('memcache', $log, $st, $ed, $data);
    }

    /**
     * 记录curl http执行时间效率
     * @param $log
     * @param $st
     * @param $ed
     * @param array $data
     * @return bool|null
     */
    public static function Http($log, $st, $ed, $data = [])
    {
        return Log::getInstance()->Log('http', $log, $st, $ed, $data);
    }

    /**
     * 记录埋点信息与执行时间效率
     * @param $log
     * @param $st
     * @param $ed
     * @param array $data
     * @return bool|null
     */
    public static function Info($log, $st, $ed, $data = [])
    {
        return Log::getInstance()->Log('info', $log, $st, $ed, $data);
    }

    /**
     * 获取对应的日志信息
     * @param string|null $logtype
     * @return array
     */
    public static function getLog(?string $logtype = null)
    {
        return Log::getInstance()->getLog($logtype);
    }


    /**
     * 输出展示信息
     */
    public static function Show()
    {
        if (Configs::getInstance()->get('debug_show_type') == 'json') {
            Responce::json(Log::getInstance()->getLog());
        } else {
            Responce::html(Log::getInstance()->getLog());
        }
    }
}