<?php
namespace Common\Service;
/**
 * Class DoubanService
 * @package Common\Service
 * 豆瓣服务 使用模型有 DBJosonModel
 */
class DoubanService extends Service{


    /**
     * 根据ISNB获取图书信息
     * @param $isbn
     * @return mixed|void
     */
    public function getBookInfoByIsbn($isbn){
        $params['isbn'] = $isbn;
        $ret = $this->getData('DOUBAN.ISBN', $params);
        return $ret;
    }
    
    /**
     * 根据id获取图书信息
     * @param $id
     * @return mixed|void
     */
    public function getBookInfoByID($id){
        $params['id'] = $id;
        $ret = $this->getData('DOUBAN.ID', $params);
        return $ret;
    }
    
    /**
     * 获取某本图书的所有笔记
     * @param $id
     * @param $start
     * @param $count
     * @return mixed|string
     */
    public function getBookAnnotations($id, $p){
        $params['id'] = $id;
        $count = C('DOUBAN.ACOUNT');
        $params['start'] = $count*$p;
        $params['count'] = $count;
        $ret = $this->getData('DOUBAN.ANNOTATIONS', $params);
        return $ret;
    }
    
    /**
     * 获取数据
     * @param $url
     * @param $params
     * @return mixed|string
     */
    private function getData($url, $params){
        $type = $url;
        if(!$params || !$url)return '';
        $url = C($url);
        foreach($params as $key=>$value){
            $pattram = "/:$key/i" ;
            $url = preg_replace($pattram, $value, $url);
        }

        //先从数据库中获取该数据,若该数据不存在则从豆瓣API获取
        $m_dbjson = D('Dbjson');
        $ret = json_decode($m_dbjson->getJson($url));
        if(!$ret){
            $ret = $this->curl_get($url);
            $m_dbjson->setJson($type, $url, json_encode($ret)); //添加到dbjson数据库中
        }
        return $ret;
    }
    
}

?>