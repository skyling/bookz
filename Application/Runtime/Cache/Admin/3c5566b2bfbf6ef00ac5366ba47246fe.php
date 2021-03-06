<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/Public/Static/H-UI/favicon.ico" >
<LINK rel="Shortcut Icon" href="/Public/Static/H-UI/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/Static/H-UI/lib/html5.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/respond.min.js"></script>
<script type="text/javascript" src="/Public/Static/H-UI/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Public/Static/H-UI/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/Static/H-UI/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/Public/Static/H-UI/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/Static/H-UI/lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!--[if IE 7]>
<link href="/Public/Static/H-UI/lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="/Public/Static/H-UI/lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/Static/H-UI/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台管理 -书志</title>
<meta name="keywords" content="<?php echo C('KEY_WORDS');?>">
<meta name="description" content="<?php echo C('DESCRIPTION');?>">
</head>
<body>
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="<?php echo U();?>" method="post">
      <div class="row cl">
        <label class="form-label col-3"><i class="iconfont">&#xf00ec;</i></label>
        <div class="formControls col-8">
          <input id="username" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-3"><i class="iconfont">&#xf00c9;</i></label>
        <div class="formControls col-8">
          <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-8 col-offset-3">
          <input name="verify" id="verify" class="input-text size-L" type="text" placeholder="验证码"  style="width:150px;">
          <img id="verifyimg" src="<?php echo U('verify');?>"> <a id="cverify" href="javascript:;">看不清，换一张</a> </div>
      </div>
      <div class="row">
        <div class="formControls col-8 col-offset-3">
          <input id="submit" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright־书志</div>
<script type="text/javascript" src="/Public/Static/H-UI/lib/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Static/H-UI/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script> 
	<script type="text/javascript">
		var chverify = function(){
			$('#cverify').on('click',function(){
				var v = $('#verifyimg');
				var src = v.attr('src')+'?'+Math.random();
				v.attr('src', src);
			});
		}
		var check = function(){
			$("#submit").on('click',function(event){
				var username = $('#username'),
				password = $('#password'),
				verify = $('#verify');
				if(username.val()==''){alert('用户名不能为空');username.focus();return false;}
				if(password.val()==''){alert('密码不能为空'); password.focus();return false;}
				if(verify.val()==''){alert('验证码不能为空'); verify.focus();return false;}
				return true;
			});
		}
		$(document).ready(function(){
			chverify();
			check();
		});
	</script>
</body>
</html>