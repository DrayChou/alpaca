<?php
 class home extends base{
  function __construct()
  {
    parent::__construct();
  }
  
  function index()
  { 
    global $db_config;
    if(!isset($db_config)){
        $this->install();
        exit;
    }
    load('c/page')->view();
  }
  
  private function install()
  {
    global $db_config;
    if(is_array($db_config))redirect("/");
    if(isset($_POST['db_type'])){
      $db_type = $_POST['db_type'] == 'sqlite'?'sqlite':'mysql';
      $_POST['default_db'] = $db_type=='sqlite'?rand(100000,999999).'.sqlite':$_POST['default_db'];
      $cname = 'db_'.$db_type;
      $db = new $cname($_POST);
      $sql = file_get_contents(APP.$db_type.'_ins.sql');
      $db->muti_query($sql);
      $base_dir = rtrim($_POST['base_dir'],'/').'/';
      $seed = randstr();
      file_put_contents(APP.'config_user.php','<?php
define(\'BASE\',\''.$base_dir.'\');
define(\'ADMIN_BASE\',BASE.\'admin/\');
define(\'SEED\',\''.$seed.'\');
$db_config = array(
  \'host\'      =>\''.$_POST['host'].'\', 
  \'user\'      =>\''.$_POST['user'].'\',  
  \'password\'  =>\''.$_POST['password'].'\', 
  \'db_type\'   =>\''.$_POST['db_type'].'\',
  \'default_db\'=>\''.$_POST['default_db'].'\'
);');
      redirect($_POST['base_dir'],'安装成功');
    }
    else {
      header("Content-type: text/html; charset=utf-8");
      $base = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']);
      view("v/home/install",array('base'=>$base));
    }
  }
  
  function test()
  {
  
$a = 'a:2:{s:11:"title_label";s:6:"标题";s:6:"fields";a:4:{i:0;a:5:{s:4:"name";s:7:"xinghao";s:5:"label";s:6:"型号";s:5:"model";s:4:"text";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"2";}i:1;a:5:{s:4:"name";s:3:"pic";s:5:"label";s:6:"图片";s:5:"model";s:3:"pic";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"3";}i:2;a:5:{s:4:"name";s:5:"price";s:5:"label";s:6:"价格";s:5:"model";s:4:"text";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"6";}i:3;a:5:{s:4:"name";s:7:"content";s:5:"label";s:6:"描述";s:5:"model";s:3:"rte";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"9";}}}';

    print_r(_decode($a));
  }
    
}

?>