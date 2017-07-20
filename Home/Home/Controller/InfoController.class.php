<?php
    /*
	 *这是资讯页控制器
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class InfoController extends CommonController {
    
	public function index(){
		
		$info = M('info');
		
		$info_id = I('get.info_id',0);
		if($info_id == 0){
			$this->redirect("Index/index"); 
		}
		
		$info_list = $info->field('info_id,info_name')->select();
		
		$vo = $info->where(array('info_id'=>$info_id))->find();
		$vo['info_content'] = htmlspecialchars_decode(html_entity_decode($vo['info_content'])); 
		$this->info_list = $info_list;
		$this->vo = $vo;
		$this->display();
	}
}