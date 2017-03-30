<?php 
if(!defined('PATH'))exit();
class Index extends base{
	
	
	public function test(){
		var_dump($this->config);	
		$u = M('index');
	
		$u->username ='zhang';
		$u->age = 127;
		
		$u->sex = 1;
		var_dump($u->add());
	
		/*
		$u->age = 2;
		$u->id=1;
		var_dump($u->save());
		
		$u->id=2;
		var_dump($u->del());
		
		
		$u->sex=1;
		var_dump($u->Find());
		var_dump($u->age,$u->id,$u->username);
	
		var_dump($u->all());
			*/
	} 
	
}