<?php
namespace Tiki\Controller;

if(!defined('PATH'))exit();
class Index extends Controller {
	
	
	public function test(){
			var_dump(2);die;
		$this->dolog('thisis test');
	} 
	
}