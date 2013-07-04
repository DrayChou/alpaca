<?php

define('BASE', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('ADMIN_BASE', BASE . 'admin/');
define('SEED', 'zoj39gue');

//SAE标识
define('SAE_STORAGE_DOMAIN', 's02');

// 数据库配置
$db_config = array(
    'db_type' => 'mysql',
    'host' => SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT,
    'user' => SAE_MYSQL_USER,
    'password' => SAE_MYSQL_PASS,
    'default_db' => SAE_MYSQL_DB
);

function sae_file( $file, $include = false ) {
    $temp = @file_get_contents('saekv://' . $view . '.php');
    if( !empty($temp) ){
        if($include){
            @include 'saekv://' . $view . '.php';
        }
    } else {
        $temp = @file_get_contents('saestor://' . SAE_STORAGE_DOMAIN . '/' . $view . '.php');
        if( !empty($temp) ){
            file_put_contents('saekv://' . $view, $temp);

            if($include){
                @include 'saestor://' . SAE_STORAGE_DOMAIN . '/' . $view . '.php';
            }
        }
    }

    return $temp;
}