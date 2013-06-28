<?php
class user extends admin{

  function __construct()
  {
    parent::__construct();
    $this->m = load('m/user_m');
    if($this->u['level'] < 20 ) redirect('/','权限不够');
  }

  function index()
  {
    $tot = $this->m->count();
    $psize = 30;
    $param['pagination'] = pagination($tot , seg(3) , $psize ,'/admin/user/index/');
    $param['records'] = $this->m->get("", seg(3), $psize);
    $this->display('v/admin/user/list-table',$param);
  }

  function view($id)
  {
    $param['r'] = $this->m->get($id);
    $this->display('user/show',$param);
  }

  function edit($id)
  {
    $conf = array('email'=>'required|email','username'=>'required','password'=>'required');
    $err = validate($conf);
    if ( $err === TRUE) {
      $_POST['post_time'] = $_POST['update_time'] = time();
      $this->m->update_user($id);
      redirect(BASE.'admin/user/','发布成功！');
    }
    else {
      $param['val'] = array_merge($_POST,$this->m->get($id)); 
      $param['err'] = $err;
      $this->display('v/admin/user/add',$param);
    }
  }  


  function del($id)
  {
    if($id == 1){
      redirect(BASE.'admin/user/','初始账户不能删除！');
      return;
    }
    $this->m->del($id);
    redirect(BASE.'admin/user/','删除成功！');
  }  
  
  
  function add()
  {
    $conf = array('email'=>'required|email|val_dist_email','username'=>'required|val_dist_username','password'=>'required');
    $err = validate($conf);
    if ( $err === TRUE) {
      $_POST['post_time'] = $_POST['update_time'] = time();
      $_POST['user_id'] =  $this->u['id'];
      $_POST['user_name'] =  $this->u['name'];
      $this->m->add_user();
      redirect(BASE.'admin/user/','发布成功！');
    }
    else {
      $param['val'] = $_POST; 
      $param['err'] = $err;
      $this->display('v/admin/user/add',$param);    
    }
  } 
}

?>