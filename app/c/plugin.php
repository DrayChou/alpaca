<?php
class plugin extends base{  
  function __construct()
  {
    parent::__construct();
  }
  
  function load( $plugin , $method ='index',$param1 = '',$param2 = '' )
  {
    load('plugin/'.$plugin.'/c/home')->$method($param1 , $param2);
  }
}

?>