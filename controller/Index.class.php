<?php 
if(!defined('PATH'))exit();
class Index extends base{
	
	public function test(){
		var_dump($this->config);	
		$this->dolog('thisis test');
	} 
	
}