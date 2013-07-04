<?php

define('BASE', 'http://127.0.0.1/alpaca/');
define('ADMIN_BASE', BASE . 'admin/');
define('SEED', 'r5nlu3c7');

// 数据库配置
$db_config = array(
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'db_type' => 'mysql',
    'default_db' => 'alpaca'
);


//覆盖 SAE 相关的方法
function sae_file( $file, $include = false ) {
    return false;
}

class saebase {
    public function __call($fun, $args) {  //第一次参数是方法名，第二个参数是传过来的参数，是以数组的方式传过来的。
        return false;
    }
}

class SaeStorage extends saebase {

}

class SaeKV extends saebase {
    
}

class SaeDeferredJob extends saebase {
    
}