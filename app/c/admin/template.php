<?php 
class template extends admin{

  function __construct()
  {
    parent::__construct();
    $this->m = load('m/elem_m');
    $this->submenu = array('index'=>'模板文件','label'=>'标签');
  }

  function index()
  {
    $file = APP.'tmp/'.trim(str_replace('admin/template/index','',$_SERVER['PATH_INFO']),'/');
    if ( $file =='app/tmp/admin/template' ) {
      header("location:index/");
    }
    
    if(is_dir($file)) {
      $base_dir =  $file.'/';  
      $fso = scandir($base_dir);
      foreach($fso as $f){  
          if( in_array( $f, array('.')))continue;
          $ar[ 'name'][]   =   $f;
          $f = $base_dir.$f;
          $ar[ 'type'][]   =   is_dir($f)?"dir": "file";
          $ar[ 'time'][]   =   date( "Y-m-d   H:i:s ",filectime($f));
          $ar[ 'size'][]   =   filesize($f);
      } 
      array_multisort($ar[ 'type'],$ar[ 'name'],SORT_STRING,SORT_ASC,$ar[ 'time'],SORT_DESC,$ar[ 'size']); 
      $param['file'] = $ar;
      $param['submenu'] = $this->submenu;
      $this->display('v/admin/template/dir',$param);  
    }
    elseif(is_file($file)) {
      if(isset($_POST['code'])){
        file_put_contents($file,str_replace('< /textarea>','</textarea>',$_POST['code']));
        header("location:../");
      }
      $param['content'] = file_get_contents($file);
//      print_r($param);
      $this->display('v/admin/template/file',$param);  
    }
    else {
      echo "文件不存在";
    }
  }
  
  function oldindex()
  {
    $param['default'] = alpa('default_template');
    $tot = $this->m->count( " and `mod` = 'template' " );
    $psize = 30;
    $pcurrent = isset( $_GET['p'] )? $_GET['p']:0;
    $param['pagination'] = pagination($tot , $pcurrent , $psize ,'/elem/index/');
    $param['records'] = $this->m->get( " and `mod` = 'template'  " , $pcurrent ,  $psize);
    $param['submenu'] = $this->submenu;
    $this->display('v/admin/template/list-table',$param);
  }
  
  function add()
  {
    $conf = array('title'=>'required');
    //,'mod'=>'required','rel_id'=>'required','elem_name'=>'required','elem_info'=>'required','elem_info'=>'required','post_time'=>'required','update_time'=>'required','user_id'=>'required','user_name'=>'required','order_by'=>'required',);
    $err = validate($conf);
    if ( $err === TRUE) {
      $_POST['post_time'] = $_POST['update_time'] = time();
      $id = $this->m->add();
      file_put_contents(APP.'tmp/template_'.$id.'.php',$_POST['elem_info']);
      redirect(ADMIN_BASE.'template/','发布成功！');
    }
    else {
      $param['val'] = $_POST; 
      $param['err'] = $err;
    $param['submenu'] = $this->submenu;
      $this->display('v/admin/template/add',$param);    
    }
  }    

  function edit($id)
  {
    $conf = array('title'=>'required');
    //,'mod'=>'required','rel_id'=>'required','elem_name'=>'required','elem_info'=>'required','elem_info'=>'required','post_time'=>'required','update_time'=>'required','user_id'=>'required','user_name'=>'required','order_by'=>'required',);
    $err = validate($conf);
  	if ( $err === TRUE) {
      $_POST['update_time'] = time();
      $this->m->update($id);
      file_put_contents(APP.'tmp/template_'.$id.'.php',$_POST['elem_info']);
      redirect(ADMIN_BASE.'template/','修改成功！');
    }
    else {
      $param['val'] = array_merge($_POST,$this->m->get($id));
      $param['err'] = $err;
    $param['submenu'] = $this->submenu;
      $this->display('v/admin/template/add',$param);    
    }
  }

  function defa($id){
    $this->m->setting('default_template',$id);
    redirect(ADMIN_BASE.'template/','成功设置默认风格！');
  }
  
  /*排版*/
  
  function layout($action = '' , $id = 0)
  {
    switch($action){
      case 'add':
        $this->layout_add();
        return;
      case 'edit':
        $this->layout_edit($id);
        return;
      case 'replicate':
        $this->layout_replicate($id);
        return;
    }
    $tot = $this->m->count( " and `mod` = 'layout' " );
    $psize = 30;
    $pcurrent = isset( $_GET['p'] )? $_GET['p']:0;
    $param['pagination'] = pagination($tot , $pcurrent , $psize ,'/elem/index/');
    $param['records'] = $this->m->get( " and `mod` = 'layout'  " , $pcurrent ,  $psize);
    $param['submenu'] = $this->submenu;
    $this->display('v/admin/layout/list-table',$param);
  }

  function layout_add()
  {
    $conf = array('elem_name'=>'required');
    $err = validate($conf);
    if ( $err === TRUE) {
      $_POST['post_time'] = $_POST['update_time'] = time();
      $id = $this->m->add();
      file_put_contents(APP.'tmp/layout_'.$id.'.php',$_POST['elem_info']);
      redirect(ADMIN_BASE.'template/layout/','发布成功！');
    }
    else {
      $param['val'] = $_POST; 
      $param['err'] = $err;
    $param['submenu'] = $this->submenu;
      $this->display('v/admin/layout/add',$param);    
    }
  }    

  function layout_edit($id)
  {
    $conf = array('elem_name'=>'required');
    $err = validate($conf);
  	if ( $err === TRUE) {
      $_POST['update_time'] = time();
      $_POST['elem_info'] = str_replace('< /textarea>','</textarea>',$_POST['elem_info']);
      $this->m->update($id);
      file_put_contents(APP.'tmp/layout_'.$id.'.php',$_POST['elem_info']);
      redirect(ADMIN_BASE.'template/layout/','修改成功！');
    }
    else {
      $param['val'] = array_merge($_POST,$this->m->get($id));
      $param['val']['elem_info'] = str_replace('</textarea>','< /textarea>',$param['val']['elem_info']);
      $param['err'] = $err;
    $param['submenu'] = $this->submenu;
      $this->display('v/admin/layout/add',$param);    
    }
  }
  
  function layout_replicate($id)
  {
    $new = $this->m->get($id);
    $new['elem_name'] = $new['elem_name'].'_复制';
    $nid = $this->m->add($new);
    file_put_contents(APP.'tmp/layout_'.$nid.'.php',$new['elem_info']);
    redirect(ADMIN_BASE.'template/layout/','修改成功！');
  }
  
  
  function label()
  {
    $param['config'] = array('site_title'=>'网站名称','slogon'=>'网站小标题','logo_url'=>'logo地址',
    'default_user_level'=>'默认注册用户级别','icp'=>'icp备案');
    $setting = $param['setting'] =  $this->m->setting();
    if(isset($_POST['var']))
    {
      foreach($_POST['var'] as $m)
      {
        $this->m->setting($m['key'],$m['val']);
      }
      redirect(ADMIN_BASE.'template/label/','修改成功！');
    }
    $param['submenu'] = $this->submenu;
    $this->display('v/admin/setting/label',$param);  
  }
  
}

?>