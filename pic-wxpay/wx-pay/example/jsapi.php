<?php 
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once "WxPay.Config.php";
require_once 'log.php';

//①、获取用户openid
try{
    $total_fee = $_GET['total_fee'];
    $total_fee = floatval($total_fee);
	$tools = new JsApiPay();
	$openId = $tools->GetOpenid();
	$order_no = "yygh".date("YmdHis");
	
	date_default_timezone_set('PRC'); 
	//②、统一下单
	$input = new WxPayUnifiedOrder();
	$input->SetBody("1元购画");
	$input->SetAttach("1元购画");
	$input->SetOut_trade_no($order_no);
	$input->SetTotal_fee($total_fee * 100);
	$input->SetTime_start(date("YmdHis"));
	$input->SetTime_expire(date("YmdHis", time() + 600));
	$input->SetGoods_tag("1元购画");
	$input->SetNotify_url("http://paysdk.weixin.qq.com/notify.php");
	$input->SetTrade_type("JSAPI");
	$input->SetOpenid($openId);
	$config = new WxPayConfig();
	$order = WxPayApi::unifiedOrder($config, $input);
	$jsApiParameters = $tools->GetJsApiParameters($order);
	//获取共享收货地址js函数参数
	$editAddress = $tools->GetEditAddressParameters();
} catch(Exception $e) {
}
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>1元购画支付</title>
    <link href="./weui.css"  rel="stylesheet" type="text/css">
     <script src="./jquery.1.8.3.js"></script>
    <script type="text/javascript">
    var nickname = "<?=$_SESSION['nickname']?>";
    var current_index = "<?=$_GET['current_index']?>";
    var order = "<?=$order_no?>";
    var total_fee = <?=$total_fee?>;

    function stat(){
		$.post('./stat.php',{
			nickname: nickname,
			total_fee: total_fee,
			order: order,
			pic_num: current_index
		}).done(function(res){
		}).error(function(e){
		});
    }
    
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				if(res.err_msg == 'get_brand_wcpay_request:cancel'){
					return;
				}
				if(res.err_msg == 'get_brand_wcpay_request:ok'){
					stat();
					location.href = "../../web/draw.html?username=" + encodeURIComponent(nickname) + "&order=" + current_index;
				}
				if(res.err_msg == 'get_brand_wcpay_request:fail'){
					alert("支付失败！网络异常，请稍后再试");
					location.href = "../../web/index.html";
				}else{
				}
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
  </script>
</head>
<body>
	<div class="weui-cell">
        <div class="weui-cell__bd">
            <p>活动名称</p>
        </div>
        <div class="weui-cell__ft">1元购画捐赠活动</div>
    </div>
	<div class="weui-cell">
        <div class="weui-cell__bd">
            <p>支付金额</p>
        </div>
        <div class="weui-cell__ft"><?=$total_fee?>元</div>
    </div>
    <br/>
	<div align="center">
		<a href="javascript:;" class="weui-btn weui-btn_primary" onclick="callpay()">立即支付</a>
	</div>
</body>
</html>