<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<title>供佛功德</title>
	<script type="text/javascript" src="/Public/js/flexible.js"></script>
	<script type="text/javascript" src="/Public/js/pageloading.js"></script>
	<link type="text/css" rel="stylesheet" href="/Public/css/diligence_list.css">
</head>
<body>
	<div class="diligence_list">
		<img class="img_bg" src="/Public/pic/back.jpg">
		<div class="content">
            <div class="title">功德</div>
			<div class="list">
                <dl>
					<dt>1.作种种罪过，轻者立即消灭，重者也得减轻。</dt>
					<dt>2.常得吉神拥护，一切瘟疫水火寇盗刀兵牢狱之灾，悉皆不受。</dt>
					<dt>3.夙生怨对，咸蒙法益，而得解脱从前所，永免寻仇报复之苦。</dt>
					<dt>4.夜叉恶鬼，不能侵犯。毒蛇饿虎，不能为害。</dt>
					<dt>5.必得安慰，日无险事，夜无恶梦。颜色光泽，气力充沛，所作吉利。</dt>
					<dt>6.至心奉法，虽无希求，自然衣食丰足，家庭和睦，福寿绵长。</dt>
					<dt>7.所言所行，人天欢喜。任到何方，常为多众倾城爱戴，恭敬礼拜。</dt>
					<dt>8.愚者转智，病者转健，困者转亨。为妇女者，报谢之日，捷转男身。</dt>
					<dt>9.永离恶道，受生善道。相貌端正，天资超越，福禄殊胜。学业有成。</dt>
					<dt>10.能为一切众生，种植善根。以众生心，做大福田，获天量胜果。</dt>
					<dt>11.消除疾病、延长寿命。</dt>
					<dt>12.善业善缘增长，恶业恶缘缩短。</dt>
					<dt>13.增长福德智慧资粮。对工作、事业具有增上缘，使工作事业更加顺利、兴旺发达。聚合财富。</dt>
					<dt>14.能够超拔故去的人，使其永脱恶道，转生善道。</dt>
					<dt>15.使无子嗣者如愿以偿得生子嗣。</dt>
					<dt>16. 与生者播下敬信的种子，于今生和一切转生中，受到如是无上导师以现身或化身摄受护佑，从而使他们对佛教清净正道如理修学。</dt>
				</dl>
			</div>
		</div>
		<ul class="nav">
			<li class="on"><a href="<?php echo U('Weixin/Index/index',array('openid'=>$openid));?>"></a></li>
			<li><a href="<?php echo U('Weixin/Index/intro',array('openid'=>$openid));?>"></a></li>
			<li><a href="<?php echo U('Weixin/Index/record',array('openid'=>$openid));?>"></a></li>
			<li><a href="javascript:;" class="sbtn"></a></li>
		</ul>
	</div>
	<div class="back_bg"></div>

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
		title: '诚心愿以此功德普及一切，我等与众生，皆共成佛道！', 
		link: 'http://www.tianyouqifu.com',
		imgUrl: 'http://www.tianyouqifu.com/Public/pic/share.png',
		success: function () { 
			window.location.href="http://www.tianyouqifu.com/?a=intro";
		},
		cancel: function () { 
			window.location.href="http://www.tianyouqifu.com/?a=intro";
		}
	});
});
</script>
</body>
</html>