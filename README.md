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
    
### 配置项
    在Conf里面的所有数组格式的配置信息都会自动加载
    
### 显示结果
#### HTML
    DebugLog showViews.total process time : 70.727 ms
    db total count is 2 , total time is 70.63 ms
    35.549 ms : SHOW FULL COLUMNS FROM `pre_common_member`
    35.081 ms : SELECT * FROM `pre_common_member` WHERE `uid` = :ThinkBind_1_859473681_ LIMIT 1 {"ThinkBind_1_859473681_":[1,1]}
    redis total count is 2 , total time is 0.097 ms
    0.06 ms : setex_b ["b",654,3600]
    0.037 ms : get_b ["b"]
    strace total count is 10 , total time is 0 ms
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/framework/src/think/Pipeline.php","line":59,"function":"think\\app\\{closure}","class":"think\\app\\MultiApp","object":{},"type":"->","args":[{}]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/framework/src/think/Pipeline.php","line":65,"function":"think\\{closure}","class":"think\\Pipeline","object":{},"type":"->","args":[{}]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/think-multi-app/src/MultiApp.php","line":72,"function":"then","class":"think\\Pipeline","object":{},"type":"->","args":[{}]}
    0 ms : strace {"function":"handle","class":"think\\app\\MultiApp","object":{},"type":"->","args":[{},{},null]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/framework/src/think/Middleware.php","line":142,"function":"call_user_func","args":[[{},"handle"],{},{},null]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/framework/src/think/Pipeline.php","line":84,"function":"think\\{closure}","class":"think\\Middleware","object":{},"type":"->","args":[{},{}]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/framework/src/think/Pipeline.php","line":65,"function":"think\\{closure}","class":"think\\Pipeline","object":{},"type":"->","args":[{}]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/framework/src/think/Http.php","line":204,"function":"then","class":"think\\Pipeline","object":{},"type":"->","args":[{}]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/vendor/topthink/framework/src/think/Http.php","line":162,"function":"runWithRequest","class":"think\\Http","object":{"routePath":"/var/www/html/dshibin/topthink/route/index/"},"type":"->","args":[{}]}
    0 ms : strace {"file":"/var/www/html/dshibin/topthink/public/index.php","line":20,"function":"run","class":"think\\Http","object":{"routePath":"/var/www/html/dshibin/topthink/route/index/"},"type":"->","args":[]}

#### JSON
    {
    	"db": [{
    		"time": 37.604,
    		"log": "SHOW FULL COLUMNS FROM `pre_common_member`",
    		"data": []
    	}, {
    		"time": 37.519,
    		"log": "SELECT * FROM `pre_common_member` WHERE `uid` = :ThinkBind_1_591995913_ LIMIT 1 ",
    		"data": {
    			"ThinkBind_1_591995913_": [1, 1]
    		}
    	}],
    	"redis": [{
    		"time": 0.031,
    		"log": "setex_b",
    		"data": ["b", 654, 3600]
    	}, {
    		"time": 0.025,
    		"log": "get_b",
    		"data": ["b"]
    	}],
    	"strace": [{
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/framework\/src\/think\/Pipeline.php",
    			"line": 59,
    			"function": "think\\app\\{closure}",
    			"class": "think\\app\\MultiApp",
    			"object": {},
    			"type": "->",
    			"args": [{}]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/framework\/src\/think\/Pipeline.php",
    			"line": 65,
    			"function": "think\\{closure}",
    			"class": "think\\Pipeline",
    			"object": {},
    			"type": "->",
    			"args": [{}]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/think-multi-app\/src\/MultiApp.php",
    			"line": 72,
    			"function": "then",
    			"class": "think\\Pipeline",
    			"object": {},
    			"type": "->",
    			"args": [{}]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"function": "handle",
    			"class": "think\\app\\MultiApp",
    			"object": {},
    			"type": "->",
    			"args": [{}, {}, null]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/framework\/src\/think\/Middleware.php",
    			"line": 142,
    			"function": "call_user_func",
    			"args": [
    				[{}, "handle"], {}, {},
    				null
    			]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/framework\/src\/think\/Pipeline.php",
    			"line": 84,
    			"function": "think\\{closure}",
    			"class": "think\\Middleware",
    			"object": {},
    			"type": "->",
    			"args": [{}, {}]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/framework\/src\/think\/Pipeline.php",
    			"line": 65,
    			"function": "think\\{closure}",
    			"class": "think\\Pipeline",
    			"object": {},
    			"type": "->",
    			"args": [{}]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/framework\/src\/think\/Http.php",
    			"line": 204,
    			"function": "then",
    			"class": "think\\Pipeline",
    			"object": {},
    			"type": "->",
    			"args": [{}]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/vendor\/topthink\/framework\/src\/think\/Http.php",
    			"line": 162,
    			"function": "runWithRequest",
    			"class": "think\\Http",
    			"object": {
    				"routePath": "\/var\/www\/html\/dshibin\/topthink\/route\/index\/"
    			},
    			"type": "->",
    			"args": [{}]
    		}
    	}, {
    		"time": 0,
    		"log": "strace",
    		"data": {
    			"file": "\/var\/www\/html\/dshibin\/topthink\/public\/index.php",
    			"line": 20,
    			"function": "run",
    			"class": "think\\Http",
    			"object": {
    				"routePath": "\/var\/www\/html\/dshibin\/topthink\/route\/index\/"
    			},
    			"type": "->",
    			"args": []
    		}
    	}]
    }
