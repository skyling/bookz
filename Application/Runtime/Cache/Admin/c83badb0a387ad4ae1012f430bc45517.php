<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/Static/H-UI/lib/html5.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/respond.min.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Public/Static/H-UI/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/Static/H-UI/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/Public/Static/H-UI/lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="/Public/Static/H-UI/lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="/Public/Static/H-UI/lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/Static/H-UI/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title><?php if(!empty($$meta_title)): ?>{$meta_title}<?php else: ?>书志<?php endif; ?></title>
</head>

<body>

<div class="pd-20">
  <form action="<?php echo U();?>" method="post" class="form form-horizontal" id="form-book-add">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>书名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="user-name" name="title" datatype="*2-16" nullmsg="用户名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>ISBN号：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="book-isbn" name="isbn"  datatype="/^(\d[- ]*){9,18}[\dxX]$/" nullmsg="ISBN不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>期数：</label>
      <div class="formControls col-5">
          <input type="text" class="input-text" value="<?php echo get_max_vol();?>" placeholder="" id="vol" name="vol"  datatype="/^\d{1,9}$/" nullmsg="期数不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>所属日期：</label>
      <div class="formControls col-5">
    		<input type="text" onfocus="WdatePicker({minDate:'%y-%M-#{%d}'})" name="today" class="input-text Wdate" style="width:120px;" datatype='*' nullmsg="所属日期不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>标签：</label>
      <div class="formControls col-5 skin-minimal">
		<label class="item"><input name="tagid[]" type="checkbox" value="1"> 标签1</label>
		<label class="item"><input name="tagid[]" type="checkbox" value="2"> 标签2</label>
		<label class="item"><input name="tagid[]" type="checkbox" value="3"> 标签3</label>
		<label class="item"><input name="tagid[]" type="checkbox" value="4"> 标签4</label>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">所属分类：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select class="select" size="1" name="typeid" datatype="*" nullmsg="请选择所属分类！">
          <option value="" selected>请选择所属分类</option>
          <?php $_result=get_type_list();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">简介：</label>
      <div class="formControls col-5">
        <textarea name="brief" cols="" rows="" class="textarea"  placeholder="对本书的简介...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius ajax" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>

<footer class="footer">
  <p>Copyright &copy;2015 书志 All Rights Reserved.<br>
</footer>
<script type="text/javascript" src="/Public/Static/H-UI/lib/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/layer1.8/layer.min.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/laypage/laypage.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/Static/H-UI/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/js/H-ui.admin.doc.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/Validform_v5.3.2.js"></script> 

<script>
	$(function(){
	$("#form-book-add").Validform({
		tiptype:2,
		ajaxPost:true,
		callback:function(data){
			//reload(2);
		},
	});
});
</script> 


 

</body>
</html>