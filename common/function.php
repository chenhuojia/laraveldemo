<?php
/**
 * curl异步请求
 * @param unknown $url
 * @param string $post
 * @param string $cookie
 * @param number $returnCookie
 * @return string|unknown
 * ***/
function http_curl($url,$post=[],$cookie='', $returnCookie=0){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    if($post) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));

    }
    if($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    }
    curl_setopt($curl, CURLOPT_HEADER, $returnCookie);

    $data = curl_exec($curl);
    if (curl_errno($curl)) {
        return curl_error($curl);
    }
    curl_close($curl);
    if($returnCookie){
        list($header, $body) = explode("\r\n\r\n", $data, 2);
        preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
        $info['cookie']  = substr($matches[1][0], 1);
        $info['content'] = $body;
        return $info;
    }else{
        return $data;
    }
}
function getRandChar($length=32) {
    $str=null;
    $strPol='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max=strlen($length)-1;
    for ($i=0;$i<$length;$i++){
        $str .=$strPol[rand(0,$max)];
    }
    return $str;
}

/**
 * [unique_arr 去除二维数组重复值]
 * @return [type] [返回值是二维数组]
 */
function unique_arr($array2D,$stkeep=false,$ndformat=true){

    // 判断是否保留一级数组键 (一级数组键可以为非数字)
    if($stkeep) $stArr = array_keys($array2D);	//返回数据的下标

    // 判断是否保留二级数组键 (所有二级数组键必须相同)
    if($ndformat) $ndArr = array_keys(end($array2D));	//返回二维数组的最后一个下标

    //降维,也可以用implode,将一维数组转换为用逗号连接的字符串,结果是索引一维数组
    foreach ($array2D as &$v){
        if(isset($v['pivot']))
        {
            unset($v['pivot']);
        }
        $v = implode(",",$v);
        $temp[] = $v;
    }

    //去掉重复的字符串,也就是重复的一维数组
    $temp = array_unique($temp);

    //再将拆开的数组重新组装
    foreach ($temp as $k => $v)
    {
        if($stkeep) $k = $stArr[$k];
        if($ndformat)
        {
            $tempArr = explode(",",$v);
            foreach($tempArr as $ndkey => $ndval) $output[$k][$ndArr[$ndkey]] = $ndval;
           
        }
        else $output[$k] = explode(",",$v);
    }

    return $output;
}

/**
 * 返回错误信息页面提示
 * @param null $message
 * @param null $url
 * @param null $view
 * @param string $type
 * @param int $wait
 * @return \Illuminate\Http\Response
 */
function viewError($message = null, $url = null, $type = 'error' ,$view = null, $wait = 3)
{
    $view = $view ? $view : 'admin.public.'.$type;

    return response()->view($view,[
        'url'=> $url ? route($url) : '/',
        'message'=>$message ? $message : '发生错误,请重试!',
        'wait' => $wait,
    ]);
}
