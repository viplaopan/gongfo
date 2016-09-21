<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<title>我的佛堂</title>
	<script type="text/javascript" src="/Public/js/flexible.js"></script>
	<script type="text/javascript" src="/Public/js/pageloading.js"></script>
	<link type="text/css" rel="stylesheet" href="/Public/css/index.css">	
</head>
<body>
	<div class="pagebox">
		<div class="music">
			<audio src="/Public/music/mercy.mp3" autoplay loop></audio>
		</div>
		<div class="joss">
			<img src="/Public/pic/fo.png" alt="佛像">
		</div>
		<div class="light">
			<img src="/Public/pic/light.png" alt="花灯">
		</div>
		<div class="light two">
			<img src="/Public/pic/light.png" alt="花灯">
		</div>
		<div class="vase">
			<img src="/Public/pic/hp_no.png" alt="空花瓶">
		</div>
		<div class="vase two">
			<img src="/Public/pic/hp_no.png" alt="空花瓶">
		</div>
		<div class="compote">
			<img src="/Public/pic/gp_no.png" alt="空果盘">
		</div>
		<div class="compote two">
			<img src="/Public/pic/gp_no.png" alt="空果盘">
		</div>
		<div class="censer">
			<img src="/Public/pic/xl_no.png" alt="空香炉">
		</div>
		<div class="incense">
			<a href="javascript:;"><img src="/Public/pic/sx.png" alt="上香"></a>
		</div>
		<ul class="nav">
			<li class="on"><a href="<?php echo U('Weixin/Index/index',array('openid'=>$openid));?>"></a></li>
			<li><a href="<?php echo U('Weixin/Index/intro',array('openid'=>$openid));?>"></a></li>
			<li><a href="<?php echo U('Weixin/Index/record',array('openid'=>$openid));?>"></a></li>
			<li><a href="javascript:;" class="sbtn"></a></li>
		</ul>
	</div>
	<div class="pagetips" id="pagetips">
	    <div class="title">请先关注后再礼佛</div>
	    <div class="cont">
	        长按二维码图片<br/>选择识别图中的二维码<br/>
			<img src="/Public/pic/ewm.jpg" >
	    </div>
	    <ul class="ptbtn">
	        <li><a href="?a=index&openid=<?php echo $openid?>">好</a></li>
	    </ul>
	</div>
	<div id="mask"></div>
	<script src="/Public/js/zepto.min.js"></script>
	<script src="/Public/js/fun.js"></script>
	<script>
		$(function(){

			$('.music').on('tap', function(){
				if (!$(this).hasClass('off')){
					$(this).addClass('off');
					$('audio').get(0).pause();
				}else {
					$(this).removeClass('off');
					$('audio').get(0).play();
				}
			});

			$('body').bind('touchstart', function(){
				if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
					if(!$('.music').hasClass('off')){
						$('audio').get(0).play();
					}else{
						$('audio').get(0).pause();
					}
				}
			});
			
			$('.incense>a').on('tap', function(){
				$('#pagetips').css('display', 'block');
			});

		});
	</script>
	<?php  $jssdk = new JSSDK("wx7e7937bdb109775d", "f7492a9847327c7faf8f1a512b512e59"); $signPackage = $jssdk->GetSignPackage(); ?>
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