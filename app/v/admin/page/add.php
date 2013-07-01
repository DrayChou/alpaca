<script>
$(function(){
  $('.sidebar .box').hide();
  $('#first').show();
  $('.upload').change(function(){
    upload = html4Upload(this,'<?=BASE?>file/upload/');
    upload.start();
  });
  $('.sidebar h4').click( function(){ $('.sidebar .box').hide(); $(this).next().fadeIn();});
});
 
var html4Upload=function(fromfile,toUrl)
{
  var uid = new Date().getTime(),idIO='jUploadFrame'+uid,_this=this;
  var jIO=$('<iframe name="'+idIO+'" class="xheHideArea" />').appendTo('body');
  var jForm=$('<form action="'+toUrl+'" target="'+idIO+'" method="post" enctype="multipart/form-data" class="xheHideArea"></form>').appendTo('body');
  var jOldFile = $(fromfile),jNewFile = jOldFile.clone().attr('disabled','true');
  jOldFile.before(jNewFile).appendTo(jForm);
  this.remove=function()
  {
    if(_this!==null)
    {
      jNewFile.before(jOldFile).remove();
      jIO.remove();jForm.remove();
      _this=null;
    }
  }
  this.onLoad=function(){
    var ifmDoc=jIO[0].contentWindow.document,result=$(ifmDoc.body).text();
    ifmDoc.write('');
    _this.remove();
    onUploadCallback(result,true,fromfile);
  }
  this.start=function(){jForm.submit();jIO.load(_this.onLoad);}
  return this;
   
}

onUploadCallback=function(sText,bFinish,fromfile)
{
  var data=Object,bOK=false;
  try{data=eval('('+sText+')');}catch(ex){};
  if(data.error)alert( ' 上传接口发生错误！\r\n\r\n返回的错误内容为: \r\n\r\n'+data.message);
  else
  {
    fid = $(fromfile).attr('id');
    $('#' + fid + '_val' ).val(data.url);
    $('#' + fid + '_preview' ).html('<img width="100" src="' + data.url + '" />');
    bOK=true;
  }
  if(bFinish && bOK)alert("上传完成！")
  return bOK;
}

</script>
<div id="breadcrumb" ><?=admin_breadcrumb($rel_id);?></div>

<form method="POST" >
<input type="hidden" name="mod" value="page" >
<input type="hidden" name="info[model]" value="<?=$modid?>" > 
<div class="col75">
    <span class="model" >页面模型
      <?php foreach($model as $m){?>
      <a href="?model=<?=$m['id']?>" <?=$modid==$m['id']?'class="active"':''?> ><?=$m['title']?></a> ,
      <?php }?>
    </span>

    <div>
      <input type="text" name="title" placeholder="标题"  value="<?=isset($val['title'])?$val['title']:''?>" id="input_title" > 
      <span class="error" ><?=isset($err['title'])?$err['title']:''?></span>
    </div>
    <div>
    </div>
  
 
  <?php
  if(isset($cur_mod['fields'][0])){
  $i = 1000;
  foreach($cur_mod['fields'] as $field){
    $i++;
    ?>
  
    <h5><?=$field['label']?></h5>
    <div>
      <?php 
      $fname = $field['name'];
      $fval = isset($val['info'][$fname])?$val['info'][$fname]:'';
      switch($field['model']){
        case 'pic':
          echo '<input type="hidden" name="info['.$fname.']" id="f'.$i.'_val" class="text" size="30" value="'.$fval.'" />
          <input type="file" name="imgFile" class="upload" id="f'.$i.'" />
          <div id="f'.$i.'_preview" class="upload_preview" >'.($fval?'<img src="'.$fval.'" />':'').'</div>
          ';
          break;

        case 'mtext':
          echo '<textarea type="text" name="info['.$fname.']" id="f'.$i.'"   class="text" cols="40" rows="5" />'.$fval.'</textarea>';
          break;
          
        case 'rte':
          echo '<textarea type="text" class="ke" name="info['.$fname.']"  id="f'.$i.'"  cols="40" rows="5" />'.$fval.'</textarea>';
          break;

        case 'radio':
          echo '<select name="info['.$fname.']"  id="f'.$i.'" ><option></option>';
          $options = explode("\n",$field['enum']);
          foreach($options as $o){
            echo '<option '.($o == $fval ? 'selected':'' ).'>'.$o.'</option>';
          }
          echo '</select> ';
          break;
        
        case 'checkbox':
          $options = explode("\r\n",$field['enum']);
          foreach($options as $o){
            echo '  <input type="checkbox"  name="info['.$fname.'][]" '.(is_array($fval) && in_array( $o, $fval) ? 'checked':'' ).' value="'.$o.'" >'.$o ;
          }
          break;
        
        default:
          echo '<input type="text" name="info['.$fname.']" id="f'.$i.'"   value="'.$fval.'"/>';
          break;
      }
      ?>
    </div>
  
 
  
  <?php }}?>
  
   <div><br /><input type="submit" class="submit-button" value="确认提交" ></div>
