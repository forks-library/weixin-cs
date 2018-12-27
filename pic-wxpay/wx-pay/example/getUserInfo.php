<?php
require_once '../../config.php';
session_start();
function getJson($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return json_decode($output, true);
}
function link_urldecode($url) {
	$uri = '';
	$cs = unpack('C*', $url);
	$len = count($cs);
	for ($i=1; $i<=$len; $i++) {
		$uri .= $cs[$i] > 127 ? '%'.strtoupper(dechex($cs[$i])) : $url{$i-1};
	}
	return $uri;
}

$appid = "wx9ce9eb92e1fdd2ff";
$secret = "29376cc3c6acbecad5e41678f399d7d4";
$code = $_GET["code"];


$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
$oauth2 = getJson($oauth2Url);

$access_token = $oauth2["access_token"];
$openid = $oauth2['openid'];
$get_user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$userinfo = getJson($get_user_info_url);
var_export($userinfo);
$nickname =  $userinfo['nickname'];
$_SESSION['nickname'] = $nickname;

$pictureorder=$_GET['pictureorder'];
if(empty($pictureorder)){
    $pictureorder = '';
}

$index_url = link_urldecode(WEBSITE.'/pic-wxpay/web/index.html?username='.$nickname.'&pictureorder='.$pictureorder);
header("Location:".$index_url);
