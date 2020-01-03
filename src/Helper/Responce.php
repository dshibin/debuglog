<?php
/**
 * User: dshibin
 * Date: 2019/8/27
 * Time: 19:44
 * Note: 输出日志信息
 */

namespace DebugLog\Helper;

class Responce
{
    /**
     * 输出json字符串
     * @param $data
     */
    public static function json($data)
    {
        if ($data && Configs::getInstance()->get('debug_show')) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 输出html格式列表
     * @param $data
     */
    public static function html($data)
    {
        if ($data && Configs::getInstance()->get('debug_show')) {
            $alltotal = 0;
            $str = '';
            foreach ($data as $key => $val) {
                $html = '';
                $total = $num = 0;
                foreach ($val as $k => $v) {
                    ++$num;
                    $total += $v['time'];
                    $alltotal += $v['time'];
                    $html .= "<li>" . $v['time'] . " ms : " . $v['log'] . ' ' . (empty($v['data']) ? ' ' : json_encode($v['data'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)) . " </li>" . PHP_EOL;
                }
                $str .= "<li><b style='font-size:18px;'>{$key} total count is {$num} , total time is {$total} ms</b></li>" . PHP_EOL . $html;
            }
            $str = "<ul style='margin:30px 45px'><li><b style='font-size:18px;'>DebugLog showViews.total process time : {$alltotal} ms</b></li>" . PHP_EOL . $str . '</ul><br>';
            echo $str;
        }
    }
}
