<?php
namespace Tiki\Controller;


if(!defined('PATH'))exit();
class Index extends Controller {
	
	
	public function test(){
	    $data = M()->S('user','*',['User'=>'root']);
var_dump($data);die;

	}
	
}