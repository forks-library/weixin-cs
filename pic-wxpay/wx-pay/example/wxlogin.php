<?php
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once "WxPay.Config.php";
require_once '../../config.php';

$appid='wx9ce9eb92e1fdd2ff';
$pictureorder=$_GET['pictureorder'];
if(empty($pictureorder)){
    $pictureorder = '';
}
$redirect_uri = urlencode (WEBSITE.'/pic-wxpay/wx-pay/example/getUserInfo.php?pictureorder='.$pictureorder );
$url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
header("Location:".$url);