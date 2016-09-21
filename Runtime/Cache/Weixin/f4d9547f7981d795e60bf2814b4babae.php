<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<title>供佛记录</title>
	<script type="text/javascript" src="/Public/js/flexible.js"></script>
    <script type="text/javascript" src="/Public/js/pageloading.js"></script>
	<link type="text/css" rel="stylesheet" href="/Public/css/record.css">
</head>
<body>
    <img class="img_bg" src="/Public/pic/back.jpg">
    <div class="gftiptitle">
        倒计时<span id="countdown">8:18:40</span>
    </div>
<div class="gftip">
        温馨提示：佛堂供佛系统每天只能供佛一次<br>
    </div>

    <ul class="recordlist">
        <?php for($i=0; $i<count($recorddata); $i++) {?>
        <li class="">
            <span><?php echo date('Y-m-d',strtotime($recorddata[$i]["rtime"]))?></span>   
            <span><?php echo date('H:i:s',strtotime($recorddata[$i]["rtime"]))?></span>
            <span>供佛圆满</span>
            <div class="recordCont">
                <p>善信弟子：<em><?php echo $recorddata[$i]["fromname"]?></em></p>
                <p>诚心愿以此功德普及于一切，我等与众生皆共成佛道</p>
                <p>回向给：<em><?php echo $recorddata[$i]["toname"]?></em></p>
                <p>愿他（她）：<em><?php echo $recorddata[$i]["hope"]?></em></p>
            </div>
        </li>
		<?php }?>
    </ul>
    <ul class="nav">
        <li class="on"><a href="<?php echo U('Weixin/Index/index',array('openid'=>$openid));?>"></a></li>
			<li><a href="<?php echo U('Weixin/Index/intro',array('openid'=>$openid));?>"></a></li>
			<li><a href="<?php echo U('Weixin/Index/record',array('openid'=>$openid));?>"></a></li>
			<li><a href="javascript:;" class="sbtn"></a></li>
    </ul>
	<div id="mask"></div>
    <script src="/Public/js/zepto.min.js"></script>
    <script src="/Public/js/fun.js"></script>
	<script src="/Public/js/time.js"></script>
	<script>

        $('ul.recordlist>li').on('tap', function(){
            $(this).addClass('on').siblings().removeClass('on');            
        });

        $(document).on('tap', function(e){
            var obj = e.target;
            if (!$(obj).is('ul.recordlist, ul.recordlist *')) {                
                $('ul.recordlist>li.on').removeClass('on');
            }
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
            window.location.href="http://www.tianyouqifu.com/?a=record";
		},
		cancel: function () { 
            window.location.href="http://www.tianyouqifu.com/?a=record";
		}
	});
});
</script>
</body>
</html>