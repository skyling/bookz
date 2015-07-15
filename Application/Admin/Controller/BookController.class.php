<?php
namespace Admin\Controller;

class BookController extends BaseController
{
    /**
     * 书籍管理主页
     * 
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月13日 上午10:39:17
     */
    function index($catid='', $start='', $end='', $p='0'){
        $m = D('Booklist');
        $map=array(
            
        );
        $limit = page_limit($p);
        $order = 'id desc';
        $data = $m->where($map)->order($order)->limit($limit)->select();
        $this->assign('info', $data);//列表数据
        $this->display();
    }
    
    /**
     * 书籍添加
     * 
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月13日 上午10:39:34
     */
    function add(){

        if(IS_POST || IS_AJAX){
            //Booklist 数据添加
            $m_booklist = D('Booklist');
            $data_list = $m_booklist->create();//获取提交数据
            if(!$data_list) $this->ajaxReturn(ajax_return_data(1, $m_booklist->getError()), 'JSON');//返回错误信息
            $s_douban = D('Douban', 'Service');//豆瓣服务

            //获取书本信息
            $doubanJson = $s_douban->getBookInfoByIsbn(I('post.isbn'));//获取豆瓣请求数据
            if(!$doubanJson->id)  $this->ajaxReturn(C('AJAX_STATUS.DB_FAULT'), 'JSON');

            //写入BookList
            $data_list['bookid'] = $doubanJson->id;
            if(!$m_booklist->create($data_list)) $this->ajaxReturn(ajax_return_data(1, $m_booklist->getError()), 'JSON');//返回错误信息

            $m_booklist->startTrans();   //开启事务
            $m_booklist->add($data_list);//添加数据
            //写入BookInfo
            $m_bookinfo = D('Bookinfo');
            $data_info = array(
                "bookid"=> $doubanJson->id,
                "title"=> $doubanJson->title,
                "author"=> $doubanJson->author,
                "price"=> $doubanJson->price,
                "pubdate"=> $doubanJson->pubdate,
                "images"=> $doubanJson->images,
                "publisher"=> $doubanJson->publisher,
                "isbn"=> $doubanJson->isbn13,
                "catalog"=> $doubanJson->catalog,
                "summary"=> $doubanJson->summary,
                "author_intro"=> $doubanJson->author_intro,
            );
            $data_info = $m_bookinfo->create($data_info);
            if($m_bookinfo->add($data_info)){
                $m_booklist->commit();//提交
                $this->ajaxReturn(ajax_return_data(0, '添加成功！'), 'JSON');
            }else{
                $m_booklist->rollback();//回滚
                $this->ajaxReturn(ajax_return_data(1, $m_booklist->getError()), 'JSON');
            }
        }else{
            $this->display();
        }


    }

    /**
     * 显示详情
     */
    function show($id=''){
        if(!$id) redirect(U('Index/index'));
        $m_booklist = D('Booklist');
        $m_bookinfo = D('Bookinfo');

        //获取boookid
        $field = 'uid,typeid,tagid,title,brief,annocount,vol,bookid,today,create_time,update_time,view,annopage,status';
        $data_list = $m_booklist->getItem($id, $field);
        var_dump($data_list);
        $field = 'title,author,price,pubdate,images,publisher,create_time,isbn,update_time,status,catalog,summary,author_intro';
        $data_info = $m_bookinfo->getItem($data_list['bookid'], $field);
        $data = array_merge($data_list, $data_info);
        $this->assign('info', $data);
        $this->display();
    }

    public function edit(){
        echo "编辑";
    }
    
    
    function delete($id){
        parent::delete('Booklist',$id);
    }
    
    
    function get(){
        $j = D('Json');
        $bookinfo = $j->getBookinfo('9787020042494');
        dump($bookinfo);
    }
}

?>