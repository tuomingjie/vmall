<?php
/*
 *公用的控制器
 */
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	

	
	
	function __construct() {
		parent::__construct();
		$this->get_category();
		$this->get_set();
	}
	
	
    
	//导航全部商品分类
	public function get_category(){
		
	  $category = M("category");
	  $category_one = $category->where(array('category_type'=>1))->limit(9)->select();	//获取一级分类
	  $category_two = $category->where(array('category_type'=>2))->select();			//获取二级分类
	  $category_info = array();
		foreach($category_one as $k=>$v){
			foreach($category_two as $key=>$value){
				if($value['category_pid']== $v['category_id']){
					$v['children'][] = $value; 
				}
			}
			$category_info[] = $v;
			
		}
		$this->category_info = $category_info;
	}
	
	//获取网址配置信息
	public function get_set(){
		$set = M("set");
		$set_info = $set->select();
		$this->set_info = $set_info;
	}

    /**
     * 根据表单生成查询条件
     * 进行列表过滤
     * @param string $name 数据对象名称
     * @return HashMap
     */
    protected function _search($name='') {
        //生成查询条件
        if (empty($name)) {
            $name = CONTROLLER_NAME;
        }
        $model = M($name);
        $map = array();

        foreach ($model->getDbFields() as $key => $val) {
            if (substr($key, 0, 1) == '_')
                continue;
            if (isset($_REQUEST[$val]) && $_REQUEST[$val] != '') {
                $map[$val] = $_REQUEST[$val];
            }
        }
        return $map;
    }
	
	
	
	
	
	
	
	
	
	
	
}