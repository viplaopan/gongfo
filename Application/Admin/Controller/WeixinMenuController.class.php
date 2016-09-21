<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-14
 * Time: AM10:59
 */

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminSortBuilder;

class WeixinMenuController extends AdminController
{
	//菜单列表
    public function index($page = 1, $r = 20)
    {
    	//读取广告位
        $map = array('status' => array('EGT', 0));
		$map['status'] = array('EGT', 0);
		$map['pid'] = array('EQ', 0);
		$WeixinMenuModel = D('WeixinMenu');
       
        $lists = $WeixinMenuModel->where($map)->page($page, $r)->order('sort asc')->select();
        foreach($lists as &$val){
			//一级菜单
        	if($val['menu_type'] == 1){
        		$item = M('WeixinMitem')->where(array('pid' => $val['id'],'menu_type'=>1))->find();//获取一级菜单的子菜单
        		$val['do'] = '<a href="' . U('edit',array('id' => $val['id'])) . '"><i class="icon-cog"></i> 编辑</a>&nbsp;&nbsp;<a href="' . U('editItem', array('pid' => $val['id'],'id'=> $item['id'])) . '"><i class="icon-cog"></i> 设置一级菜单</a>&nbsp;&nbsp;';
        	}
			//多级菜单
			if($val['menu_type'] == 2){
        		$val['do'] = '<a href="' . U('edit',array('id' => $val['id'])) . '"><i class="icon-cog"></i> 编辑</a>&nbsp;&nbsp;<a href="' . U('itemList', array('pid' => $val['id'])) . '"><i class="icon-cog"></i> 添加二级</a>&nbsp;&nbsp;';
        	}
        }
		unset($val);
        $totalCount = $WeixinMenuModel->where($map)->count();
		
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('微信菜单列表(二级菜单功能开发中)')
            ->buttonNew(U('edit'))
            ->buttonDelete()
			->buttonNew(U('submitMenu'),'提交导航')
            ->keyId()
			->keyText('name', '菜单标题')
            ->keyText('menu_type', '按钮类型')            
			->keyText('sort', '排序')
            ->keyStatus()
			->keyHtml('do', '操作', '320px')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
	//添加单个菜单
	public function edit($id = null){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		$model = M('WeixinMenu');
		if(IS_POST){
			
			$data = $model->create();
	        //写入数据库
	        if ($isEdit) {
	            $result = $model->where(array('id' => $id))->save($data);
	        } else {
	            $result = $model->add($data);
	        }

	        if (!$result) {
	            $this->error($isEdit ? '编辑失败' : '创建失败');
	        }
			$this->success($isEdit ? '编辑成功' : '创建成功', U('index'));
	        
		}else{
			//读取规则内容
	        if ($isEdit) {
	            $data = $model->where(array('id' => $id))->find();
	        } else {
	            $data = array('status' => 1);
	        }

			$btn_types = array(
				'1' => '一级菜单',
				'2' => '二级菜单',
			);
	        //显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑页面' : '添加页面')
	            ->keyId()
	            ->keyText('name', '菜单名称')
				->keySelect('menu_type', '按钮类型', '',$btn_types)
				->keyInteger('sort', '排序')
	            ->keyStatus()
	            ->data($data)
	            ->buttonSubmit(U('edit'))->buttonBack()
	            ->display();
		}
	}
	//添加详细菜单
	public function editItem($pid = null,$id = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		$model = M('WeixinMitem');
		$WeixinMenuModel = M('WeixinMenu');
		if(IS_POST){
			
			$data = $model->create();
			//获取Pid 判断是否是多级菜单
			$parent = $WeixinMenuModel->where(array('id' => $data['pid']))->find();
			$data['menu_type'] = $parent['menu_type'];
			$data['type'] = I('post.type2');
			unset($data['type2']);
	        //写入数据库
	        if ($isEdit) {
	        	
	            $result = $model->where(array('id' => $id))->save($data);
	        } else {
	            $result = $model->add($data);
	        }

	        if (!$result) {
	            $this->error($isEdit ? '编辑失败' : '创建失败');
	        }
			$this->success($isEdit ? '编辑成功' : '创建成功', U('index'));
	        
		}else{
			
			$parent = $WeixinMenuModel->where(array('id' => $pid))->find();
			//读取规则内容
	        if ($isEdit) {
	            $data = $model->where(array('id' => $id))->find();
	        } else {
	            $data = array('status' => 1);
	        }
			
			$data['pid'] = $pid;
			$arr = array(
				'click' => '点击事件',
				'view' => ' 链接',
			);
			$data['type2'] = $data['type'];
			unset($data['type']);
			
			$meta_title = '编辑按钮';
			$this->assign('info',$data);
			$this->assign('parent',$parent);
			$this->assign('meta_title',$meta_title);
			$this->display();
			
			

		}
	}
	
	public function itemList($pid = null,$page = 1, $r = 20){
		//微信
		$WeixinMenuModel = D('WeixinMenu');
		
        $parent = $WeixinMenuModel->where(array('id = '.$pid))->find();
		

		$WeixinMitem = M('WeixinMitem'); 
		$map['status'] = array('EGT', 0);
		$map['pid'] = array('EQ', $pid);
		$map['menu_type'] = 2;
		$lists = $WeixinMitem->where($map)->page($page, $r)->select();
		$totalCount = $WeixinMitem->where($map)->count();
		foreach($lists as &$val){
        	$val['do'] = '<a href="' . U('editItem',array('pid'=>$pid,'id' => $val['id'])) . '"><i class="icon-cog"></i> 编辑</a>&nbsp;&nbsp;';
        	
        }
		
		
		//显示页面
        $builder = new AdminListBuilder();
        $builder->title($parent['name'] .':')
            ->buttonNew(U('editItem',array('pid'=>$pid)))
            ->buttonDelete()
            ->keyId()
			->keyText('name', '菜单标题')
            ->keyText('menu_type', '按钮类型')            
			->keyText('sort', '排序')
            ->keyStatus()
			->keyHtml('do', '操作', '320px')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
	}
    public function submitMenu(){
    	$WeixinMenu = M('WeixinMenu');
		$WeixinMitem = M('WeixinMitem');
		//微信按钮生成
		$map['status'] = 1;
		$menus = $WeixinMenu->where($map)->order('sort asc')->select();
		$menuArr['button'] = array();
		foreach($menus as $val){
			//一级菜单
			if($val['menu_type'] == 1){
				//读取一级菜单事件详细信息
				$item = $WeixinMitem->where(array('pid' => $val['id']))->find();
				
				if($item['type'] == 'view'){
					$itemArr = array(
						'type'=> $item['type'],
						'name'=> $val['name'],
						'url' =>$item['url']
					);
					
				}
				if($item['type'] == 'click'){
					$itemArr = array(
						'type'=> $item['type'],
						'name'=> $val['name'],
						'key' => $item['key']
					);
				}

			}else{
				//读取多级菜单事件详细信息
				$items = $WeixinMitem->where(array('pid' => $val['id']))->select();
				$itemArr = array();
				$itemArr['sub_button'] = array();
				$btn = array();
				foreach($items as $v){
					if($v['type'] == 'view'){
						$itemArr['name'] = $val['name'];
						$btn = array(
							'type'=> $v['type'],
							'name'=> $v['name'],
							'url' =>$v['url']
						);
						
					}
					if($v['type'] == 'click'){
						$itemArr['name'] = $val['name'];
						$btn = array(
							'type'=> $v['type'],
							'name'=> $v['name'],
							'key' => $v['key']
						);
					}
				
					array_push($itemArr['sub_button'],$btn);
				}
				
			}
			
			array_push($menuArr['button'],$itemArr);
		}
		
		$data = json_encode($menuArr,JSON_UNESCAPED_UNICODE);//PHP 版本 5.4以上 
		
		$res = request_post('https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . get_access_token(C('DATA_AUTH_KEY')),$data);
		$res = json_decode($res,true);
		if($res['errmsg'] == 'ok'){			
			echo '提交成功';
		}else{
			$this->error(json_encode($res));
		}
    }
}