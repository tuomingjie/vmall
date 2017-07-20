<?php
namespace Home\Controller;
use Think\Controller;
class CategoryController extends Controller {
    public function index(){
        //对数据分类进行显示到前台
		$parents=M('Category')->where(array('category_pid'=>0))->order('category_id')->select();
		 $child_category=array();
		 foreach($parents as $p){
		     $path='0-'.$p['category_id'];
			 $child=M('Category')->where(array('category_path'=>array('like',$path)))->select();
			 $child_category[$p['category_id']]=$child;
		}
		 
		$str='';
		foreach($parents as $p){
		    $url=U('List/index',array('f'=>$p['category_id']));
			$str.="<li><h3><a  href='{$url}'><span>{$p['category_name']}</span></a></h3>";
			foreach($child_category[$p['category_id']] as $child){
			    $new_url=U('List/index',array('f'=>$child['category_id']));
			   $str.="<a  href='{$new_url}'><span>{$child['category_name']}</span></a>";
			
			}
			
			$str.="</li>";
		
		
		
		
		}
		
		
		echo $str;
		
		
	}
}