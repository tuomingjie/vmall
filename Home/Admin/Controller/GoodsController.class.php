<?php
 /*
  * 网站后台商品管理
  */
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends CommonController {
   
      //商品新增的显示界面
	 public function add(){
	 
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

		 //把商品的属性传到 前台进行处理
		 $attrs=M()->query("SELECT attr_name,avalue_id,avalue_value FROM vmall_attr,vmall_avalue where vmall_attr.attr_id=vmall_avalue.attr_id ");
		 foreach($attrs as $att){
		 
		     $avalue_info[$att['attr_name']][]=array('avalue_id'=>$att['avalue_id'],'avalue_value'=>$att['avalue_value']);
		 
		 
		 }

		 $this->avalue_info=$avalue_info;
		 
		/*供应商信息*/ 
		$supplier = M('supplier');
		$supplier_info = $supplier->field('id as supplier_id, name as supplier_name')->select();
		$this->assign('supplier_info',$supplier_info);
		

		$html = $this->add_html($one,$two,$three);
		$this->assign('html',$html);
		
		
		//品牌信息
		$brand = M('brand');
		$brand_info = $brand->field('brand_id,brand_name')->select();
		$this->brand_info = $brand_info;
		
		
		 $this->display();
	  }
	  
	  

	  
	  
	  
	  
	  
	  public function insert(){

			$gc_name = I('post.gc_name');		//颜色名
			$ga_name = I('post.ga_name');		//自定义属性名
			$ga_value = I('post.ga_value');		//自定义属性值

			
	
			
	   
	       $upload = new \Think\Upload();
		   // 实例化上传类    
		   $upload->maxSize=3*1000*1000;
		   // 设置附件上传大小   
		   $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
		   // 设置附件上传类型    
		   $uplaod->autoSub=true;
		   //开启上传的子路经
		   $upload->subName=array('date','YmdHis');
		   $upload->rootPath="./Upload";
		   //上传路径
		   $upload->savePath ='./goods/'; 
		   $info = $upload->upload();
		   if(!$info) {
		         // 上传错误提示错误信息  
			  $this->error($upload->getError());
			}else{
			    // 上传成功 获取上传文件信息   
				
				$_POST['goods_big_pic']=ltrim($info['goods_img']['savepath'],'.').$info['goods_img']['savename'];
				   //调用生成缩略图
				
				$img_thumb=$this->makePic(ltrim($info['goods_img']['savepath'],'.'),$info['goods_img']['savename']);
			    //保存
				$_POST['goods_small_pic']=$img_thumb['goods_small_pic'];
				$_POST['goods_tiny_pic']=$img_thumb['goods_tiny_pic'];
				$_POST['goods_desc_pic']=$img_thumb['goods_desc_pic'];
				

				$goods_pic_arr = array();	//产品图片数组
				$goods_color_arr = array();	//产品颜色图片数组
				
				foreach($info as $k=>$v){

					if($v['key']=='gp_pic'){

						$goods_pic_arr[] = ltrim($v['savepath'],'.').$v['savename'];
					}
					
					if($v['key']=='gc_img'){
						$goods_color_arr[] = ltrim($v['savepath'],'.').$v['savename'];
					}
					
				}

				   
		    }
			
			
	
			
			
			
			
			
			
			
		      // 生成商品的编号 有时间和随机数生成
			  $goods_no=date("Ymd").mt_rand(100,999);
			  $_POST['goods_no']=$goods_no;
			
		    //获取商品的属性进行组合处理插入数据库
			$goods_attr=I("post.goods_attr");
			if(empty($goods_attr)){
			  
			      $this->error("请选择商品的属性!");
				  return;
			}
			
			$_POST['goods_attr_value']=implode(',',$goods_attr);
			//对上传的时间进行处理
			
			$_POST['goods_time']=strtotime(I('post.goods_time'));
			// dump($_POST);
			//调用父类的insert方法
			
			$m=M("Goods");
			
			
	        $model = D(CONTROLLER_NAME);
			unset( $_POST[$model->getPk()]);
			if (false === $model->create()) {
				$this->error($model->getError());
			}
			
			
			$goods_pic = M('goods_pic');
			$goods_color = M('goods_color');
			$goods_attr_model = M('goods_attr');
			$region_price = M('region_price');
			$model->startTrans();	//开启事务
			$goods_pic->startTrans();	//开启事务
			$goods_color->startTrans();	//开启事务
			$goods_attr_model->startTrans();	//开启事务
			$region_price->startTrans();	//开启事务
			$check = true;
			//保存当前数据对象
			if ($result = $model->add()) { //保存成功
				
				//插入产品图片
				
				foreach($goods_pic_arr as $v){
					$data = array();
					$data['goods_id'] = $result;
					$data['gp_pic'] = $v;
					$add_img_result = $goods_pic->add($data);
					if(!$add_img_result){
						$check = false;
					}
				}
				
				
				//插入颜色和颜色图片
				
				foreach($goods_color_arr as $k=>$v){
					foreach($gc_name as $k2=>$v2){
						if($k == $k2){
							$data = array();
							$data['gc_name'] = $v2;
							$data['gc_img'] = $v;
							$data['goods_id'] = $result;
							$add_color_result = $goods_color->add($data);
							if(!$add_color_result){
								$check = false;
							}
						}
					}
				}
				
				
				//插入自定义属性
				
				if(!empty($ga_name) && !empty($ga_value)){
					foreach($ga_name as $k=>$v){
						foreach($ga_value as $k2=>$v2){
							if($k==$k2){
								$data = array();
								$data['ga_name'] = $v;
								$data['ga_value'] = $v2;
								$data['goods_id'] = $result;
								$add_attr_result = $goods_attr_model->add($data);
								
								if(!$add_attr_result){
									$check = false;
								}
							}
						}
					}
				}
				
				
				
				
				
				
				
			
				//添加地区价格
				$region = M('region');
				$arr = session('region_price_arr');	
				if(isset($arr)){
					foreach($arr as $key=>$value){
						$data = array();
						$data['goods_id'] = $result;
						$data['region_id'] = $value['region_id'];
						$data['rp_price'] = $value['rp_price'];
						$add_region_price = $region_price->add($data);
						if(!$add_region_price){
							$check = false;
							break;
						}
						
					}
				}
				
				
		
				
				

				
				
				if($check){
					// 回调接口
					if (method_exists($this, '_tigger_insert')) {
						$model->id = $result;
						$this->_tigger_insert($model);
					}
					$model->commit(); 
					$goods_pic->commit(); 
					$goods_color->commit(); 
					$goods_attr_model->commit(); 
					$region_price->commit(); 
					
					//成功提示
					$this->success(L('新增成功'));
				}else{
					$model->rollback();	//事务回滚
					$goods_pic->rollback();	//事务回滚
					$goods_color->rollback();	//事务回滚
					$goods_attr_model->rollback();	//事务回滚
					$region_price->rollback();	//事务回滚
					$this->error(L('新增失败').$model->getLastSql());
				}
			
			
				
			} else {
				//失败提示
				
				$this->error(L('新增失败').$model->getLastSql());
			}
	  
	  }
	  
	 public function edit(){
		 
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
	 
	     /*供应商信息*/ 
		$supplier = M('supplier');
		$supplier_info = $supplier->field('id as supplier_id, name as supplier_name')->select();
		$this->assign('supplier_info',$supplier_info);
		
		//地区价格信息
		$region_price = M('region_price');
		$goods_id = I('get.goods_id');
		$field = "rp.*,r.region_name";
		$join = "LEFT JOIN vmall_region r on rp.region_id = r.region_id";
		$where['goods_id'] = $goods_id;
		$region_price_info = $region_price->alias('rp')->where($where)->field($field)->join($join)->select();

	
		
		$this->assign('region_price_info',$region_price_info);
		
		/**地区信息**/
		$region = M('region');
		$where = array();

		$where['region_id'] = array('GT',1);
		$info = $region->where($where)->select();
		$one = array();
		$two = array();
		$three = array();
		
		foreach($info as $k=>$v){
			if($v['region_type']==1){
				$one[] = $v;
			}
			
			if($v['region_type']==2){
				$two[] = $v;
			}
			
			if($v['region_type']==3){
				$three[] = $v;
			}
			
		}
		
		//品牌信息
		$brand = M('brand');
		$brand_info = $brand->field('brand_id,brand_name')->select();
		$this->brand_info = $brand_info;
		
		
		$html = $this->add_html($one,$two,$three);
		$this->assign('html',$html);
		
		
		$this->assign('one',$one);
		$this->assign('two',$two);
		$this->assign('three',$three);
		
		
		
		
	    
	   
	     //调用父类
	     parent::edit();
	 }
	  //重写更新方法
	 public function update(){
	    
		if($_FILES['goods_img']['name']){
		   $upload = new \Think\Upload();
		   // 实例化上传类    
		   $upload->maxSize=3*1000*1000;
		   // 设置附件上传大小   
		   $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
		   // 设置附件上传类型    
		   $uplaod->autoSub=true;
		   //开启上传的子路经
		   $upload->subName=array('date','YmdHis');
		   $upload->rootPath="./Upload";
		   //上传路径
		   $upload->savePath ='./goods/'; 
		   $info = $upload->upload();
		   if(!$info) {
		         // 上传错误提示错误信息  
			  $this->error($upload->getError());
			}else{
			     // 上传成功 获取上传文件信息   
                	 
			      $_POST['goods_big_pic']=ltrim($info['goods_img']['savepath'],'.').$info['goods_img']['savename'];
				   //调用生成缩略图
				
				  $img_thumb=$this->makePic(ltrim($info['goods_img']['savepath'],'.'),$info['goods_img']['savename']);
				   //保存
				  $_POST['goods_small_pic']=$img_thumb['goods_small_pic'];
				  $_POST['goods_tiny_pic']=$img_thumb['goods_tiny_pic'];
				  $_POST['goods_desc_pic']=$img_thumb['goods_desc_pic'];
		    }
		}
	     
		$_POST['goods_time'] = strtotime(I('post.goods_time'));
	         
		$model = D(CONTROLLER_NAME);

		if(false === $model->create()) {
			$this->error($model->getError());
		}
		// 更新数据
		if(false !== $model->save()) {
			// 回调接口
			if (method_exists($this, '_tigger_update')) {
				$this->_tigger_update($model);
			}
			//成功提示
			$this->success(L('更新成功'));
		} else {
			//错误提示
			$this->error(L('更新失败'));
		}
 
	 
	 }
	 
	 
	 //ajax更新地区金额
	 function ajax_update(){
		 if(IS_POST){
			 
			$model = M('region_price');
			$data = I('post.');
			
			$where['rp_id'] = $data['rp_id'];
			$result = $model->where($where)->save($data);
			
			if($result){
				$arr = array('status'=>1,'msg'=>'更新成功');
				$this->ajaxReturn($arr);
			}else{
				$arr = array('status'=>0,'msg'=>'更新失败');
				$this->ajaxReturn($arr);
			}
			 
			 
		 }
	 }
	 
	 //ajax 删除地区金额
	 function ajax_del(){
		if(IS_POST){
			 
			$model = M('region_price');
			$data = I('post.');
			$result = $model->delete($data['rp_id']);
			
			if($result){
				$arr = array('status'=>1,'msg'=>'删除成功');
				$this->ajaxReturn($arr);
			}else{
				$arr = array('status'=>0,'msg'=>'删除失败');
				$this->ajaxReturn($arr);
			}
			 
			 
		 } 
	 }
	 
	 
	 //ajax 添加地区金额
	 function ajax_add(){
		if(IS_POST){
			 
			$model = M('region_price');
			$data = I('post.');
			
			$result = $model->add($data);
			
			if($result){
				$arr = array('status'=>1,'msg'=>'添加成功','rp_id'=>$result);
				$this->ajaxReturn($arr);
			}else{
				$arr = array('status'=>0,'msg'=>'添加失败');
				$this->ajaxReturn($arr);
			}
			 
			 
		 } 
	 }
	 
	 
	 
	      //生成缩略图处理
	 public function  makePic($path,$img){
	     //获取图片的地址
	     $imgPath="./Upload".$path.$img;
		 //获取图片的保存的路径
		 $paths="./Upload".$path;
		 
		 //保存图片的地址
		 $thumb_img=array();
	      //实例化图片处理类 进行图片处理
	     $image = new \Think\Image();
		   //打开文件
		  $image->open($imgPath);
		  $type =strrchr($imgPath,"."); 
		 
		  
		  //生成缩略图
		  
		 
		 
		  
		     //列表展示图 428*428
		  
		  $small_unique=uniqid("428_428_").$type;
		 
		  $image->thumb(428,428)->save($paths.$small_unique);
		   //添加到数组返回
		  $thumb_img['goods_small_pic']=$path.$small_unique;
		  
		  
		    
		   //列表展示图 142*142
		  
		  $desc_unique=uniqid("142_142_").$type;
		  $image->thumb(142,142)->save($paths.$desc_unique);
		   //添加到数组返回
		  $thumb_img['goods_desc_pic']=$path.$desc_unique;
		  
		  
		   // 小图
		  $tiny_unique=uniqid("60_60_").$type;
		  
		  $image->thumb(60,60)->save($paths.$tiny_unique);
		    //添加到数组返回
		  $thumb_img['goods_tiny_pic']=$path.$tiny_unique;
		 
	     return $thumb_img;
	 }
	 


	
	
	
	 
	 
	 
	 
	 /**
	 * 根据表单生成查询条件
	 * 进行列表过滤
	 * @param Model $model 数据对象
	 * @param HashMap $map 过滤条件
	 * @param string $sortBy 排序
	 * @param boolean $asc 是否正序
	 */
	protected function _list($model, $map = array(), $sortBy = '', $asc = false) {
		
		//排序字段 默认为主键名
		if (!empty($_REQUEST['_order'])) {
			$order = $_REQUEST['_order'];
		} else {
			$order = !empty($sortBy)?$sortBy:$model->getPk();
		}
		
		//排序方式默认按照倒序排列
		//接受 sort参数 0 表示倒序 非0都 表示正序
		if (!empty($_REQUEST['_sort'])) {
			$sort = $_REQUEST['_sort'] == 'asc'?'asc':'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		
		
		
		//取得满足条件的记录数
		$count = $model->where($map)->count();
		
		//每页显示的记录数
		if (!empty($_REQUEST['numPerPage'])) {
			$listRows = $_REQUEST['numPerPage'];
		} else {
			$listRows = '10';
		}
		
		
		//设置当前页码
		if(!empty($_REQUEST['pageNum'])) {
			$nowPage=$_REQUEST['pageNum'];
		}else{
			$nowPage=1;
		}
		$_GET['p']=$nowPage;
		
		//创建分页对象
		$p = new \Think\Page($count, $listRows);
		
		
		//分页查询数据
		$field = "g.*,s.name as supplier_name";
		$join = "LEFT JOIN vmall_supplier s on g.supplier_id= s.id";
		$list = $model->alias('g')->where($map)
						->field($field)
						->join($join)
						->order($order.' '.$sort)
						->limit($p->firstRow.','.$p->listRows)
						->select();
		
						
		//回调函数，用于数据加工，如将用户id，替换成用户名称
		if (method_exists($this, '_tigger_list')) {
			$this->_tigger_list($list);
		}
		
		
		//分页跳转的时候保证查询条件
		foreach ($map as $key => $val) {
			if (!is_array($val)) {
				$p->parameter .= "$key=" . urlencode($val) . "&";
			}
		}
	
		//分页显示
		$page = $p->show();
		
		//列表排序显示
		$sortImg = $sort;                                 //排序图标
		$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';   //排序提示
		$sort = $sort == 'desc' ? 1 : 0;                  //排序方式
		

		//模板赋值显示
		$this->assign('list', $list);
		$this->assign('sort', $sort);
		$this->assign('order', $order);
		$this->assign('sortImg', $sortImg);
		$this->assign('sortType', $sortAlt);
		$this->assign("page", $page);
		
		$this->assign("search",			$search);			//搜索类型
		$this->assign("values",			$_POST['values']);	//搜索输入框内容
		$this->assign("totalCount",		$count);			//总条数
		$this->assign("numPerPage",		$p->listRows);		//每页显多少条
		$this->assign("currentPage",	$nowPage);			//当前页码
		
	}
	
	
	//添加地区价格
	public function add_region_price(){
		/***************************/
		
		/**地区信息**/
		$region = M('region');
		$where['region_id'] = array('GT',1);
		$info = $region->where($where)->select();
		$one = array();
		$two = array();
		$three = array();
		
		foreach($info as $k=>$v){
			if($v['region_type']==1){
				$one[] = $v;
			}
			
			if($v['region_type']==2){
				$two[] = $v;
			}
			
			if($v['region_type']==3){
				$three[] = $v;
			}
			
		}

		$this->assign('one',$one);
		$this->assign('two',$two);
		$this->assign('three',$three);
		/***************************/
		
		
		$this->display();
	}
	
	//地区价格修改
	public function edit_region_price(){
		/***************************/
		$goods_id =  I('get.goods_id');
		
		$region_price_model = M('region_price');
		
		$field = "rp.*,r.*";
		$join = "LEFT JOIN vmall_region r on rp.region_id = r.region_id";
		$region_price_info = $region_price_model->alias('rp')->where(array('goods_id'=>$goods_id))->join($join)->field($field)->select();
	
		
		
		
		$one = array();
		$two = array();
		$three = array();
		
		foreach($region_price_info as $k=>$v){
			if($v['region_type']==1){
				$one[] = $v;
			}
			
			if($v['region_type']==2){
				$two[] = $v;
			}
			
			if($v['region_type']==3){
				$three[] = $v;
			}
			
		}

		$this->assign('one',$one);
		$this->assign('two',$two);
		$this->assign('three',$three);
		/***************************/
		
		
		$this->display();
	}
	
	//修改地区金额
	function update_region_price(){
		$rp_id = I('post.rp_id');
		$rp_price = I('post.rp_price');
		
		$new_arr = array();
		foreach($rp_id as $k=>$v){
			foreach($rp_price as $k2=>$v2){
				if($k==$k2){
					$new_arr[$k]['rp_id'] = $v;
					$new_arr[$k]['rp_price'] = $v2;
				}
			}
		}
		
		$region_price_model = M('region_price');
		
		foreach($new_arr as $v){
			$region_price_model->where(array('rp_id'=>$v['rp_id']))->save(array('rp_price'=>$v['rp_price']));
		}
		
		$this->success(L('修改地区金额成功'));
	}
	
	
	
	//添加地区价格插入纪录
	function insert_region_price(){
		$region_id = I('post.region_id');		//地区ID数组
		$rp_price = I('post.rp_price');		//地区金额数组
		$new_arr = array();
		foreach($region_id as $k=>$v){
			foreach($rp_price as $k2=>$v2){
				if($k == $k2){
					$new_arr[$k]['region_id'] = $v;
					$new_arr[$k]['rp_price'] = $v2;
				}
			}
		}
		
		session('region_price_arr',$new_arr);
		if(!empty(session('region_price_arr'))){
			$this->success(L('添加地区金额成功'));
		}else{
			$this->error(L('添加地区金额失败'));
		}
		
		
	}
	
	
	//修改商品图片
	function edit_goods_img(){
		$this->display();
	}
	
	
	
	//php拼接html
	  public function add_html($one,$two,$three){

		  
		  $str = "<select class='combox required' name='region_id[]' id='w_combox_city' ref='w_combox_area' ><option value='0'>---地区选择---</option>";
		  foreach($one as $one_k=>$one_v){
			  $str .= "<option value='".$one_v['region_id']."'>".$one_v['region_name']."省</option>";
			  foreach( $two as $two_k=>$two_v) {
				  if($two_v['parent_id'] == $one_v['region_id']){
					  $str .= "<option value='".$two_v['region_id']."'>&nbsp;&nbsp;&nbsp;".$two_v['region_name']."市</option>";
					  foreach ($three as $three_k=>$three_v){
						  if ($three_v['parent_id'] == $two_v['region_id']){
							 $str .= "<option value='".$three_v['region_id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$three_v['region_name']."区/市</option>"; 
						  }
					  } 
				  }
			  }
		  }
		  $str .="</select>";
		  return $str;
		  
	  }
    
}