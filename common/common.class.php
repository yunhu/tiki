<?php
/**
 * 尝规处理涵数
 * Created by IntelliJ IDEA.
 * User: zhangyunhnu
 * Date: 2018/9/4
 * Time: 上午9:57
 */
namespace Tiki;
use Tiki\Model;

public function M( $model='')
{
//不传的话，基类
    if($model){
        return new Tiki\Model\$model;
    }else{
        return new Tiki\Model;
    }
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
