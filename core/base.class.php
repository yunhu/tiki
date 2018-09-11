<?php

namespace Tiki;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class base
{



    //配置文件参数
    public static $__config = '';

    public static $__modelHandle = null;

    /**
     * 构造函数
     */
    protected function __construct()
    {
        $this->init();
    }

    /**
     * 初始化函数
     */
    private function init()
    {
        date_default_timezone_set('Asia/Shanghai');
        require PATH . '/vendor/autoload.php';
        require PATH . '/core/autoload/autoload.class.php';
        require PATH . '/base/Model.class.php';
        require PATH . '/core/common/common.class.php';
        require PATH . '/common/common.class.php';
        self::$__config = include PATH . '/config/config.php';
        spl_autoload_register(__NAMESPACE__.'\\autoload::load');

    }

    /**
     * 启动入口函数
     */
    public static function run()
    {

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $con = $method = 'index';
        if(isset($uri['path']) && $uri['path']!='/' ) {
            list($_, $con, $method) = explode('/', $uri['path']);
        }
        //aa.com/fetch?a=c
        if($con && empty($method)){
           $method = $con;
           $con = 'index';
        }
        $m = ucfirst(basename(PATH . '/base/' . $con));
        if ($m) {
            require PATH .'/base/Controller.class.php';
            $file = PATH . '/controller/' . $m . '.class.php';
            if (file_exists($file)) {
                $class = __NAMESPACE__."\\Controller\\$m";
                require $file;
                try{
                    if ($m != $method) {
                          $controller = new $class();
                          $controller->$method();
                    } else {
                           new $m();
                    }
                }catch (\Exception $e){
                    exit($e->getMessage());
                }

            } else {
                exit($file . ' NOT FOUND!');
            }
        } else {
            exit($m . ' NOT FOUND!');
        }

    }

    /**
     * 日志函数
     * @param unknown_type $data
     */
    protected function dolog($data = '', $path = '',$type = 'warning',$ch='pro')
    {
        if ($data) {
            $log = new Logger($ch);
            $path = PATH . '/logs/' . date("Ymd") . '.log';
            $log->pushHandler(new StreamHandler($path, Logger::WARNING));
            $log->warning($data);
        }
    }


    /**
     * call 魔术方法
     */
    public function __call($name, $args)
    {
        echo json_encode(array('code' => 1, 'msg' => '参数错误'));
    }


}