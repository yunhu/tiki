<?php
/**
 * Created by IntelliJ IDEA.
 * User:liozen
 * Date: 2018/9/3
 * Time: 下午6:03
 */

namespace Tiki;
use Medoo\Medoo;

class model extends base
{

    public static $_medoo = null;
    public function __construct()
    {
        if(self::$_medoo == null){
            self::$_medoo = new Medoo();
        }
    }

    /**
     * @param $table
     * @param $field
     * @param $where
     */
    public function S($table,$field,$where){
        self::$_medoo->select($table,$field,$where);
    }


}