<?php

class user extends base
{

    function __construct()
    {
        parent::__construct();
        $this->m = load('m/user_m');
    }

    function reg()
    {
        $conf = array('email' => 'required|val_dist_email', 'username' => 'required|val_dist_username', 'password' => 'required');

        $err = validate($conf);
        if ($err === TRUE) {
            $_POST['post_time'] = $_POST['update_time'] = time();
            $_POST['level'] = alpa('default_user_level');
            $this->m->add_user();
            redirect('/login/', '注册成功，请登录。');
        } else {
            $param['val'] = $_POST;
            $param['err'] = $err;
            $param['page_title'] = $param['meta_keywords'] = $param['meta_description'] = '注册';
            $this->display('v/user/add', $param);
        }
    }

    function login()
    {
        $rtu = isset($_GET['rtu']) ? $_GET['rtu'] : '/';
        $conf = array('username' => 'required', 'password' => 'required');
        $err = validate($conf);
        if (is_array($err)) {
            $err['info'] = $this->m->login_err;
            $param['err'] = $err;
            $param['page_title'] = $param['meta_keywords'] = $param['meta_description'] = '登录';
            $this->display('v/user/login', $param);
            exit;
        }

        if ($this->m->login($_POST['username'], $_POST['password'])) {
            redirect($rtu, '登录成功！');
            exit;
        }

        redirect('./?rtu=' . $rtu, $this->m->login_err);
    }

    function logout()
    {
        $this->m->logout();
        redirect(BASE, '退出登录！');
    }

}

?>