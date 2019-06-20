<?php
/**
 * Created by IntelliJ IDEA.
 * User: frozen
 * Date: 2018/9/3
 * Time: 下午6:02
 */

namespace Tiki\Controller;



class Controller extends \Tiki\base
{


    public function index(){

    }

    /**
     * @param $res
     * 判断结果
     */
    public function judgeResult($res){

        if ($res) {
            msg(0,'success');
        } else {
            msg(3,'fail');
        }
    }

    /**
     * @param $key
     * @param $isZero 是否允许0， 1是不允许，默认0允许
     * 必传字段检查
     */
    public function requireParam($key,$isZero = 1){
        $param = isset($_REQUEST[$key]) ? $_REQUEST[$key]: '';
        if($isZero){
            if(empty($param)){
                msg(1,'参数非法');
            }
        }else{
            if(empty($param) && $param !== 0){
                msg(1,'参数非法');
            }
        }
    }

    public function optional($key,$default =''){
        $param = isset($_REQUEST[$key]) ? $_REQUEST[$key]: $default;
        return $param;
    }

    public function checkRepeat(){

    }
}