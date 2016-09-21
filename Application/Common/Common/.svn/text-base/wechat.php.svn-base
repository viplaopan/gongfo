<?php
namespace Weixin\Controller;
//新手接入
//valid() 	开发者接入检查

//基础支持接口
//readtoken()	读数据库token
//gettoken() 	获取access_token
//uploadMedia($media, $type)	上传多媒体文件
//downloadMedia($descfile, $mediaid)	下载多媒体文件
//responseMsg()		接收消息并处理

//发送消息接口
//RspText($postObj, $contentStr)	被动回复文本
//RspPic($postObj, $mediaid)		被动回复图片
//RspVoice($postObj, $mediaid)		被动回复语音
//RspVideo($postObj, $arr)			被动回复视频
//RspMusic($postObj, $arr)			被动回复音乐
//RspArticle($postObj, $arr)		被动回复图文
//customService($postObj)			转客服
//sendKefuMsg($openid, $msgtype, $arr)	发送客服消息

//群发接口
//uploadnews($arr)			上传图文素材
//delMass($msgid)			删除群发消息
//sendMass($arr)			群发接口

//用户管理
//createGroup($name)		创建分组
//getAllGroup()				查询所有分组
//searchGroup($openid)		查询用户所在分组
//editGroup($groupid, $name)	修改分组名
//moveUser($openid, $togroupid)	移动用户分组
//getUserInfo($openid)		获取用户详细信息
//getUserList($nextopenid = '')	拉取用户列表每次10000个
//oauthUserInfo($arr)		网页授权code换取用户详细信息
//oauthOpenid($arr)			网页授权获取openid、token

//自定义菜单
//createMenu($json)			创建菜单
//searchMenu()				查询菜单
//delMenu()					删除菜单

//可自定义参数
define("TOKEN", "0d31f219459054950");
define("APPID", "wxb781ded9b72c1f40");
define("SECRET", "1b593ca609eb4529a310c3478ee4877f");

//不可改变参数
define("MEDIA_UPLOAD", "http://file.api.weixin.qq.com/cgi-bin/media/upload");
define("NEWS_UPLOAD", "https://api.weixin.qq.com/cgi-bin/media/uploadnews");
define("MEDIA_DOWNLOAD", "http://file.api.weixin.qq.com/cgi-bin/media/get");
define("TOKENURL", "https://api.weixin.qq.com/cgi-bin/token");
define("KEFUURL", "https://api.weixin.qq.com/cgi-bin/message/custom/send");
define("MASS_DELURL", "https://api.weixin.qq.com//cgi-bin/message/mass/delete");
define("MASS_LISTURL", "https://api.weixin.qq.com/cgi-bin/message/mass/send");
define("MASS_GROUPURL", "https://api.weixin.qq.com/cgi-bin/message/mass/sendall");
define("CREATEGROUP", "https://api.weixin.qq.com/cgi-bin/groups/create");
define("GETALLGROUP", "https://api.weixin.qq.com/cgi-bin/groups/get");
define("SEARCHGROUP", "https://api.weixin.qq.com/cgi-bin/groups/getid");
define("EDITGROUP", "https://api.weixin.qq.com/cgi-bin/groups/update");
define("MOVEUSER", "https://api.weixin.qq.com/cgi-bin/groups/members/update");
define("GETUSERINFO", "https://api.weixin.qq.com/cgi-bin/user/info");
define("GETUSERLIST", "https://api.weixin.qq.com/cgi-bin/user/get");
define("OAUTHTOKEN", "https://api.weixin.qq.com/sns/oauth2/access_token");
define("OAUTHINFO", "https://api.weixin.qq.com/sns/userinfo");
define("CREATEMENU", "https://api.weixin.qq.com/cgi-bin/menu/create");
define("SEARCHMENU", "https://api.weixin.qq.com/cgi-bin/menu/get");
define("DELMENU", "https://api.weixin.qq.com/cgi-bin/menu/delete");
//消息接收
class WechatApi
{
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//++++++++++++++++++++++可自定义功能函数+++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	//获取数据库中token接口
	public function readtoken()
	{
		//定期刷新token后在这里修改获取token方式
		return $this->gettoken();
	}
	//====================普通消息接收=================================
	//文本消息
	private function normalMsg($postObj)
	{
		$reqkey = $postObj->Content;	//文本内容
		$msgid = $postObj->MsgId;
		//在这里写逻辑
	}
	
