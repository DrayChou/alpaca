<?php
 class home extends base{
  
  function __construct()
  {
    parent::__construct();
  }
  
  function index($sort = 'form')
  { 
    if(is_array($_POST)){
      $_POST['elem_info'] = _encode($_POST);
      $_POST['elem_name'] = $sort;
      $_POST['update_time'] = $_POST['post_time'] = time();
      $_POST['mod'] = 'form';
      load('m/elem_m')->add();
      redirect(BASE,"提交成功!");
    }
    redirect(BASE,"请从表单页面访问!");
  }
}

?>