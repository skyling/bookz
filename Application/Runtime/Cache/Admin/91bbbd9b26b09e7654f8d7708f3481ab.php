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

    <nav class="breadcrumb">
<i class="iconfont">&#xf012b;</i> 首页 
<span class="c-gray en">&gt;</span>
 资讯管理 <span class="c-gray en">&gt;</span>
  资讯列表 
  <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:window.location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a>
  <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:window.history.forward();" title="前进" ><i class="icon-arrow-right"></i></a>
  <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:window.history.back();" title="后退" ><i class="icon-arrow-left"></i></a>
  </nav>
  

    <div class="pd-20">
        <?php echo dump($info);?>
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


 

</body>
</html>