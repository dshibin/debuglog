## debuglog
    一个简单的php埋点记录插件，使用后设置对应的参数值，就能在线上追踪代码的运行的流程。
###使用方法
    //引入记录装饰类
    use DebugLog\Log\LogDecorate;
    
    //Db记录
    //记录Db运行时间
    $st = microtime();
    //mysql运行流程
    ...
    LogDecorate::Db('select * from test',$st,microtime());
       
    //redis记录
    //记录redis运行时间
    $st = microtime();
    //redis运行流程
    ...
    LogDecorate::Redis('get key',$st,microtime());
    
    //http记录
    //记录http运行时间
    $st = microtime();
    //http curl远程运行流程
    ...
    LogDecorate::Http('curl baidu',$st,microtime());
    
    //埋点info记录，可以记录自己想要的信息
    //记录info运行时间
    $st = microtime();
    //埋点运行流程
    ...
    LogDecorate::Info('test_key',$st,microtime());
    
### 显示方法
    //引入记录装饰类
    use DebugLog\Log\LogDecorate;
    //通过show方法会直接显示出来
    LogDecorate::Show()
    //不过现在的框架很多都对显示做了过滤，也可以使用框架内置的显示方法，将记录的信息显示
    //获取记录的信息的方法
    LogDecorate::getLog()
