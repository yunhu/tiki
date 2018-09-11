<?php
// +----------------------------------------------------------------------
// | Tiki [ EASY TO USE IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liozen <zyhfrozen@gmail.com>
// +----------------------------------------------------------------------


function M( $model='',$dbConfig='mysql')
{
//不传的话，基类
    $model = ucfirst($model);
    if($model){
        $class = 'Tiki\\Model\\'. $model;
    }else{
        $class = 'Tiki\\Model';
    }
    return  new $class($dbConfig);
}



/**
 * @param $url
 * @return mixed
 *
 */
function get($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $return = curl_exec($ch);
    curl_close($ch);
    return $return;
}



/**
 * 输出函数
 * @param unknown_type $code
 * @param unknown_type $msg
 * @param unknown_type $data
 * @param unknown_type $cb
 */
function msg($code, $msg, $data = '',$callback='')
{
    header("Content-Type:application/json; charset=utf-8");
    $str = json_encode(array('code' => $code, 'msg' => $msg, 'data' => $data));
    if ($callback) echo $callback . "($str)";
    else echo $str;
    exit();
}
