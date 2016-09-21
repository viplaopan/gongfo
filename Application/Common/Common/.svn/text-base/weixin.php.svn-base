<?php
function get_access_token($token) {
	static $access_token;
	$access_token = S($token . 'weixin_access_token');
	if ($access_token) {//已缓存，直接使用
		return $access_token;
	} else {//获取access_token
		$url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . C('APP_ID') . '&secret=' . C('APP_SECRET');

		$ch1 = curl_init();
		$timeout = 5;
		curl_setopt($ch1, CURLOPT_URL, $url_get);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
		$accesstxt = curl_exec($ch1);
		curl_close($ch1);
		$access = json_decode($accesstxt, true);
		// 缓存数据
		S($token . 'weixin_access_token', $access['access_token'], 7200);
		return $access['access_token'];
	}
}

function get_web_access_token($token) {
	static $access_token;
	$access_token = S($token . 'weixin_access_token');
	if ($access_token) {//已缓存，直接使用
		return $access_token;
	} else {//获取access_token

		$url_get = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . C('APP_ID') . '&secret=' .C('APP_SECRET'). '&code=CODE&grant_type=authorization_code';
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
		$ch1 = curl_init();
		$timeout = 5;
		curl_setopt($ch1, CURLOPT_URL, $url_get);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
		$accesstxt = curl_exec($ch1);
		curl_close($ch1);
		$access = json_decode($accesstxt, true);
//		dump($access);
		// 缓存数据
		S($token . 'weixin_access_token', $access['access_token'], 7200);
		return $access['access_token'];
	}
}
/**
 * 模拟post进行url请求
 * @param string $url
 * @param string $param
 */
function request_post($url = '', $param = '') {
    if (empty($url) || empty($param)) {
        return false;
    }
    
    $postUrl = $url;
    $curlPost = $param;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    
    return $data;
}