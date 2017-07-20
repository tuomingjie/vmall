<?php
 /*
  * 网站后台资讯管理
  * 继承Common控制器实现逻辑
  */
namespace Admin\Controller;
use Think\Controller;
class InfoController extends CommonController {
      
	
    
	
	
	public function edit() {
		
		$model = M(CONTROLLER_NAME);
		$id = $_REQUEST[$model->getPk()];
		$vo = $model->find($id);
		
		$vo['info_content'] = htmlspecialchars_decode(html_entity_decode($vo['info_content']));
		$this->assign('vo', $vo);
		$this->display('edit');
	}
	
	
}