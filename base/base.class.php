<?php
if(!defined('PATH'))exit();
class base {

	//jsonp参数
	private $callback = '';

	//配置文件参数
	protected $config = '';


	/**
	 * 构造函数
	 */
	protected function __construct(){
		$this->init();
	}

	/**
	 * 初始化函数
	 */
	private function init(){
		date_default_timezone_set('Asia/Shanghai');
		$this->callback = isset($_GET['cb']) ? htmlspecialchars($_GET['cb']) : '';
		/**
		 * 想要加载哪个文件写这里，不编历了。
		 * 写的时候注意点，这里没有文件不会加载，不会提示会
		 * @var unknown_type
		 */
		$needtoinclude = array(
				PATH . '/lib/mysql/mysql.php',
				PATH . '/lib/mysql/live.php',
		);
		foreach($needtoinclude as $val){
			if(file_exists($val))include $val;
		}

		$this->config = include PATH . '/config/config.php';

	}

	/**
	 * 启动入口函数
	 */
	public static function run(){
		$base = isset($_GET['m']) ? htmlspecialchars($_GET['m']) : 'index';
		$c = isset($_GET['c']) ? htmlspecialchars($_GET['c']) : 'index';
		$m = basename(PATH . '/base/' . $base);
		if($m){
			$file = PATH . '/controller/' . $m . '.class.php';
			if(file_exists($file)){
				include  $file;
				$m = lcfirst($m);
				if($m != $c){
					$controller = new $m();
					$controller->$c();
				}else{
					$controller = new $m();
				}
			}else{
				echo json_encode(array('code'=>2, 'msg'=>'参数错误'));
			}
		}else{
			echo json_encode(array('code'=>3, 'msg'=>'参数错误'));
		}
			
	}

	/**
	 * 日志函数
	 * @param unknown_type $data
	 */
	protected function dolog($data='', $path=''){
		if($data){
			if(!$path){
				$path = PATH . '/logs/' . date("Ymd") . '.txt';
			}
			if(is_string($data)){
				file_put_contents($path, $data . "\n", FILE_APPEND);
			}else{
				file_put_contents($path, json_encode($data) . "\n", FILE_APPEND);
			}
		}
	}

	/**
	 * 
	 * curl get
	 * @param unknown_type $url
	 * @return mixed
	 */
	protected function get($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$return = curl_exec($ch);
		curl_close($ch);
		return $return;
	}


	/**
	 * call 魔术方法
	 */
	public function __call($name, $args){
		echo json_encode(array('code'=>1,'msg'=>'参数错误'));
	}



	/**
	 * 输出函数
	 * @param unknown_type $code
	 * @param unknown_type $msg
	 * @param unknown_type $data
	 * @param unknown_type $cb
	 */
	protected function msg($code, $msg, $data=''){
		header("Content-Type:application/json; charset=utf-8");
		$str = json_encode(array('code'=>$code, 'msg'=>$msg, 'data'=>$data));
		if($this->callback) echo $this->callback . "($str)";
		else echo $str;
		exit();
	}
}