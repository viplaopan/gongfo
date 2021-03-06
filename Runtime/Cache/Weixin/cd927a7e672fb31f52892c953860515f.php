<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<title>贡品</title>
	<script type="text/javascript" src="/Public/Weixin/js/flexible.js"></script>
	<script type="text/javascript" src="/Public/Weixin/js/pageloading.js"></script>
	<link type="text/css" rel="stylesheet" href="/Public/Weixin/css/tribute.css?v=120212012">
</head>
<body>
	<div class="tribute">
		<form name="wxpay" id="wxpay" action="Wxpay/jsapi.php" method="get">
			<input type="hidden" name="openid" value="<?php echo $openid?>">
		<div class="chooseRow">
			<div class="flower ch" data-name="花篮">
				<img src="/Public/Weixin/pic/hp_no2.png" alt="空花篮">
				<input type="hidden" name="hpno" value="0">
			</div>
			<div class="stove ch" data-name="香炉">
				<img src="/Public/Weixin/pic/xl_no2.png" alt="空香炉">
				<input type="hidden" name="xlno" value="0">
			</div>
			<div class="fruit ch" data-name="果盘">
				<img src="/Public/Weixin/pic/gp_no2.png" alt="空果盘">
				<input type="hidden" name="gpno" value="0">
			</div>
		</div>
		<div class="chooseBox">
			<ul class="chooselist flower">
				<?php for($i=0; $i<count($hpdata); $i++) {?>
				<li>
					<img src="/Public/Weixin/pic/hp<?php echo $hpdata[$i]["id"]?>.png" alt="花篮">
					<span id="<?php echo $hpdata[$i]["id"]?>" class="money"><?php if($hpdata[$i]["fee"] == "0"){echo "免费";} else { echo $hpdata[$i]["fee"]."元";}?></span>
				</li>
				<?php }?>
			</ul>
			<ul class="chooselist stove">
				<?php for($i=0; $i<count($xldata); $i++) {?>
				<li>
					<img src="/Public/Weixin/pic/xl<?php echo $xldata[$i]["id"]?>.png" alt="花篮">
					<span id="<?php echo $xldata[$i]["id"]?>" class="money"><?php if($xldata[$i]["fee"] == "0"){echo "免费";} else { echo $xldata[$i]["fee"]."元";}?></span>
				</li>
				<?php }?>
			</ul>
			<ul class="chooselist fruit">
				<?php for($i=0; $i<count($gpdata); $i++) {?>
				<li>
					<img src="/Public/Weixin/pic/gp<?php echo $xldata[$i]["id"]?>.png" alt="花篮">
					<span id="<?php echo $gpdata[$i]["id"]?>" class="money"><?php if($gpdata[$i]["fee"] == "0"){echo "免费";} else { echo $gpdata[$i]["fee"]."元";}?></span>
				</li>
				<?php }?>
			</ul>
		</div>
		<div class="chooseBtn">
			<a href="javascript:;" title="确定贡品"></a>
		</div>
		</form>
	</div>
	<script src="/Public/Weixin/js/zepto.min.js"></script>
	<script>
		$(function(){

			$('ul.chooselist>li').on('tap', function(){
				var index = $(this).parent().index(),
				src = $(this).find('img').attr('src');
				$(this).parents('.chooseBox').prev().find('.ch').eq(index).addClass('change').find('img').attr('src', src);
				value = $(this).find('span').attr('id');
				$(this).parents('.chooseBox').prev().find('.ch').eq(index).addClass('change').find('input').attr('value', value);
			});

			$('.chooseBtn>a').on('tap', function(){
				var flag = true, names = "";
				$('.chooseRow>.ch').each(function(index, el) {					
					if(!$(this).hasClass('change')){
						var name = $(this).attr('data-name');
						names += name + "，";
						flag = false;
					}
				});

				if(flag) {
					 $('#wxpay').submit();
				}else {
					names = names.substr(0,names.length-1);
					alert("您还没选择："+names);
					flag = true;
					names = "";
				}
			});

		});
	</script>
<?php  $jssdk = new JSSDK("wxb781ded9b72c1f40", "1b593ca609eb4529a310c3478ee4877f"); $signPackage = $jssdk->GetSignPackage(); ?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
		'onMenuShareTimeline',
		'onMenuShareAppMessage'
    ]
});
wx.ready(function () {
	wx.onMenuShareTimeline({
		title: '诚心愿以此功德普及一切，我等与众生，皆共成佛道！', 
		link: 'http://www.tianyouqifu.com',
		imgUrl: 'http://www.tianyouqifu.com/Public/pic/share.png',
		success: function () { 
			window.location.href="http://www.tianyouqifu.com/";
		},
		cancel: function () { 
			window.location.href="http://www.tianyouqifu.com/";
		}
	});
});
</script>
</body>
</html>