</div>
<div class="col25 sidebar">
  <h4> 选项</h4>
  <div class="box" id="first" >
    <div>页面名称 (url)</div>
    <div>
      <input type="text" name="elem_name" value="<?=isset($val['elem_name'])?$val['elem_name']:''?>" >
    </div>
    <div>标签</div>
    <div>
      <input type="text" name="tags" value="<?=isset($val['tags'])?$val['tags']:''?>"  ><br />  逗号分隔多个标签
    </div>
    
    <div>发布时间</div>
    <div>
         <input type="text" name="post_time" value="<?=isset($val['post_time'])?date('Y-m-d H:m:s',$val['post_time']):date('Y-m-d H:m:s')?>" /> 
    </div>
  </div>
  
  
  <h4> SEO </h4>
  <div class="box" >
   
    <div>
      <span class="error" ><?=isset($err['elem_name'])?$err['elem_name']:''?></span>
    </div>
  
  
    <div>网页标题</div>
    <div>
      <input type="text" name="info[page_title]" value="<?=isset($val['info']['page_title'])?$val['info']['page_title']:''?>" >
    </div> 
    <div>meta:keywords</div>
    <div>
      <input type="text" name="info[meta_keywords]" value="<?=isset($val['info']['meta_keywords'])?$val['info']['meta_keywords']:''?>">
    </div> 
    <div>meta:description</div>
    <div>
      <input type="text" name="info[meta_description]" value="<?=isset($val['info']['meta_description'])?$val['info']['meta_description']:''?>" >
    </div>
 </div>
 <h4>模板排版</h4> 
 <div class="box">
  <div>风格</div>
    <div>
      <input name="info[template]" type="text" value="<?=isset($val['info']['template'])?$val['info']['template']:''?>" >
    </div> 
  
    <div>排版</div>
    <div>
      <input name="info[layout]" type="text" value="<?=isset($val['info']['layout'])?$val['info']['layout']:''?>" >
    </div> 
 </div>
  
<h4>栏目选项</h4>
<div class="box" > 
   <div>
     <input type="checkbox" value="1" name="info[dir]" <?=isset($val['info']['dir'])&& $val['info']['dir']?'checked="true"':'' ?> /> 
     栏目页
     <br />
      每页显示   <input class="text" style="width:20px;" value="<?=isset($val['info']['page_size'])?$val['info']['page_size']:'20'?>" size="3" type="text" name="info[page_size]" />  条
      <br />
      <input type="checkbox" name="info[child_dir]" value="1" <?=isset($val['info']['child_dir'])&& $val['info']['child_dir']?'checked="true"':'' ?> /> 显示子栏目
      <br />
      <input type="checkbox" name="info[grandchild]" value="1" <?=isset($val['info']['grandchild'])&& $val['info']['grandchild']?'checked="true"':'' ?> /> 显示孙页面
   </div>
</div>
<h4> 子页面设置</h4>
<div class="box" > 
      <ul class="admin_list_menu">
      <li> <b> </b>  </li>
      <li>
      默认风格 
      <input type="text" name="info[child_template]" value="<?=isset($val['info']['child_template'])?$val['info']['child_template']:''?>" />
      </li>

      <li> 
      默认排版
      <input type="text" name="info[child_layout]" value="<?=isset($val['info']['child_layout'])?$val['info']['child_layout']:''?>" />
      </li>
      
      <li>
      原型
     <select name="info[child_model]">
        <?php foreach($model as $v){?>
          <option value="<?=$v['id']?>" <?=isset($val['info']['child_model']) && $val['info']['child_model']==$v['id']?' selected ':''?>><?=$v['title']?></option>
        <?php }?>
      </select>  
      </li>
     </ul> 
     
     <ul class="admin_list_menu">
      <li> <b>子页面前台操作权限 </b> </li>
      <li> 
  浏览 <select name="info[user_browse]">
        <option value="0" > 用户级 </option>
        <?php for($i=0;$i<11;$i++){?>
        <option value="<?=$i?>" <?=isset($val['info']['user_browse']) && $val['info']['user_browse']==$i?' selected ':''?>><?=$i?></option>
        <?php }?>
      </select>
      </li>

      <li>
  添加 <select name="info[user_add]">
        <option value="10" > 用户级 </option>
        <?php for($i=0;$i<11;$i++){?>
        <option value="<?=$i?>" <?=isset($val['info']['user_add']) && $val['info']['user_add']==$i?' selected ':''?>><?=$i?></option>
        <?php }?>
      </select>
      </li>
   <!--    
      <li>
 编辑 <select name="info[user_edit]">
        <option value="10" > 用户级 </option>
        <?php for($i=0;$i<11;$i++){?>
        <option value="<?=$i?>" <?=isset($val['info']['user_edit']) && $val['info']['user_edit']==$i?' selected ':''?>><?=$i?></option>
        <?php }?>
      </select> 
      </li>     
      <li>
  删除 <select name="info[user_del]">
        <option value="10" > 用户级 </option>
        <?php for($i=0;$i<11;$i++){?>
        <option value="<?=$i?>" <?=isset($val['info']['user_del']) && $val['info']['user_del']==$i?' selected ':''?>><?=$i?></option>
        <?php }?>
      </select> 
     
      </li> 
     -->
     </ul>  
 <div class="clear" ></div>
        
        </div>
    </div> 
   
   </div>

   </form>
<div class="clear" ></div>