	//图片消息
	private function imageMsg($postObj)
	{
		$picurl = $postObj->PicUrl;		//图片链接
		$mediaid = $postObj->MediaId;	//图片消息媒体id，可以调用多媒体文件下载接口拉取数据 JPG格式
		$msgid = $postObj->MsgId;
		//在这里写逻辑
	}
	
	//声音消息
	private function voiceMsg($postObj)
	{
		$format = $postObj->Format;		//语音格式，如amr，speex
		$mediaid = $postObj->MediaId;	//语音消息媒体id，可以调用多媒体文件下载接口拉取数据 
		$msgid = $postObj->MsgId;
		$rec = $postObj->Recognition;	//语音识别结果(如果开启语音识别)
		//在这里写逻辑
	}
	
	//视频消息
	private function videoMsg($postObj)
	{
		$thumbid = $postObj->ThumbMediaId;	//视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据 JPG格式
		$mediaid = $postObj->MediaId;	//视频消息媒体id，可以调用多媒体文件下载接口拉取数据 MP4格式
		$msgid = $postObj->MsgId;
		//在这里写逻辑
	}
	
	//地理位置消息
	private function locationMsg($postObj)
	{
		$reqkey = $postObj->Content;
		$msgid = $postObj->MsgId;
		$location_X = $postObj->Location_X;		//地理位置维度
		$location_Y = $postObj->Location_Y;		//地理位置经度
		$scale = $postObj->Scale;	//地图缩放大小
		$label = $postObj->Label;	//地理位置信息
		//在这里写逻辑
	}
	
	//链接消息
	private function linkMsg($postObj)
	{
		$title = $postObj->Title;	//消息标题
		$desc = $postObj->Description;	//消息描述
		$url = $postObj->Url;	//消息链接
		$msgid = $postObj->MsgId;
		//在这里写逻辑
	}
	
	
	//====================事件接收=================================
	//菜单点击事件
	public function clickEvent($postObj)
	{
		$openid = $postObj->FromUserName;	//用户openid 
		$key = $postObj->EventKey;	//与自定义菜单接口中KEY值对应
		//在这里写逻辑
	}
	
	//菜单跳转事件
	public function viewEvent($postObj)
	{
		$openid = $postObj->FromUserName;	//用户openid 
		$tourl = $postObj->EventKey;	//设置的跳转URL
		//在这里写逻辑
	}
	
	//关注事件
	public function subscribeEvent($postObj)
	{
		$openid = $postObj->FromUserName;	//用户openid 
		//在这里写逻辑
	}
	
	//取消关注事件
	public function unsubscribeEvent($postObj)
	{
		$openid = $postObj->FromUserName;	//用户openid 
		//在这里写逻辑
	}
	
	//上报位置事件
	public function locationEvent($postObj)
	{
		$openid = $postObj->FromUserName;	//用户openid 
		$latitude = $postObj->Latitude;		//纬度
		$longitude = $postObj->Longitude;	//经度
		$precision = $postObj->Precision;	//精度
		//在这里写逻辑
	}
	
