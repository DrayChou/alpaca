<!DOCTYPE html>
<html xmlns="http://www.w3.or/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF8" />
  <title>羊驼!CMS</title>
  <meta name="keywords" content="内容管理系统,CMS"/>
  <meta name="description" content="羊驼CMS"/>
  <link type="text/css" rel="stylesheet" href="<?=BASE?>static/admin.css" />
  <script charset="utf-8" src="<?=BASE?>static/ke/kindeditor-min.js"></script>
  <script charset="utf-8" src="<?=BASE?>static/js/jquery-1.7.1.min.js"></script>
  <script> 
    $(function(){
      $('textarea[class="ke"]').each(
        function(){
          eid = $(this).attr('id');
          KindEditor.create('#'+eid, {
              width : '670px',
              height: '400px',
              cssPath : '<?=BASE?>static/alpa.css',
              uploadJson : '<?=BASE?>file/upload/',
              fileManagerJson : '<?=BASE?>file/filemanager/',
              allowFileManager : true
          });
        }
      );
    });
    
    var del = function(id){
      var ret = confirm('您是要删除选定项么？');
      if(!ret)return;
      $.post('<?=BASE?>admin/elem/del/'+ id ,function(){window.location.reload();});
    }

    var mdel = function(){
      var ret = confirm('您是要删除选定项么？');
      if(!ret)return;
      sarr = $(".sid:checked").serialize();
      $.post('<?=BASE?>admin/page/mdel/',sarr,function(){window.location.reload();});
    }

    var move = function(){
      moveto = $('#moveto').val();
      if(moveto == '')return;
      var ret = confirm('您是要移动选定项么？');
      
      if(!ret)return;
      sarr = $(".sid:checked").serialize();
      $.post('<?=BASE?>admin/page/move/'+ moveto + '/',sarr,function(){window.location.reload();});
    }
  </script>
</head>
<body>
  <div id="menu" ><ul>
    <?php 
    foreach( $menu as $url => $label )
    {?>
      <li <?=$url==seg(1)?' class="hover" ':''?> ><a href="<?=BASE?>admin/<?=$url?>/index/" ><?=$label?></a></li>
    <?php }
    ?>
    
    <li id="preview" ><a href="<?=BASE?>" target="_blank">预览网站</a></li>
  </ul></div>
  
  <?php if(isset($submenu)):?>
  <div id="submenu" ><ul>
    <?php 
    foreach( $submenu as $url => $label )
    {?>
      <li <?=$url==seg(2)?' class="hover" ':''?> ><a href="<?=BASE?>admin/<?=seg(1)?>/<?=$url?>/" ><?=$label?></a></li>
    <?php }
    ?>
  </ul></div>
  <?php endif;?>
  
  <div id="content" >
    <?=$content?>
  </div>
  <div id="footer" > <a href="http://alpaca.b24.cn/" >羊驼！CMS</a> &copy; 2012 </div>
</body>
</html>
