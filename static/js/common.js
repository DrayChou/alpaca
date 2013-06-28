/* ajax 文件上传代码 */
var html4Upload=function(fromfile,toUrl)//,callback)
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
    onUploadCallback(result,true);
  }
  this.start=function(){jForm.submit();jIO.load(_this.onLoad);}
  return this;
   
}

onUploadCallback=function(sText,bFinish)
{
  var data=Object,bOK=false;
  try{data=eval('('+sText+')');}catch(ex){};
  if(data.err===undefined||data.msg===undefined)alert( ' 上传接口发生错误！\r\n\r\n返回的错误内容为: \r\n\r\n'+sText);
  else
  {
    if(data.err)alert(data.err);
    else
    {
      arrMsg.push(data.msg);
      bOK=true;//继续下一个文件上传
    }
  }
  //if(!bOK||bFinish)_this.removeModal();
  if(bFinish&&bOK)onUploadComplete(arrMsg);//全部上传完成
  return bOK;
}



// UPLOAD CLASS  
(function($) {    
  $.fn.upload = function(options) {    
    debug(this);    
    var opts = $.extend({}, $.fn.upload.defaults, options);    
    return this.each(function() {    
      $this = $(this);    
      var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      markup = '<input type="file" onchange="html4Upload(\'file\',\'file\')"/>';
      $this.after(markup);    
    });    
  };    
  // 私有函数：debugging    
  function debug($obj) {    
    if (window.console && window.console.log)    
      window.console.log('upload selection count: ' + $obj.size());    
  };    
  // 定义暴露format函数    
  $.fn.upload.format = function(txt) {    
    return '<strong>' + txt + '</strong>';    
  };    
  // 插件的defaults    
  $.fn.upload.defaults = {    
    foreground: 'red',    
    background: 'yellow'    
  };    
// 闭包结束    
})(jQuery);   
