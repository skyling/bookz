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
  <div class="text-c">
  <span class="select-box" style="width:150px"><select name="" class="select">
  <option value="0">全部分类</option>
  <?php $_result=get_type_list();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
  </select></span> 日期范围：
    <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
    -
    <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
    <input type="text" name="" id="" placeholder=" 书本名称" style="width:250px" class="input-text"><button name="" id="" class="btn btn-success" type="submit"><i class="icon-search"></i> 搜资讯</button>
  </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20">
  <span class="l">
  <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
  <i class="icon-trash"></i> 
  	批量删除
  </a> 
  <a class="btn btn-primary radius" onclick="article_add('1000','','添加书籍','<?php echo U('Book/add');?>')" href="javascript:;">
  <i class="icon-plus"></i> 添加书籍</a>
  </span> 
  <span class="r">共有数据：<strong>54</strong> 条</span> 
  </div>
  <table class="table table-border table-bordered table-bg table-hover table-sort">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="80">ID</th>
        <th>标题</th>
        <th width="120">所属日期</th>
        <th width="80">分类</th>
        <th width="80">标签</th>
        <th width="80">来源</th>
        <th width="120">创建时间</th>
        <th width="75">调用次数</th>
        <th width="60">发布状态</th>
        <th width="70">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
        <td><input type="checkbox" value="" name=""></td>
        <td><?php echo ($vo["id"]); ?></td>
        <!--<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('<?php echo ($vo["id"]); ?>','1000','','查看','<?php echo U('show',array(id=>$vo[id]));?>')" title="查看"><?php echo ($vo["title"]); ?></u></td>-->
            <td class="text-l"><a style="cursor:pointer" class="text-primary" href="<?php echo U('show',array(id=>$vo[id]));?>" title="查看"><?php echo ($vo["title"]); ?></a></td>
        <td><?php echo ($vo["today"]); ?></td>
        <td><?php echo ($vo["typeid"]); ?></td>
        <td><?php echo ($vo["tagid"]); ?></td>
        <td><?php echo get_field_by_id('Admin', $vo[uid], 'username');?></td>
        <td><?php echo (date('Y-m-d H:i:s',$vo["create_time"])); ?></td>
        <td><?php echo ($vo["view"]); ?></td>
        <td class="article-status">
        	<?php if(($vo[status]) == "1"): ?><span class="label label-success radius">已启用</span>
        	<?php else: ?>
        	<span class="label radius">已禁用</span><?php endif; ?>
        </td>
        <td class="f-14 article-manage">
        <a style="text-decoration:none"  class="ajax-get" href="<?php echo U('setStatus',array('model'=>'Booklist','id'=>$vo['id'], 'status'=>(1-$vo['status'])));?>" title="禁用"><?php if(($vo[status]) == "1"): ?><i class="icon-hand-down"></i><?php else: ?><i class="icon-hand-up"></i><?php endif; ?></a> 
        <a style="text-decoration:none" class="ml-5" href="<?php echo U('edit',array('id'=>$vo[id]));?>" title="编辑"><i class="icon-edit"></i></a>
        <a style="text-decoration:none" class="ml-5 ajax-get" href="<?php echo U('delete',array('id'=>$vo[id]));?>" title="删除"><i class="icon-trash"></i></a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
  <div id="pageNav" class="pageNav"></div>
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