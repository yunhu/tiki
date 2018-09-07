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

