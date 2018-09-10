<?php
/**
 * Created by IntelliJ IDEA.
 * User:liozen
 * Date: 2018/9/3
 * Time: 下午6:03
 */

namespace Tiki\Model;
use Medoo\Medoo;

class Model extends \Tiki\base
{

    public static $_medoo = null;
    public  $dbType = 'mysql';
    public function __construct($dbConfig='mysql')
    {

        $this->dbType = $dbConfig;
        $c = [
            'database_type' => 'mysql',
            'database_name' => self::$__config[$dbConfig]['db'],
            'server' => self::$__config[$dbConfig]['ip'],
            'username' => self::$__config[$dbConfig]['user'],
            'password' => self::$__config[$dbConfig]['pass']
        ];

        if(self::$_medoo[$dbConfig] == null){
            self::$_medoo[$dbConfig] = new Medoo($c);
        }
    }

    /**
     * select方法
     * @param $table
     * @param $field
     * @param $where
     */
    public function S($table,$field,$where){
       return self::$_medoo[$this->dbType]->select($table,$field,$where);
    }

    /**
     * 更新方法
     * @param $table
     * @param $value
     * @param $where
     * @return mixed
     */
    public function U($table,$value,$where){
        return self::$_medoo[$this->dbType]->update($table,$value,$where);
    }


    /**
     * insert方法
     * @param $table
     * @param $value
     * @return mixed
     *
     */
    public function I($table,$value){
        return self::$_medoo[$this->dbType]->insert($table,$value);
    }

    /**
     * delete方法
     * @param $table
     * @param $where
     * @return mixed
     *
     */
    public function D($table,$where){
        return self::$_medoo[$this->dbType]->delete($table,$where);
    }

}