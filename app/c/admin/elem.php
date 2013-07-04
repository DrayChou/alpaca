<?php

class elem extends admin {

    function __construct() {
        parent::__construct();
        $this->m = load('m/elem_m');
    }

    function index() {
        $tot = $this->m->count();
        $psize = 30;
        $pcurrent = isset($_GET['p']) ? $_GET['p'] : 0;
        $param['pagination'] = pagination($tot, $pcurrent, $psize, '/admin/elem/index/?p=');
        $param['records'] = $this->m->get(" order by id desc", $pcurrent, $psize);
        $this->display('elem/list-table', $param);
    }

    function del($id) {
        $this->m->elem_del($id);
        $this->cachedir();
        redirect(BASE . 'admin/page/', '删除成功！');
    }

}

?>