	//群发结束
	public function groupMsgEndEvent($postObj)
	{
		$msgid = $postObj->MsgID;	//群发消息id
		$status = $postObj->Status;		//群发状态
		$totalCount = $postObj->TotalCount;		//分组下、列表中粉丝数
		$filterCount = $postObj->FilterCount;	//过滤后粉丝数
		$sentCount = $postObj->SentCount;		//成功粉丝数
		$errorCount = $postObj->ErrorCount;		//失败粉丝数
		//在这里写逻辑
	}
	
	
	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//++++++++++++++++++++++不可轻易改功能函数+++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	
	//===============================基础接口==========================
	//开发者接入检查
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        }
		
		return false;
    }
	
	//获取token
	public function gettoken()
	{
		return get_access_token(C('DATA_AUTH_KEY'));
	}
	

	//响应消息
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $this->dispatchMsg($postObj);
        }else {
        	echo "";
        	exit;
        }
    }
	
	//消息分发
	private function dispatchMsg($postObj)
	{
		$msgType = $postObj->MsgType;
		
		//文本消息
		if($msgType == "text")	$this->normalMsg($postObj);
		//图片消息
		else if($msgType == "image") $this->imageMsg($postObj);
		//声音消息
		else if($msgType == "voice") $this->voiceMsg($postObj);
		//视频消息
		else if($msgType == "video") $this->videoMsg($postObj);
		//地理位置消息
		else if($msgType == "location") $this->locationMsg($postObj);
		//链接消息
		else if($msgType == "link") $this->linkMsg($postObj);
		//菜单事件
		else if($msgType == "event")	$this->dispatchEvent($postObj);
		//转客服
		else	$this->customService($postObj);
	}
	
	//事件分发
	private function dispatchEvent($postObj)
	{
		$event = $postObj->Event;
		
		if($event == "CLICK")	//点击事件
		{
			$this->clickEvent($postObj);
		}
		else if($event == "VIEW")	//跳转网页事件
		{
			$this->viewEvent($postObj);
		}
		else if($event == "subscribe")	//关注事件
		{
			$this->subscribeEvent($postObj);
		}
		else if($event == "unsubscribe")	//取消关注事件
		{
			$this->unsubscribeEvent($postObj);
		}
		else if($event == "LOCATION")	//上报位置事件
		{
			$this->locationEvent($postObj);
		}
		else if($event == "MASSSENDJOBFINISH")		//群发消息结束事件
		{
			$this->groupMsgEndEvent($postObj);
		}
	}
	
	//消息有效性
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	//===============================上传下载接口==========================
	
	//save文件到本地
	public function save2disk($filename, $content)
	{
		$descfile = fopen($filename, "w");
		if($descfile !== false)
		{
			if(fwrite($descfile, $content) !== false)
			{
				fclose($descfile);
			}
		}
	}
	
	
	//上传多媒体文件$media绝对路径
	//上传的多媒体文件有格式和大小限制，如下：
	//图片（image）: 1M，支持JPG格式
	//语音（voice）：2M，播放长度不超过60s，支持AMR\MP3格式
	//视频（video）：10MB，支持MP4格式
	//缩略图（thumb）：64KB，支持JPG格式
	//媒体文件在后台保存时间为3天，即3天后media_id失效。
	/*传入
	$media	文件绝对路径
	$type	上述类型
	
	传出
	$mediaid
	*/
	public function uploadMedia($media, $type)
	{
		//媒体文件类型，分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）
		$data['type'] = $type;
		$data['access_token'] = $this->readtoken();	
		$data['media'] = "@".$media;//new CURLFile($media);	//form-data中媒体文件标识，有filename、filelength、content-type等信息
		
		$myhttp = new CurlHttp();
		$rspdata = $myhttp->post(MEDIA_UPLOAD, $data);
		$json = json_decode($rspdata, true);
		//返回json {"type":"TYPE","media_id":"MEDIA_ID","created_at":123456789}
		//'type' 媒体文件类型，分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb，主要用于视频与音乐格式的缩略图）
		//'media_id' 媒体文件上传后，获取时的唯一标识
		//'created_at' 媒体文件上传时间戳
		return $json["media_id"];	 
	}
	
	//下载多媒体文件
	/*
	传入
	$descfile	存储位置
	$mediaid
	*/
	public function downloadMedia($descfile, $mediaid)
	{
		$url = MEDIA_DOWNLOAD."?access_token=".$this->readtoken()."&media_id=".$mediaid;
		$myhttp = new CurlHttp();
		$rsp = $myhttp->get($url);
		$this->save2disk($descfile, $rsp);
	}
	
	//===============================回复接口==========================
	
	//回复文本
	/*
	传入
	$contentStr		内容
	*/
	private function RspText($postObj, $contentStr)
	{
		$openID = $postObj->FromUserName;
		$myID = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
					</xml>";             
		$rspType = "text";
		$resultStr = sprintf($textTpl, $openID, $myID, $time, $rspType, $contentStr);
		echo $resultStr;
	}
	
	//回复图片
	private function RspPic($postObj, $mediaid)
	{
		$openID = $postObj->FromUserName;
		$myID = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Image>
						<MediaId><![CDATA[%s]]></MediaId>
						</Image>
					</xml>";             
		$rspType = "image";
		$resultStr = sprintf($textTpl, $openID, $myID, $time, $rspType, $mediaid);
		echo $resultStr;
	}
	
	//回复语音
	private function RspVoice($postObj, $mediaid)
	{
		$openID = $postObj->FromUserName;
		$myID = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Voice>
						<MediaId><![CDATA[%s]]></MediaId>
						</Voice>
					</xml>";             
		$rspType = "voice";
		$resultStr = sprintf($textTpl, $openID, $myID, $time, $rspType, $mediaid);
		echo $resultStr;
	}
	
	//回复视频
	/*
	传入
	$arr["mediaid"]
	$arr["title"]		标题
	$arr["desc"]		描述
	*/
	private function RspVideo($postObj, $arr)
	{
		$openID = $postObj->FromUserName;
		$myID = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Video>
						<MediaId><![CDATA[%s]]></MediaId>
						<Title><![CDATA[%s]]></Title>
						<Description><![CDATA[%s]]></Description>
						</Video> 
					</xml>";             
		$rspType = "video";
		$resultStr = sprintf($textTpl, $openID, $myID, $time, $rspType, $arr["mediaid"], $arr["title"], $arr["desc"]);
		echo $resultStr;
	}
	
	//回复音乐
	/*
	传入
	$arr["title"]		标题
	$arr["desc"]		描述
	$arr["nomalurl"]	低音质url
	$arr["hqurl"]		高音质url
	$arr["thumbid"]		缩略图id
	*/
	private function RspMusic($postObj, $arr)
	{
		$openID = $postObj->FromUserName;
		$myID = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Music>
						<Title><![CDATA[%s]]></Title>
						<Description><![CDATA[%s]]></Description>
						<MusicUrl><![CDATA[%s]]></MusicUrl>
						<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
						<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
						</Music>
					</xml>";             
		$rspType = "music";
		$resultStr = sprintf($textTpl, $openID, $myID, $time, $rspType, $arr["title"], $arr["desc"], $arr["nomalurl"], $arr["hqurl"], $arr["thumbid"]);
		echo $resultStr;
	}
	
	//回复图文
	/*
	传入二维数组
	$arr[$i]["title"]		标题
	$arr[$i]["desc"]		描述
	$arr[$i]["picurl"]		图片url
	$arr[$i]["url"]			跳转url
	*/
	private function RspArticle($postObj, $arr)
	{
		$openID = $postObj->FromUserName;
		$myID = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>%s</ArticleCount>
						<Articles>";
		$rspType = "news";
		$textTpl = sprintf($textTpl, $openID, $myID, $time, $rspType, count($arr));
		
		for($i=0; $i<count($arr); $i++)
		{
			$textTpl = $textTpl."<item>
								<Title><![CDATA[%s]]></Title> 
								<Description><![CDATA[%s]]></Description>
								<PicUrl><![CDATA[%s]]></PicUrl>
								<Url><![CDATA[%s]]></Url>
								</item>";
			$textTpl = sprintf($textTpl, $arr[$i]["title"], $arr[$i]["desc"], $arr[$i]["picurl"], $arr[$i]["url"]);
		}
		$textTpl =	$textTpl."</Articles>
					</xml>";             
		
		echo $textTpl;
	}
		
	//===============================客服接口==========================
	
	//转到客服
	private function customService($postObj)
	{
		$openID = $postObj->FromUserName;
		$myID = $postObj->ToUserName;
		$time = time();
		$rspType = "transfer_customer_service";
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
					</xml>";
		$resultStr = sprintf($textTpl, $openID, $myID, $time, $rspType);
		echo $resultStr;
	}
	
	//发送客服消息
	public function sendKefuMsg($openid, $msgtype, $arr)
	{
		$data["touser"] = $openid;
		$data["msgtype"] = $msgtype;
		
		if($msgtype == "text")
		{
			$data[$msgtype]=array("content" => $arr["content"]);
		}
		else if($msgtype == "image")
		{
			$data[$msgtype]=array("media_id" => $arr["mediaid"]);
		}
		else if($msgtype == "voice")
		{
			$data[$msgtype]=array("media_id" => $arr["mediaid"]);
		}
		else if($msgtype == "video")
		{
			$data[$msgtype]=array(
				"media_id" => $arr["mediaid"], 
				"title" => $arr["title"], 
				"description" => $arr["desc"]);
		}
		else if($msgtype == "music")
		{
			$data[$msgtype]=array(
				"title" => $arr["title"], 
				"description" => $arr["desc"], 
				"musicurl" => $arr["musicurl"], 
				"hqmusicurl" => $arr["hqurl"], 
				"thumb_media_id" => $arr["thumbid"]);
		}
		else if($msgtype == "news")
		{
			//$arr[0]["title"];$arr[1]["title"];
			$data[$msgtype] = array("articles" => $arr);
		}
		
		$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$myhttp = new CurlHttp();
		$url = KEFUURL."?access_token=".$this->readtoken();	
		$ret = $myhttp->post($url, $json_data);
		return $ret;
	}
	
	//===============================群发接口==========================
	
	//上传图文素材
	/*请求   二维数组
	$arr[0]["thumb_media_id"];		//必须，图文消息缩略图的media_id，可以在基础支持-上传多媒体文件接口中获得
	$arr[0]["author"];				//非必须，图文消息的作者
	$arr[0]["title"];				//必须，图文消息的标题
	$arr[0]["content_source_url"];	//非必须，在图文消息页面点击“阅读原文”后的页面
	$arr[0]["content"];				//必须，图文消息页面的内容，支持HTML标签
	$arr[0]["digest"];				//非必须，图文消息的描述
	$arr[0]["show_cover_pic"];		//非必须，是否显示封面，1为显示，0为不显示
	
	返回mediaid
	*/
	public function uploadnews($arr)
	{
		$data["articles"] = $arr;
		$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$myhttp = new CurlHttp();
		$url = NEWS_UPLOAD."?access_token=".$this->readtoken();		
		$ret = $myhttp->post($url, $json_data);
		$json = json_decode($ret, true);
		return $json["media_id"];
	}
	
	//分组群发
	/*请求
	$arr["msgtype"];
	$arr["groupid"];
	$arr["content"];
	$arr["mediaid"];
	$arr["title"];
	$arr["desc"];
	
	openid列表群发要加下面的参数
	$data[0]="openid1";
	$data[1]="openid2";
	$arr["sendlist"] = $data;
	
	返回mediaid
	*/
	
	public function sendMass($arr)
	{
		$blist = false;
		$massurl = MASS_GROUPURL;
		if(!empty($arr["sendlist"]))
		{
			$list = $arr["sendlist"];
			$blist = true;
			$massurl = MASS_LISTURL;
		}
		
		$msgtype = $arr["msgtype"];
		$data = array();
		if($msgtype == "text")	//文本
		{
			if($blist == true)
			{
				$data["touser"] = $list;
			}
			else
			{
				$data["filter"] = array("group_id" => $arr["groupid"]);
			}
			$data[$msgtype] = array("content" => $arr["content"]);
			$data["msgtype"] = $msgtype;
		}
		else if($msgtype == "mpvideo")	//视频,没调通不可用
		{/*
			$temp["media_id"] = $arr["mediaid"];
			$temp["title"] = $arr["title"];
			$temp["description"] = $arr["desc"];
			$uploadurl = "https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=".$this->readtoken();		
			$myhttp = new CurlHttp();
			$json_temp = json_encode($temp, JSON_UNESCAPED_UNICODE);
			$tempret = $myhttp->post($uploadurl, $json_temp);
			$uploaddata = json_decode($tempret, true);
			
			if($blist == true)
			{
				$data["touser"] = $list;
			}
			else
			{
				$data["filter"] = array("group_id" => $arr["groupid"]);
			}
			$data[$msgtype] = array("media_id" => $uploaddata["media_id"]);
			$data["msgtype"] = $msgtype;
			*/
		}
		else	//其他
		{
			if($blist == true)
			{
				$data["touser"] = $list;
			}
			else
			{
				$data["filter"] = array("group_id" => $arr["groupid"]);
			}
			$data[$msgtype] = array("media_id" => $arr["mediaid"]);
			$data["msgtype"] = $msgtype;
		}
		$url = $massurl."?access_token=".$this->readtoken();		
		$myhttp = new CurlHttp();
		$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$ret = $myhttp->post($url, $json_data);
		$json = json_decode($ret, true);
		return $json["msg_id"];
	}
	
	
	//删除群发
	public function delMass($msgid)
	{
		$url = MASS_DELURL."?access_token=".$this->readtoken();		
		$data["msgid"] =  $msgid;
		$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$myhttp = new CurlHttp();
		$ret = $myhttp->post($url, $json_data);
		return $ret;
	}
	

	//================================用户管理==========================================
	
	//创建分组 返回id
	public function createGroup($name)
	{
		$url = CREATEGROUP."?access_token=".$this->readtoken();		
		$data["group"] = array("name" => $name);
		$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$myhttp = new CurlHttp();
		$ret = $myhttp->post($url, $json_data);
		$json_ret = json_decode($ret, true);
		return $json_ret["group"]["id"];
	}
	
	//查询分组
	public function getAllGroup()
	{
		$url = GETALLGROUP."?access_token=".$this->readtoken();	
		$myhttp = new CurlHttp();
		$ret = $myhttp->get($url);
		$json = json_decode($ret, true);
		
		return $json;
	}
	
	//查询用户所在分组
	public function searchGroup($openid)
	{
		$url = SEARCHGROUP."?access_token=".$this->readtoken();	
		$data["openid"] = $openid;
		$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$myhttp = new CurlHttp();
		$ret = $myhttp->post($url, $json_data);
		$data_ret = json_decode($ret, true);
		return $data_ret["groupid"];	
	}
	
	//修改分组名
	public function editGroup($groupid, $name)
	{
		$url = EDITGROUP."?access_token=".$this->readtoken();	
		$req["group"] = array('id' => $groupid, 'name' => $name);
		$json_req = json_encode($req, JSON_UNESCAPED_UNICODE);
		$myhttp = new CurlHttp();
		$ret = $myhttp->post($url, $json_req);
		
		return $ret;
	}
	
	//移动用户分组
	public function moveUser($openid, $togroupid)
	{
		$url = MOVEUSER."?access_token=".$this->readtoken();	
		$req["openid"] = $openid;
		$req["to_groupid"] = $togroupid;
		
		$json_req = json_encode($req, JSON_UNESCAPED_UNICODE);
		$myhttp = new CurlHttp();
		$rsp = $myhttp->post($url, $json_req);
		return $rsp;
	}
	
	//API获取用户基本信息
	/*
	参数	说明
	subscribe	 用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。
	openid	 用户的标识，对当前公众号唯一
	nickname	 用户的昵称
	sex	 用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
	city	 用户所在城市
	country	 用户所在国家
	province	 用户所在省份
	language	 用户的语言，简体中文为zh_CN
	headimgurl	 用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空
	subscribe_time	 用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间
	unionid	 只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。详见：获取用户个人信息（UnionID机制）
	*/
	public function getUserInfo($openid)
	{
		
		$url = GETUSERINFO."?access_token=".$this->readtoken()."&openid=".$openid."&lang=zh_CN";
		$myhttp = new CurlHttp();
		$rsp = $myhttp->get($url);
		$json_rsp = json_decode($rsp, true);
		
		return $json_rsp;
	}
	
	//拉取用户列表
	public function getUserList($nextopenid = '')
	{
		$url = GETUSERLIST."?access_token=".$this->readtoken()."&next_openid=".$nextopenid;
		$myhttp = new CurlHttp();
		$rsp = $myhttp->get($url);
		$json_rsp = json_decode($rsp, true);
		$retarr;
		for($i=0; $i<$json_rsp["count"]; $i++)
		{
			$retarr[$i] = $json_rsp["data"]["openid"][$i];
		}
		
		
		return $retarr;
	}
	
	//网页授权code换取用户详细信息
	/* 输入参数
	$arr["code"]		需要用户同意授权后获取code
	$arr["appid"]	有权限账号的appid，不赋值默认使用自己的
	$arr["secret"]	有权限账号的secret，不复制默认使用自己的
	
	
	
	参数	描述
	openid	 用户的唯一标识
	nickname	 用户昵称
	sex	 用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
	province	 用户个人资料填写的省份
	city	 普通用户个人资料填写的城市
	country	 国家，如中国为CN
	headimgurl	 用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空
	privilege	 用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）

	*/
	public function oauthUserInfo($arr)
	{
		$ret = $this->oauthOpenid($arr);
		$temptoken = $ret["access_token"];
		$openid = $ret["openid"];
		if(!empty($temptoken))
		{
			$url = OAUTHINFO."?access_token=".$temptoken."&openid=".$openid."&lang=zh_CN";
			$myhttp = new CurlHttp();
			$inforsp = $myhttp->get($url);
			$json_data = json_decode($inforsp, true);
			return $json_data;
		}
		else
		{
			return "";
		}
		
	}
	
	//网页授权获取openid、token
	public function oauthOpenid($arr)
	{
		if(empty($arr["appid"]))	$arr["appid"] = APPID;
		if(empty($arr["secret"]))	$arr["secret"] = SECRET;
		$url = OAUTHTOKEN."?appid=".$arr["appid"]."&secret=".$arr["secret"]."&code=".$arr["code"]."&grant_type=authorization_code";
		$myhttp = new CurlHttp();
		$rsp = $myhttp->get($url);
		$json_rsp = json_decode($rsp, true);
		return $json_rsp;
	}
	
	//===================================自定义菜单=========================================
	
	//创建自定义菜单
	public function createMenu($json)
	{
		$url = CREATEMENU."?access_token=".$this->readtoken();
		$myhttp = new CurlHttp();
		$rsp = $myhttp->post($url, $json);
		return $rsp;
	}
	
	//查询自定义菜单
	public function searchMenu()
	{
		$url = SEARCHMENU."?access_token=".$this->readtoken();
		$myhttp = new CurlHttp();
		$ret = $myhttp->get($url);
		return $ret;
	}
	
	//删除自定义菜单
	public function delMenu()
	{
		$url = DELMENU."?access_token=".$this->readtoken();
		$myhttp = new CurlHttp();
		$ret = $myhttp->get($url);
		return $ret;
	}
}










