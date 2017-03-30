<?php

/**
 * 加载model方法
 * string $model 就是model目录下的model名，示例：UserModel.class.php  M(user)
 */
 function M($model=''){
	if(empty($model)){
		return false;
	}
	$name = ucfirst(strtolower($model)) . 'Model';
	$path = PATH . '/model/' .$name.'.class.php';
	if(file_exists($path)){
		include $path;
		return new $name();
	}else{
		return false;
	}

		
}