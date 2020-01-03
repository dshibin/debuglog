<?php
/**
 * User: dshibin
 * Date: 2019/8/27
 * Time: 19:44
 * Note: 配置设置 || 读取
 */

namespace DebugLog\Helper;

class Configs
{

    private $config = [];

    protected static $instance = null;

    /**
     * 初始化配置文件类
     * Configs constructor.
     * @param $configs
     */
    private function __construct()
    {
        $path = dirname(__DIR__) . '/Conf/';
        foreach (glob($path . '*.php') as $file) {
            $this->setArr(require_once $file);
        }
    }

    private function __clone()
    {
    }

    /**
     * 返回初始化实例类
     * @return Configs|null
     */
    public static function getInstance(): ?Configs
    {
        if (self::$instance instanceof self && !empty(self::$instance)) {
            return self::$instance;
        }
        return self::$instance = new self();
    }

    /**
     * 注入配置类到配置中
     * @param $class
     * @return array
     */
    public function setClass($class): array
    {
        $class = new $class;
        $methods = get_class_methods($class);
        foreach ($methods as $method) {
            $class->$method();
        }
        if (isset($class->config) && !empty($class->config)) {
            return $this->config = array_merge($this->config, $class->config);
        }
        return $this->config;
    }

    /**
     * 注入配置数组到配置中
     * @param $arr
     * @return array
     */
    public function setArr($arr)
    {
        return $this->config = array_merge($this->config, $arr);
    }

    /**
     * 获取配置库里面的值
     * @param string $name
     * @return array
     */
    public function get(string ...$names)
    {
        $ret = $this->config;
        foreach ($names as $name) {
            $ret = $ret[$name] ?? [];
            if (empty($ret)) {
                break;
            }
        }
        return empty($ret) ? '' : $ret;
    }

    /**
     * 获取配置库里面的值
     * @param string $name
     * @return array
     */
    public function getAll(): array
    {
        return $this->config;
    }
}
