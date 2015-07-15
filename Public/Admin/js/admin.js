//后台js文件
/**
 * 定时刷新
 * @param t
 */
var reload = function(t){
    setTimeout(function(){
        window.location.reload();
    },t);
}
/**
 * 定时跳转
 * @param url
 * @param t
 */
var redirect = function(url,t){
    setTimeout(function(){
        window.location.href = url;
    },t);
}

function set_status(obj,id,url){
	var status = $(obj).attr('data-status');
	if(status == 1){
		$(obj).parents("tr").find(".article-manage").prepend('<a style="text-decoration:none" data-status=\''+(1-status)+'\' onClick="set_status(this,\''+id+'\',\''+url+'\')" href="javascript:;"  title="启用"><i class="icon-hand-up"></i></a>');
		$(obj).parents("tr").find(".article-status").html('<span class="label radius">已禁用</span>');
		$(obj).remove();
	}else{
		$(obj).parents("tr").find(".article-manage").prepend('<a style="text-decoration:none" data-status=\''+(1-status)+'\' onClick="set_status(this,\''+id+'\',\''+url+'\')" title="禁用"><i class="icon-hand-down"></i></a>');
		$(obj).parents("tr").find(".article-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
	}
	layer.msg(url+status+'='+id,1,9);
}



/**
 * ajax删除
 * @param obj
 * @param id
 * @param url
 * @returns
 */
function ajax_get(){
	$(".ajax-get").on('click',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		layer.confirm('确认此操作？',function(index){
			ajaxget(url,function(msg){
				if(msg.status == 'y'){
					layer.msg(msg.info,1,9);
					reload(1000);
				}else{
					layer.msg(msg.info,1);
				}
			});
		});
	});
}

/**
 * ajax get异步请求
 */
var ajaxget = function(url,fun){
    $.get(url,function(msg){
    	fun(msg);
    });
};

var table_sort = function(){
	var tabs = $('.table-sort').html();
	if(tabs != undefined){
		$('.table-sort').dataTable({
			"lengthMenu":false,//显示数量选择 
			"bFilter": false,//过滤功能
			"bPaginate": false,//翻页信息
			"bInfo": false,//数量信息
			"aaSorting": [[ 1, "desc" ]],//默认第几个排序
			"bStateSave": true,//状态保存
			"aoColumnDefs": [
			  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
			  {"orderable":false,"aTargets":[0,-1]}// 制定列不参与排序
			]
		});
	}
	
}

/**
 * 调用函数
 */
$(function(){
	ajax_get();//ajaxget操作
	table_sort();
});
