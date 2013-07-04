<?php

class home extends admin {

    function __construct() {
        parent::__construct();
        $this->m = load('m/elem_m');
    }

    function index() {
        $tot = $this->m->count("and `mod`='page'");
        $user = load('m/user_m')->count();
        $param = array('tot' => $tot, 'user' => $user);
        $this->display('v/admin/home', $param);
    }

}

?>