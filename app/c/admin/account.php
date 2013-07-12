<?php

class account extends admin
{

    function __construct()
    {
        parent::__construct();
        $this->m = load('m/user_m');
    }

    function index()
    {
        $id = $this->u['id'];
        $conf = array('email' => 'required|email', 'username' => 'required', 'password' => 'required');
        $err = validate($conf);
        if ($err === TRUE) {
            $_POST['post_time'] = $_POST['update_time'] = time();
            $this->m->update_user($id);
            redirect(BASE . 'admin/account/', '修改成功');
        } else {
            $param['val'] = array_merge($_POST, $this->m->get($id));
            $param['err'] = $err;
            $this->display('v/admin/user/account', $param);
        }
    }

    function del($id)
    {
        if ($id == 1) {
            redirect(BASE . 'admin/user/', '初始账户不能删除！');
            return;
        }
        $this->m->del($id);
        redirect(BASE . 'admin/user/', '删除成功！');
    }

    function add()
    {
        $conf = array('email' => 'required|email|val_dist_email', 'username' => 'required|val_dist_username', 'password' => 'required');
        $err = validate($conf);
        if ($err === TRUE) {
            $_POST['post_time'] = $_POST['update_time'] = time();
            $this->m->add_user();
            redirect(BASE . 'admin/user/', '发布成功！');
        } else {
            $param['val'] = $_POST;
            $param['err'] = $err;
            $this->display('v/admin/user/add', $param);
        }
    }

}

?>