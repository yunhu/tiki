<?php
/**
 * Created by IntelliJ IDEA.
 * User: didi
 * Date: 2018/9/4
 * Time: 上午10:58
 */

namespace Tiki;


class autoload
{
    public static function load($class)
    {
        list($_, $pos, $m) = explode('\\', $class);
        $pos = strtolower($pos);
        $m = ucfirst($m);
        $file = PATH . '/' . $pos . '/' . $m . '.class.php';
        if (file_exists($file)) {
            require $file;
        } else {
            exit($file . 'NOT EXISTS!');
        }
    }
}