<?php 
load('lib/utility',false);
class base extends c{
  function __construct(){
    global $db_config,$var;
    if(isset($db_config)){
      $this->u = load('m/user_m')->check();
      $var = load('m/elem_m')->setting();
    }
  }

  function display($view,$param = array())
  {
    $param['al_content'] = view($view,$param,TRUE);
    header("Content-type: text/html; charset=utf-8");
    view('tmp/template',$param);
  }
}

/* 显示面包屑 */

class alpa
{
  // 生成 Tag 列表
  static function tags( $layout_name = 'list' )
  { 
    $list = load('m/elem_m')->tags();
    $al_list = array();
    foreach($list as $l){
      $l['page'] = BASE.'tag/'.$l['elem_name'];
      $al_list[] = $l;
    }
    return view( 'tmp/'.$layout_name, array('pages' => $al_list ) , TRUE );  
  }
  
  static function tag( $tagname , $page_size = 10 , $layout_name = 'list' )
  {
    $eurl = urlencode($tagname);
    $where = " and id in ( select rel_id from elem where `mod`='tag' and elem_name='$eurl' )";
    return alpa::showlist( $where , $page_size = 10 , $layout_name);
  }
  
  // 生成面包屑
  static function breadcrumb()
  {
    global $rel_id;
    $id =  $rel_id ? $rel_id : 0;
    $dir = alpa('dir');
    $c = '<a href="'.BASE.'" >首页</a> » ';
    $c1 = '';
    while($id != 0) 
    {
      $d = $dir[$id];
      $c1 = ' <a href="'.BASE.'page/'.$d['name'].'/" >'.$d['title'].'</a> » ' . $c1;
      $id = $d['rel_id'];
    }
    return $c.$c1;
  }
  
  // 获取各种列表
  static function showlist( $condition , $page_size = 10 , $layout_name = 'list')
  {
    $page_size = $page_size > 0 ? $page_size:10;
    $list = load('m/elem_m')->get($condition , 0 , $page_size );
    $al_list = array();
    foreach($list as $l){
      $l['page'] = BASE.'page/'.($l['elem_name']?$l['elem_name']:$l['id']).'/';
      $linfo = _decode($l['elem_info']);
      $al_list[] = array_merge($l,$linfo);
    }
    $layout = is_file(APP.'tmp/'.$layout_name.'.php')?'tmp/'.$layout_name:'tmp/list';
    $param = array('pages' => $al_list);
    return view( $layout , $param , TRUE );  
  }
  
  static function muti( $elem , $num , $layout_name )
  {
    $condition = " and  rel_id in (select id from elem where elem_name = '$elem' and `mod` = 'page') order by post_time desc";
    return alpa_list($condition, $num , $layout_name );
  }
  
  // 显示分类
  static function cate( $cate , $page_size = 10 ,$layout_name = 'list_layout' )
  { 
    $cate = addslashes($cate);
    return alpa_list(" and rel_id in ( select id from elem where elem_name = '$cate' ) and `mod`='dir' ", $page_size  , $layout_name );
  }
}


function alpa( $key , $page_size = 10 , $layout_name = 'list_layout' )
{
  $key = trim($key);
  $page_size = $page_size+0;
  //变量
  global $var;
  if(array_key_exists($key,$var))return $var[$key]['val'];
  if( $key == 'LAST'  ) return alpa_list( '', $num , $layout_name );
  $p = load('m/elem_m')->gname($key);
  //链接
  if ( $p['mod'] == 'link' ) {
    $links =  _decode($p['elem_info']);
    $out = '';
    $i = 0;
    foreach($links as $l )
    {
      $class = '';
      if(!$i++) $class=' class="first" ';
      if($_SERVER['REQUEST_URI'] == $l['link'] ) $class=' class="current" ';
      $out.= '<li '.$class.' ><a href="'.(isset($l['base'])?BASE:'').$l['link'].'" ';
      $out.=isset($l['blank'])?'target="_blank"':'';
      $out.=' ><span>'.$l['label'].'</span></a></li>';
    }
    return $out;
  }
  //页面
  
  if( $p['mod'] == 'dir') {
    $pid = $p['id'];
    $catids = child_dir($pid);
    $catids[] = $pid;
    $condition = $pid?" and rel_id in (".implode(',',$catids).")":''; 
    $condition .= " and `mod` ='page' order by order_by desc, post_time desc ";
    return alpa::showlist($condition, $page_size , $layout_name );
  }
  return "<div class=\"alert\" >警告： $key 不存在</div>";
}
  
function child_dir($id){
  $tree = alpa('tree');
  return catids($id,$tree);
}

function catids($id,$tree)
{ 
  if(!isset($tree[$id]))return;
  foreach($tree[$id] as $li){
    $mid = $li['id'];
    $menu[] = $mid;
    $child = catids($li['id'],$tree);
    if(is_array($child)) $menu =  $menu +$child;
  }
  return $menu;
} 

?>