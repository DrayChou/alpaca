<?php

// 所有配置内容都可以在这个文件维护
//error_reporting(E_ERROR);
ini_set('display_errors',1);

define('ALPA_VERSION', '3.8');
// 配置url路由
$route_config = array(
    '/page/' => '/page/view/',
    '/tag/' => '/page/tag/',
    '/login/' => '/user/login/',
    '/reg/' => '/user/reg/',
    '/logout/' => '/user/logout/',
    '/thumb/' => '/file/thumb/',
);

if (file_exists(APP . 'config_app.php')) {
    require(APP . 'config_app.php');
}

//判断是不是 SAE 环境
if ((!empty($_SERVER['HTTP_APPNAME']) && !empty($_SERVER['HTTP_APPVERSION'])) && file_exists(APP . 'config_sae.php')) {

    define('APP_SERVER', 'sae');
    require(APP . 'config_sae.php');

    @include 'saekv://config_app.php';

} elseif (file_exists(APP . 'config_user.php')) {

    define('APP_SERVER', '');
    require(APP . 'config_user.php');
}