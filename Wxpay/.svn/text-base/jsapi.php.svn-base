<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

$logHandler= new CLogFileHandler("logs/".date('Y-m-d').'.log');

$log = Log::Init($logHandler, 15);

$tools = new JsApiPay();
$openid = $_GET["openid"];

$hpno = $_GET["hpno"];
$xlno = $_GET["xlno"];
$gpno = $_GET["gpno"];

$conn=mysql_connect('localhost', 'root', 'c46d3e0b7a');
mysql_select_db('xiaoye', $conn);
	
$hpdata = mysql_query("SELECT * FROM `onethink_hp` WHERE id='$hpno'");
$hprow = mysql_fetch_array($hpdata);
$hpfee = $hprow["fee"];
$xldata = mysql_query("SELECT * FROM `onethink_xl` WHERE id='$xlno'");
$xlrow = mysql_fetch_array($xldata);
$xlfee = $xlrow["fee"];
$gpdata = mysql_query("SELECT * FROM `onethink_gp` WHERE id='$gpno'"); 
$gprow = mysql_fetch_array($gpdata);
$gpfee = $gprow["fee"];
$fee = ($hpfee + $xlfee + $gpfee)*100;

if ($fee=='0'){
	$url = "http://www.tianyouqifu.com/index.php?s=/Weixin/Index/dorecord.html&hpno=$hpno&xlno=$xlno&gpno=$gpno&openid=$openid";

	header("location:".$url);
}


$input = new WxPayUnifiedOrder();
$input->SetBody("随喜");
$input->SetAttach("随喜赞叹");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee($fee);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("随喜");
$input->SetNotify_url("http://www.tianyouqifu.com/Wxpay/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openid);
$order = WxPayApi::unifiedOrder($input);
$jsApiParameters = $tools->GetJsApiParameters($order);


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<title>贡品</title>
	<script type="text/javascript" src="../Public/js/flexible.js"></script>
	<script type="text/javascript" src="../Public/js/pageloading.js"></script>
	<link type="text/css" rel="stylesheet" href="../Public/css/tribute.css">
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+res.err_desc+res.err_msg);
				if(res.err_msg == "get_brand_wcpay_request:ok"){
					window.location.href="http://www.tianyouqifu.com/index.php?s=/Weixin/Index/dorecord.html&&hpno=<?php echo $hpno; ?>&xlno=<?php echo $xlno; ?>&gpno=<?php echo $gpno; ?>&openid=<?php echo $openid; ?>";
				}else{
					alert(res.err_code+res.err_desc+res.err_msg);
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
	<div class="tribute">
		<div class="chooseRow">
			<div class="flower ch" data-name="花篮">
				<img src="../Public/pic/hp<?php echo $hpno; ?>.png" alt="空花篮">
			</div>
			<div class="stove ch" data-name="香炉">
				<img src="../Public/pic/xl<?php echo $xlno; ?>.png" alt="空香炉">
			</div>
			<div class="fruit ch" data-name="果盘">
				<img src="../Public/pic/gp<?php echo $gpno; ?>.png" alt="空果盘">
			</div>
		</div>
		<div class="chooseBox">
			<ul class="chooselist flower">
				<li>
					<img src="../Public/pic/hp1.png" alt="花篮">
					<span class="money">免费</span>
				</li>
				<li>
					<img src="../Public/pic/hp2.png" alt="花篮">
					<span class="money">0.28元</span>
				</li>
				<li>
					<img src="../Public/pic/hp3.png" alt="花篮">
					<span class="money">0.58元</span>
				</li>
				<li>
					<img src="../Public/pic/hp4.png" alt="花篮">
					<span class="money">0.88元</span>
				</li>
			</ul>
			<ul class="chooselist stove">
				<li>
					<img src="../Public/pic/xl1.png" alt="香炉">
					<span class="money">免费</span>
				</li>
				<li>
					<img src="../Public/pic/xl2.png" alt="香炉">
					<span class="money">2.68元</span>
				</li>
				<li>
					<img src="../Public/pic/xl3.png" alt="香炉">
					<span class="money">5.68元</span>
				</li>
				<li>
					<img src="../Public/pic/xl4.png" alt="香炉">
					<span class="money">8.88元</span>
				</li>
			</ul>
			<ul class="chooselist fruit">
				<li >
					<img src="../Public/pic/gp1.png" alt="果盘">
					<span class="money">免费</span>
				</li>
				<li>
					<img src="../Public/pic/gp2.png" alt="果盘">
					<span class="money">0.88元</span>
				</li>
				<li>
					<img src="../Public/pic/gp3.png" alt="果盘">
					<span class="money">1.88元</span>
				</li>
				<li>
					<img src="../Public/pic/gp4.png" alt="果盘">
					<span class="money">2.88元</span>
				</li>
			</ul>
		</div>
		<div class="chooseBtn">
			<a type="button"></a>
		</div>
	</div>
	<div class="pagetips" style="display:block;">
	    <div class="title">随喜赞叹</div>
	    <div class="cont">
	        您的供佛发心，付费贡品善款皆用于本系统技 术研发和供养寺院师傅，若您经济困难可使用 免费贡品，心诚则灵
	    </div>
	    <ul class="ptbtn">
	        <li><a onclick="callpay()">好</a></li>
	    </ul>
	</div>
	<script src="../Public/js/zepto.min.js"></script>

</script>
</body>
</html>