class CurlHttp
{
	public function get($url, $param=array())
	{
		if(!is_array($param)){
			throw new Exception("参数必须为array");
		}
		$p='';
		foreach($param as $key => $value){
			$p=$p.$key.'='.$value.'&';
		}
		if(preg_match('/\?[\d\D]+/',$url)){//matched ?c
			$p='&'.$p;
		}else if(preg_match('/\?$/',$url)){//matched ?$
			$p=$p;
		}else{
			$p='?'.$p;
		}
		$p=preg_replace('/&$/','',$p);
		$url=$url.$p;
		//echo $url;
		$httph =curl_init($url);
		curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($httph,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		
		curl_setopt($httph, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($httph, CURLOPT_HEADER,0);
		$rst=curl_exec($httph);
		if (curl_errno($httph)) {
         return curl_error($httph);
        }
		curl_close($httph);
		return $rst;
	}
	/*
	 * post method
	 */
	public function post($url, $param=array())
	{
		/*if(!is_array($param)){
			throw new Exception("参数必须为array");
		}*/
		$httph =curl_init($url);
		curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($httph,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		curl_setopt($httph, CURLOPT_POST, 1);//设置为POST方式 
		curl_setopt($httph, CURLOPT_POSTFIELDS, $param);
		curl_setopt($httph, CURLOPT_HEADER,0);
		$rst=curl_exec($httph);
		if (curl_errno($httph)) {
         return curl_error($httph);
        }
		curl_close($httph);
		return $rst;
	}
	
	

}
