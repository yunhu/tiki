<?php
namespace Tiki\Controller;


if(!defined('PATH'))exit();
class Index extends Controller {
	
	
	public function test(){
	   // $data = M()->S('user','*',['User'=>'root']);
        $index=M('index')->fetchIndex();
        var_dump($index);die;
	}

	public function index(){
        $index=M('index')->fetchIndex();
        $log = array('name'=>'tiki','value'=>'lizoen');
        $this->log('aasbb',['username'=>'tigera','age'=>333]);
        var_dump($index);die;
    }
	
}