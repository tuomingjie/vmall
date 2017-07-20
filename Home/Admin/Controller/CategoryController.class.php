<?php
 /*
  * 网站后台商品分类管理
  */
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {
		
      //重写更新
	  public function add(){
	     //获取所有的分类传到前台进行处理
	    $cat=M('Category');
		 $info=$cat->field('category_id,category_name,concat(category_path,"-",category_id) as path')->order('path asc')->select();
	

		 $i=0;
		 //进行商品分类处理
		 foreach($info as $cat){
		     
		     $path=strlen($cat['path'])==3?0:strlen($cat['path']);
			 $data[$i]['category_id']=$cat['category_id'];
			 $data[$i]['category_name']=$cat['category_id']=str_repeat('&nbsp;',2*$path).$cat['category_name'];
			 $i++;
		 }
		 $this->cat_info=$data;
		 
	     //调用父类的方法
	     parent::add();
	  
	  
	  }
	  
	    //重写增加数据方法
	  public function  insert(){
	       //获取post传递的分类名和父id
	      $cat_name=I('post.category_name');
		  $cat_pid=I('post.category_pid');
		  $c=M('Category'); 
		  //查询父id的路径
		  $cpath=$c->where("category_id={$cat_pid}")->field('category_path')->select();
		 
		  $_POST['category_name']=$cat_name;    
		  $_POST['category_pid']=$cat_pid;
		   //组合的路径
	      $_POST['category_path']=$cat_pid==0?0:$cpath[0]['category_path']."-". $cat_pid;
		 
	      
		  
		  //调用父类的方法
		  parent::insert();
	  }
	     //调用更改的模板
	  public function  edit(){
	      $cat=M('Category');
		  $info=$cat->field('category_id,category_name,concat(category_path,"-",category_id) as path')->order('path asc')->select();
		   $i=0;
		   //进行商品分类处理
		    foreach($info as $cat){
		     
		     $path=strlen($cat['path'])==3?0:strlen($cat['path']);
			 $data[$i]['category_id']=$cat['category_id'];
			 $data[$i]['category_name']=$cat['category_id']=str_repeat('&nbsp;',2*$path).$cat['category_name'];
			 $i++;
		 }
		    //向前台传送分类信息
		  $this->cat_info=$data;
		  
	   
	      parent::edit();
	  
	     
	  }
	       //重写更新的商品分类
	  public function update(){
	       $category_name=I('post.category_name');
		   $category_pid=I('post.category_pid');
		   $category_id=I('post.category_id');
		   //获取表中的值比较
		   $c=M('Category')->where('category_id='.$category_id)->field('category_name,category_pid,category_path')->select();
		   
		   
		      $cat=M('Category');
		      //对父id和路径更新进行判断
			  //是不是插入到了自己上
			if($category_pid==$category_id){
			     $this->error('失败');
				 return;
			}

		   if($category_pid!=$c[0]['category_pid']){
		         //是不是更改到了顶级类上
				 if($category_pid==0){
				     $data['category_pid']=$category_pid;
					 $data['category_path']='0';
					 $data['category_name'] = $category_name;	//chen 2017-6-30
				     $cat->where('category_id='.$category_id)->save($data);
					 //组合新的路径
					 $path='0-'.$category_id;
					 $cpath=$c[0]['category_path']."%";
					 $replace=$c[0]['category_path']."-".$category_id;
					  //更新子类的path
					 $sql="update vmall_category set `category_path`=replace(`category_path`,'{$replace}','{$path}') where `category_path` like '{$cpath}'";
					 $cat->execute($sql);
					 $this->success(L("更新成功！"));
					 return ;
				 
				 }else{
				     //判断更新的类是不是子类
					 //$ppath是父path
					 $where['category_id']=$category_pid;
				     $ppath=$cat->where($where)->field('category_path')->select();
					
					 
				     if(in_array($category_id,explode('-',$ppath[0]['category_path']))){
					     $this->error('不能插入子类中');
						  return ;
					 }
					 //到此的path
					 $path=$ppath[0]['category_path']."-".$category_pid;
					 
				     //子类跟新path头
					 $cpath=$path."-".$category_id;
					 //子类的头
					 $likepath=$c[0]['category_path']."-".$category_id."%";
					 $replacepath=$c[0]['category_path']."-".$category_id;
					 //跟新子类
				     $sql="update vmall_category set `category_path`=replace(`category_path`,'{$replacepath}','{$cpath}') where `category_path` like '{$likepath}'";
					 $cat->execute($sql);
				 
				     //更新自己的路径和父类
				     $data['category_pid']=$category_pid;
					 $data['category_path']=$path;
					 $data['category_name'] = $category_name;	//chen 2017-6-30
				     $cat->where('category_id='.$category_id)->save($data);
                     $this->success(L("更新成功！"));
					 return ;
				 }
				 
				
		      
		   }
		   
		   if($category_name!=$c['0']['category_name']){
		        $name['category_name']=$category_name;
		       M('Category')->where('category_id='.$category_id)->save($name);
			   $this->success(L("成功！"));
		   }else{
		     $this->success(L("没有修改信息！"));
		   
		   }
		   
		   
	       
	     
	  }
	  
	  //删除操作
	  public function del(){
	       $category_id=I("request.category_id");
		   $where['category_pid']=$category_id;
		   if(M('category')->where($where)->select()){
		      $this->error('删除error');
		      return ;
		   }
		   
	        parent::del();
	  
	  
	  
	  }
    
	  
    
}