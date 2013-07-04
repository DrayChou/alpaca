<?php

class home extends admin {

    function __construct() {
        parent::__construct();
        $this->m = load('m/elem_m');
    }

    function index() {
        $tot = $this->m->count(" and `mod` = 'form' ");
        $psize = 30;
        $pcurrent = isset($_GET['p']) ? $_GET['p'] : 0;
        $param['pagination'] = pagination($tot, $pcurrent, $psize, BASE . '/admin/form/index/?p=');
        $param['records'] = $this->m->get(" and `mod` = 'form'  ", $pcurrent, $psize);
        $this->display('plugin/freeform/v/admin/form/list-table', $param);
    }

    function view($id) {
        $r = $this->m->get($id);
        $param['r'] = _decode($r['elem_info']);
        $this->display('plugin/freeform/v/admin/form/show', $param);
    }

    function del($id) {
        $this->m->del($id);
        redirect(BASE . 'admin/plugin/freeform/index/', '删除成功！');
    }

}
?>

