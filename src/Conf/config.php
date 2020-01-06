<?php
/**
 * User: dshibin
 * Date: 2019/12/30
 * Time: 17:29
 * Note: the config of log
 */

return [
    //自定义显示在请求头的信息，只有请求包含该信息，才会执行代码
    'debug_sign' => 'BBS_DEBUG_SHOW',
    //自定义在请求体get或者post里面的key值，接收对应的参数
    'debug_level_sign' => 'DEBUG_LEVEL',
    //显示等级 1 只显示轻量级信息 2 显示全部信息 3 显示全部信息+堆栈信息
    //信息类别有 db，redis，http，memcache，info，strace
    'debug_level' => [
        1   =>  ['db','redis'],
        2   =>  ['db','redis','http','info'],
        3   =>  ['db','redis','http','info','strace'],
    ],
    //在请求里面返回对应的信息，false则隐藏
    'debug_show' => true,
    //显示类型，有json和html两种
    'debug_show_type' => 'html',
    //debug strace回流信息条数
    'debug_strace_num'  =>  20,
];