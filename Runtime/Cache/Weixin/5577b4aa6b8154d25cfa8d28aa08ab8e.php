<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<title>回向</title>
	<script type="text/javascript" src="/Public/js/flexible.js"></script>
	<script type="text/javascript" src="/Public/js/pageloading.js"></script>
	<link type="text/css" rel="stylesheet" href="/Public/css/back.css">
</head>
<body>
	<div class="backbox">
		<div class="backframe backsure">
			<div class="backtitle">
				<span class="name">善信佛子：</span><span class="enterTxt"><?php echo ($fromname); ?></span>
				<p>愿以此功德，普及于一切。<br>我等与众生，皆共成佛道。</p>
			</div>
			<div class="backrow">
				特别回向给：<span class="enterTxt"><?php echo ($toname); ?></span>
			</div>
			<div class="backrow">
				愿他（她）：<span class="enterTxt"><?php echo ($hope); ?></span>
			</div>
			<a href="javascript:;" class="sharebtn"></a>
			<!-- <a href="javascript:;" class="bfbtn"></a> -->
		</div>
	</div>
	<div id="mask"></div>
	<script src="/Public/js/zepto.min.js"></script>
	<script src="/Public/js/fun.js"></script>
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
		title: '末学：<?php echo ($fromname); ?> 特别回向给 <?php echo ($toname); ?> 愿你 <?php echo ($hope); ?> ！', 
		link: 'http://www.tianyouqifu.com',
		imgUrl: 'http://www.tianyouqifu.com/Public/pic/share.png',
		success: function () { 
			window.location.href="http://www.tianyouqifu.com/";
		},
		cancel: function () { 
			window.location.href="http://www.tianyouqifu.com/";
		}
	});
	wx.onMenuShareAppMessage({
		title: '在线礼佛', 
		desc: '末学：<?php echo ($fromname); ?> 特别回向给 <?php echo ($toname); ?> 愿你 <?php echo ($hope); ?> ！', 
		link: 'http://www.tianyouqifu.com',
		imgUrl: 'http://www.tianyouqifu.com/Public/pic/share.png',
		type: '', 
		dataUrl: '',
	});
});
</script>
</body>
</html>