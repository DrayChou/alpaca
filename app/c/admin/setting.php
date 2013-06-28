<?php 
class setting extends admin{

  function __construct()
  {
    parent::__construct();
    $this->m = load('m/elem_m');
    $this->submenu = array('index'=>'网站设置','cleancache'=>'清空缓存','backup'=>'备份管理');
  }

  function index()
  {
    $param['config'] = array('site_title'=>'网站名称','slogon'=>'网站小标题','logo_url'=>'logo地址',
    'default_user_level'=>'默认注册用户级别','icp'=>'icp备案','cache_time'=>'缓存时间(关闭为0)');
    $setting = $param['setting'] =  $this->m->setting();
    if(isset($_POST['setting']))
    {
      foreach($_POST['setting'] as $k=>$v)
      {
        $this->m->setting($k,$v,'config');
      }
      redirect(BASE.'admin/setting/','修改成功！');
    }
    $param['submenu'] = $this->submenu;
    $this->display('v/admin/setting/add',$param);  
  }
  
  function cleancache()
  {
    cache_clean();
    load('c/admin/page')->cachedir();
  }
  
  function backup( $action = '' , $file = '')
  {
    switch($action){
      case 'create':
        $this->backup_create();
        return;
      case 'restore':
        $this->backup_restore( $file );
        return;
      case 'del':
        $this->backup_del( $file );
        return;
    }
    $file = array();
    $base_dir = APP."db/";  
    $fso = opendir($base_dir);  
    while($flist=readdir($fso)){  
    $file[] = $flist;  
    }  
    closedir($fso);
    $param['file'] = $file;
    $param['submenu'] = $this->submenu;
    $this->display('v/admin/setting/backup',$param);  
  }
  
  function backup_create()
  {
    global $db_config;
    extract($db_config);
    if($db_type == 'sqlite')  exec('sqlite3 '.$default_db.' ".dump" > '.APP.'db/'.date('YmdHis').'.sql');
    else exec('mysqldump -u'.$user.' -p'.$password.' '.$default_db.' >  '.APP.'db/'.date('YmdHis').'.sql');
    redirect('../','finished');
  }

  function backup_restore($file)
  {
    global $db_config;
    extract($db_config);
    if($db_type == 'sqlite')  exec('sqlite3 '.$default_db.' <  '.APP.'db/'.$file);
    else exec('mysql -u'.$user.' -p'.$password.' '.$default_db.' <  '.APP.'db/'.$file);
    redirect('../../','finished');
  }

  function backup_del($file)
  {
    unlink(APP.'db/'.$file);
    redirect('../../','finished');
  }
}

?>