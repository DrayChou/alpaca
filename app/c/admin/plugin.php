<?php 
class plugin extends admin{

  function __construct()
  {
    parent::__construct();
    $this->plugin = alpa('plugin');
    if(!is_array($this->plugin))$this->plugin = array();
    //print_r($this->plugin);
  }

  function index()
  {
    $file = array();
    $base_dir = APP."plugin/";  
    $fso = opendir($base_dir);  
    while($flist=readdir($fso)){  
      $file[] = array('name'=>$flist,'installed'=>in_array($flist,$this->plugin));  
    }  
    closedir($fso);
    $param['file'] = $file;
    $this->display('v/admin/plugin/index',$param);  
  }
  
  function view($package , $method = 'index' , $param1 = '' )
  {
    $home = load('plugin/'.$package.'/c/admin/home');
    $home->$method($param1);
  }
  
  function install($package)
  {
    $this->plugin[] = $package; 
    load('m/elem_m')->setting('plugin',$this->plugin,'system');
    $this->rebuild_config();
    redirect(ADMIN_BASE.'plugin/index/','安装成功');
  }

  function remove($package)
  {
    $this->plugin = array_diff($this->plugin ,array($package)); 
    load('m/elem')->setting('plugin',$this->plugin,'system');
    $this->rebuild_config();
    redirect(ADMIN_BASE.'plugin/index/','安装成功');
  }
  
  function rebuild_config()
  {
    $plugin = $this->plugin;
    $content = '<?';
    foreach($plugin as $p){
      $content .= '$route_config[\'/'.$p.'/\']= \'/plugin/load/'.$p.'/\';
      ';
    }
    file_put_contents(APP.'config_app.php',$content);
  }
}

?>