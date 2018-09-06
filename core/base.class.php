<?php

namespace Tiki;


class base
{

    //jsonp参数
    private $callback = '';

    //配置文件参数
    public static $config = '';

    public static $modelHandle = null;

    /**
     * 构造函数
     */
    protected function __construct()
    {
        require PATH . '/vendor/autoload.php';
        $this->init();
    }

    /**
     * 初始化函数
     */
    private function init()
    {
        date_default_timezone_set('Asia/Shanghai');

        $this->callback = isset($_GET['cb']) ? htmlspecialchars($_GET['cb']) : '';

      //  $this->config = include PATH . '/config/config.php';

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
                     //   $controller = new $m();
                        $controller->$method();
                    } else {
                        $controller = new $m();
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
    protected function dolog($data = '', $path = '')
    {
        if ($data) {
            if (!$path) {
                $path = PATH . '/logs/' . date("Ymd") . '.txt';
            }
            if (is_string($data)) {
                file_put_contents($path, $data . "\n", FILE_APPEND);
            } else {
                file_put_contents($path, json_encode($data) . "\n", FILE_APPEND);
            }
        }
    }


    /**
     * call 魔术方法
     */
    public function __call($name, $args)
    {
        echo json_encode(array('code' => 1, 'msg' => '参数错误'));
    }


    /**
     * 输出函数
     * @param unknown_type $code
     * @param unknown_type $msg
     * @param unknown_type $data
     * @param unknown_type $cb
     */
    protected function msg($code, $msg, $data = '')
    {
        header("Content-Type:application/json; charset=utf-8");
        $str = json_encode(array('code' => $code, 'msg' => $msg, 'data' => $data));
        if ($this->callback) echo $this->callback . "($str)";
        else echo $str;
        exit();
    }
}