<?php
function think_center_encrypt($data, $key, $expire = 0){
    $key = md5($key);
    ec($key);
    $data = base64_encode($data);
    ec($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    for($i=0; $i < $len; $i++){
        if($x == $l) $x=0;
        $char .= substr($key, $x, 1);
        $x++;
    }
    ec($char);
    $str = sprintf('%010d', $expire ? $expire + time() : 0);//时间
    ec($str);
    for($i = 0; $i < $len; $i++){
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
    }
    ec($str);
    ec(str_replace('=', '', base64_encode($str)));
    ec(base64_encode($str));
    return str_replace('=', '', base64_encode($str));

}

function ec($str){
    echo $str.'<br>';
}

function aa(){
    for($i=0; $i<257;$i++){
        echo chr($i);
    }
}

function think_ucenter_decrypt($data, $key){
    $key    = md5($key);
    $x      = 0;
    $data   = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data   = substr($data, 10);
    if($expire > 0 && $expire < time()) {
        return '';
    }
    $len  = strlen($data);
    $l    = strlen($key);
    $char = $str = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char  .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }else{
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}

function get_client_ip($type = 0) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
function develop(){
    phpinfo();
}

function get(){
    require_once './Appliaction/Common/Service/DoubanService.class.php';
    require_once './Appliaction/Common/Service/DoubanService.class.php';
}

function run(){
    $fun = $_GET['func'];
    $fun();
}

run();
//echo get_client_ip();
/* ec(aa());
echo $p = think_center_encrypt('hellooooooooooooooooooooooooooooooooooooooooooooo', '197211',10).'<hr>';
echo think_ucenter_decrypt('MDAwMDAwMDAwMJl7jquUqmh2', '197211');

 */?>