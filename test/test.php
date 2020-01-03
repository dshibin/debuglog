<?php
/**
 * User: dshibin
 * Date: 2020/1/2
 * Time: 15:30
 * Note: 测试记录信息
 */

require_once '../vendor/autoload.php';

//测试db记录
$st = microtime();
usleep(rand(1000,5000));
\DebugLog\Log\LogDecorate::Db('select * from test',$st,microtime());

//测试redis记录
$st = microtime();
usleep(rand(1000,5000));
\DebugLog\Log\LogDecorate::Redis('get test',$st,microtime());

//测试http记录
$st = microtime();
usleep(rand(1000,5000));
\DebugLog\Log\LogDecorate::Http('curl baidu',$st,microtime());

//测试memcache记录
$st = microtime();
usleep(rand(1000,5000));
\DebugLog\Log\LogDecorate::Memcache('set test',$st,microtime());

//测试info记录
$st = microtime();
usleep(rand(1000,5000));
\DebugLog\Log\LogDecorate::Info('test_key',$st,microtime());

\DebugLog\Log\LogDecorate::Show();

