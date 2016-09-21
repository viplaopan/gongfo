<?php

namespace Weixin\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
 define("HOMEPAGE", 'index');
define("INTROPAGE", 'intro');
define("RECORDPAGE", 'record');
define("TRIBUTEPAGE", 'tribute');
class IndexController extends HomeController {

	//微信接入验证
	public function validate() {
		//获得参数 signature nonce token timestamp echostr
		$nonce = $_GET['nonce'];
		$token = '0d31f219459054950';
		$timestamp = $_GET['timestamp'];
		$echostr = $_GET['echostr'];
		$signature = $_GET['signature'];
		//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
		//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1(implode($array));
		if ($str == $signature && $echostr) {
			//第一次接入weixin api接口的时候
			echo $echostr;
			exit ;
		} else {
			$this -> reponseMsg();
		}
	}

	// 接收事件推送并回复
	public function reponseMsg() {
		$weixinModel = new \Weixin\Model\WeixinModel();
		//1.获取到微信推送过来post数据（xml格式）
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		//2.处理消息类型，并设置回复类型和内容
		/*<xml>
		 <ToUserName><![CDATA[toUser]]></ToUserName>
		 <FromUserName><![CDATA[FromUser]]></FromUserName>
		 <CreateTime>123456789</CreateTime>
		 <MsgType><![CDATA[event]]></MsgType>
		 <Event><![CDATA[subscribe]]></Event>
		 </xml>*/
		$postObj = simplexml_load_string($postArr);

		
		//$postObj->ToUserName = '';
		//$postObj->FromUserName = '';
		//$postObj->CreateTime = '';
		//$postObj->MsgType = '';
		//$postObj->Event = '';
		// gh_e79a177814ed
		//判断该数据包是否是订阅的事件推送
		if (strtolower($postObj -> MsgType) == 'event') {
			
			//如果是关注 subscribe 事件
			if (strtolower($postObj -> Event == 'subscribe')) {
				//回复用户消息(纯文本格式)
				$toUser = $postObj -> FromUserName;
				$fromUser = $postObj -> ToUserName;
				$time = time();
				$msgType = 'text';
				$content = '尊敬的仁者：您好，感谢您对佛的信仰！教育弘扬佛法，讲学培养人才，慈悲利益社会，以真诚增进交流，以专修求生净土，共沾法喜，祝福您福慧双修，身体健康，多听经明理。愿佛陀保佑您，阿弥陀佛。合十！';
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
				/*<xml>
				 <ToUserName><![CDATA[toUser]]></ToUserName>
				 <FromUserName><![CDATA[fromUser]]></FromUserName>
				 <CreateTime>12345678</CreateTime>
				 <MsgType><![CDATA[text]]></MsgType>
				 <Content><![CDATA[你好]]></Content>
				 </xml>*/

			}
			if ($postObj -> Event == 'CLICK') {				
				$key = $postObj->EventKey; // 获取key

				if($key == 'ZXBFO'){
					//回复用户消息(纯文本格式)
					$weixinModel->responseText($postObj,'尊敬的仁者：您好，感谢您对佛的信仰！教育弘扬佛法，讲学培养人才，慈悲利益社会，以真诚增进交流，以专修求生净土，共沾法喜，祝福您福慧双修，身体健康，多听经明理。愿佛陀保佑您，阿弥陀佛。合十！');
					die;
				}
			}
		}

		//当微信用户发送imooc，公众账号回复‘imooc is very good'
		/*<xml>
		 <ToUserName><![CDATA[toUser]]></ToUserName>
		 <FromUserName><![CDATA[fromUser]]></FromUserName>
		 <CreateTime>12345678</CreateTime>
		 <MsgType><![CDATA[text]]></MsgType>
		 <Content><![CDATA[你好]]></Content>
		 </xml>*/
		/*if(strtolower($postObj->MsgType) == 'text'){
		 switch( trim($postObj->Content) ){
		 case 1:
		 $content = '您输入的数字是1';
		 break;
		 case 2:
		 $content = '您输入的数字是2';
		 break;
		 case 3:
		 $content = '您输入的数字是3';
		 break;
		 case 4:
		 $content = "<a href='http://www.imooc.com'>慕课</a>";
		 break;
		 case '英文':
		 $content = 'imooc is ok';
		 break;

		 }
		 $template = "<xml>
		 <ToUserName><![CDATA[%s]]></ToUserName>
		 <FromUserName><![CDATA[%s]]></FromUserName>
		 <CreateTime>%s</CreateTime>
		 <MsgType><![CDATA[%s]]></MsgType>
		 <Content><![CDATA[%s]]></Content>
		 </xml>";
		 //注意模板中的中括号 不能少 也不能多
		 $fromUser = $postObj->ToUserName;
		 $toUser   = $postObj->FromUserName;
		 $time     = time();
		 // $content  = '18723180099';
		 $msgType  = 'text';
		 echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);

		 }
		 }
		 */
		//用户发送tuwen1关键字的时候，回复一个单图文
		if (strtolower($postObj -> MsgType) == 'text' && trim($postObj -> Content) == 'wudi') {

			$arr = array();
			$array = array();
			$lists = D('Home/Document')->lists();
			foreach($lists as $val){
				$arr = array('title' => $val['title'], 'description' => $val['description'], 'picUrl' => 'http://www.36eq.com/' . get_cover($val['cover_id'],'path'), 'url' => 'http://www.36eq.com/');
				array_push($array,$arr);
			}
			
			$weixinModel->responseNews($postObj,$array);

			//注意：进行多图文发送时，子图文个数不能超过10个
		} else {
			switch( trim($postObj->Content) ) {
				case 1 :
					$content = '您输入的数字是1';
					break;
				case 2 :
					$content = '您输入的数字是2';
					break;
				case 3 :
					$content = '您输入的数字是3';
					break;
				case 4 :
					$content = "<a href='http://www.imooc.com'>慕课</a>";
					break;
				case 'NEWGOODS' :
					$content = 'imooc is ok';
					break;
			}
			$template = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
			//注意模板中的中括号 不能少 也不能多
			$fromUser = $postObj -> ToUserName;
			$toUser = $postObj -> FromUserName;
			$time = time();
			// $content  = '18723180099'; 
			$msgType = 'text';
			echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);

		}//if end
	}//reponseMsg end
	//首页
	public function index()
	{
		
		$openid = I('get.openid');
		if(!empty($openid))
		{
			
			$this->checksub();
			$this->assign("openid", $openid);
			$today = strtotime(date('Y-m-d',time()));
			$recorddata = D('record')->where("openid='%s'",$openid)->order('id desc')->limit(1)->select();
			$rtime = strtotime($recorddata[0]['rtime']);
			
			$isToday = $today > $rtime?1:0;
			
			$recordday = date('d',$rtime);
			if($isToday)
			{
		
				$this->display();
			}
			else{
				
				$hpno = $recorddata[0]["hpno"];
				$xlno = $recorddata[0]["xlno"];
				$gpno = $recorddata[0]["gpno"];
				$this->assign("hpno", $hpno);
				$this->assign("xlno", $xlno);
				$this->assign("gpno", $gpno);
				$this->display("home");
			}
			//检查一遍是否是新用户
			$data = D('user')->where("openid='%s'", $openid)->select();
			if(empty($data))
			{
				$this->checkcookie(HOMEPAGE);
				//M()->execute("insert into user(openid,nickname,headimgurl) value('%s','%s','%s')", $openid, $nickname, $headimgurl);
			}
		}
		else
		{
			
			$this->checkcookie(HOMEPAGE);
		}
	}
	//获取openid
	public function getopenid()
	{
		
		$code = I('get.code');
		if(!empty($code))	//授权
		{
			$api = new WechatApi();
			$arr["code"] = $code;
			$json_data = $api->oauthUserInfo($arr);

			$openid = $json_data["openid"];
			cookie('lifo_openid', $openid);
			$nickname = $json_data["nickname"];
			$headimgurl = $json_data["headimgurl"];
			$userdata = D('user')->where("openid='%s'", $openid)->select();
			
			if(empty($userdata))
			{
				M()->execute("insert into onethink_user(openid,nickname,headimgurl) value('%s','%s','%s')", $openid, $nickname, $headimgurl);
			}

			//返回前页
			$page = I('get.page');
			$url = C('host');
			if($page == HOMEPAGE)	$url .= U('Index/index')."&openid=".$openid;
			else if($page == INTROPAGE)		$url .= U('Index/intro')."&openid=".$openid;
			else if($page == RECORDPAGE)		$url .= U('Index/record')."&openid=".$openid;
			header("location: ".$url);
		}
		else
		{
			$this->error();
		}
	}
	//cookie校验
	public function checkcookie($forword)
	{
		$openid = cookie('lifo_openid');
		if(!empty($openid))
		{
			$url = C('host');
			if($forword == HOMEPAGE)	$url .= U('Index/index')."&openid=".$openid;
			else if($forword == INTROPAGE)		$url .= U('Index/intro')."&openid=".$openid;
			else if($forword == RECORDPAGE)		$url .= U('Index/record')."&openid=".$openid;

			
			header("location: ".$url);
		}
		else
		{
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".urlencode(C('host').U('Index/getopenid')."&page=".$forword)."&response_type=code&scope=snsapi_userinfo#wechat_redirect";

			header("location: ".$url);
			exit;
		}
	}
	//获取userinfo
	public function checksub()
	{
	
		$openid = I('get.openid');
		$api = new WechatApi();
		$json_rsp = $api->getUserInfo($openid);

		$subscribe = $json_rsp["subscribe"];

		if($subscribe == "0"){
			$this->display('nosub');
			exit;
		}
		
	}
	    //上香
	public function tribute()
	{

		$openid = I('get.openid');
		if(!empty($openid))
		{
			$this->recordata();
			$this->assign("openid", $openid);
			$this->checktime();
		}
		else
		{
			$this->checkcookie(HOMEPAGE);
		}
	}
	//供佛时间校验
	public function checktime()
	{
		$openid = I('get.openid');
		
		if(!empty($openid))
		{
			$today = date(d,time());
			$recorddata = D('record')->where("openid='%s'",$openid)->order('id desc')->limit(1)->select();
			$rtime = strtotime($recorddata[0]['rtime']);
			$recordday = date('d',$rtime);
			if(true)
			{
	
				$this->display();
			}
			else{
				$hpno = $recorddata[0]["hpno"];
				$xlno = $recorddata[0]["xlno"];
				$gpno = $recorddata[0]["gpno"];
				$this->assign("hpno", $hpno);
				$this->assign("xlno", $xlno);
				$this->assign("gpno", $gpno);
			
				$this->display("home");
			}
		}
		else
		{
			$this->checkcookie(HOMEPAGE);
		}
	}
	//贡品输出
	public function recordata()
	{
		$hpdata = D('hp')->order('id asc')->select();
		$this->assign("hpdata", $hpdata);
		$xldata = D('xl')->order('id asc')->select();
		$this->assign("xldata", $xldata);
		$gpdata = D('gp')->order('id asc')->select();
		$this->assign("gpdata", $gpdata);
	}
	//贡品提交
	public function dorecord()
	{

		$openid = I('get.openid');
		
		if(!empty($openid))
		{
			$hpno = I('get.hpno');
			$xlno = I('get.xlno');
			$gpno = I('get.gpno');
			
			$today = date(d,time());
			$recorddata = D('record')->where("openid='%s'",$openid)->order('id desc')->limit(1)->select();
			$rtime = strtotime($recorddata[0]['rtime']);
			$recordday = date('d',$rtime);
			if(true)
			{
				$dorecorddata = M()->execute("insert into onethink_record(openid,hpno,xlno,gpno) value('%s','%s','%s','%s')", $openid, $hpno, $xlno, $gpno);
				if ($dorecorddata){
					$insertid = mysql_insert_id();
					$data[recordtime] = date("Y-m-d H:i:s");
					$recorddata = D('user')->where("openid='%s'", $openid)->save($data);
					$url .= U('Index/change')."&recordid=".$insertid."&openid=".$openid;
					header("location: ".$url);
					exit;
				}
				else
				{
					$this->error();
				}
			}
			else
			{
				$url .= U('Index/change')."&recordid=".$insertid."&openid=".$openid;
				header("location: ".$url);
				exit;
			}
		}
		else
		{
			$this->checkcookie(TRIBUTEPAGE);
		}
	}
	//返回页面
	public function change()
	{
		$openid = I('get.openid');
		$recordid = I('get.recordid');
		if(!empty($openid))
		{
			$this->assign("recordid", $recordid);
			$this->assign("openid", $openid);
			$this->display();
		}
		else
		{
			$this->checkcookie(HOMEPAGE);
		}
	}
	//供佛说明页面
	public function intro()
	{
		$openid = I('get.openid');
		if(!empty($openid))
		{

			$this->assign("openid", $openid);
			$this->display('intro');
		}
		else
		{
			$this->checkcookie(INTROPAGE);
		}
	}
	//供佛记录
	public function record()
	{
		$openid = I('get.openid');
		if(!empty($openid))
		{
			$recorddata = D('record')->where("openid='%s'",$openid)->order('id desc')->select();
			$this->assign("recorddata", $recorddata);
			$this->assign("openid", $openid);
			$this->display('record');
		}
		else
		{
			$this->checkcookie(RECORDPAGE);
		}
	}
	//回向
	public function back()
	{
		$openid = I('get.openid');
		$recordid = I('get.recordid');
		if(!empty($openid))
		{
			$this->assign("recordid", $recordid);
			$this->assign("openid", $openid);
			$this->display();
		}
		else
		{
			$this->checkcookie(HOMEPAGE);
		}
	}
	
	//提交回向
	public function doback()
	{
		$openid = I('get.openid');
		$recordid = I('get.recordid');
		$fromname = I('get.fromname');
		$toname = I('get.toname');
		$hope = I('get.hope');
		if(!empty($openid))
		{
			$this->assign("recordid", $recordid);
			$this->assign("fromname", $fromname);
			$this->assign("toname", $toname);
			$this->assign("hope", $hope);
			$this->assign("openid", $openid);
			M()->execute("update onethink_record set fromname='$fromname' where id='%s'", $recordid);
			M()->execute("update onethink_record set toname='$toname' where id='%s'", $recordid);
			M()->execute("update onethink_record set hope='$hope' where id='%s'", $recordid);
			$this->display();
		}
		else
		{
			$this->checkcookie(HOMEPAGE);
		}
	}
}
