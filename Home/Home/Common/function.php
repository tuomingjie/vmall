<?php


function test(){
	echo 111;die;
}

//获取多个商品的最终价格
function final_price_list($goods_info){
		if(empty($goods_info) || !is_array($goods_info)){
			return false;
		}
		
		
		$user_id = session(C("USER_ID"));
		if(empty($user_id)){	//判断是否登录
			foreach($goods_info as $k=>$v){
				$goods_info[$k]['final_price'] = $v['goods_sale_price'];	//最终价格
			}
			return $goods_info;
		}else{
			$user = M('user');
			$where['user_id'] = $user_id;
			$user_info = $user->where($where)->find();
			if($user_info['customer_id']== 0 ){ //判断是否是普通会员
				foreach($goods_info as $k=>$v){
					$goods_info[$k]['final_price'] = $v['goods_sale_price'];	//最终价格
				}
				return $goods_info;
			}else{
				$customer_id = $user_info['customer_id'];
				$customer = M('customer');
				$where = array();
				$where['customer_id'] = $customer_id;
				$customer_info = $customer->where($where)->find();	//客户信息
				if(empty($customer_info)){	//判断客户是否存在  如果不存在，取基准价
					foreach($goods_info as $k=>$v){
						$goods_info[$k]['final_price'] = $v['base_price'];	//最终价格
					}
					return $goods_info;
				}else{
					if($customer_info['region_id'] == 0 ){	//判断客户地区ID 是否为0  为0 取基准价
						foreach($goods_info as $k=>$v){
							$goods_info[$k]['final_price'] = $v['base_price'];	//最终价格
						}
						return $goods_info;
					}else{	//客户地区ID如果不为0 查找 地区价格表
					
						$region_price = M('region_price');
						$region = M('region');
						
						foreach($goods_info as $k=>$v){
							$goods_id = $v['goods_id'];
							$region_id = $customer_info['region_id'];
							$where = array();
							$where['goods_id'] = $goods_id;
							$where['region_id'] = $region_id;
							$region_price_info = $region_price->where($where)->find();	//地区价格信息
							if(empty($region_price_info)){	//地区价格信息是否存在  如果不存在查找地区上一级
								$where = array();
								$where['region_id'] = $region_id;
								$region_info = $region->where($where)->find();	//获取地区信息
								if(empty($region_info)){	//如果地区信息不存在 取基准价
								
									$goods_info[$k]['final_price'] = $v['base_price'];
									
								}else{	//如果存在 获取父级的ID再去查询地区价格表
									
								/*************************/	
									
									$rp_id = parent_price($goods_id,$region_info);
									
									if($rp_id == 0 ){	//该地区和上级地区没有设置金额  去基准价
									
										$goods_info[$k]['final_price'] = $v['base_price'];
										
									}else{	//根据地区金额ID 获取地区金额
										
										$where = array();
										$where['rp_id'] = $rp_id;
										$region_price_info = $region_price->where($where)->find();	//获取地区金额信息
										$goods_info[$k]['final_price'] = $region_price_info['rp_price'];
									}
									
								/*************************/		
									
								}
								
							}else{	//如果存在  最终价格 取地区价
							
								$goods_info[$k]['final_price'] = $region_price_info['rp_price'];	//最终价格
							}
							
						}
						
						return $goods_info;
						
						
					}
				}
				
			}
			
			
		}
}


//获取单个商品的最终价格
function final_price_one($goods_info){
		if(empty($goods_info) || !is_array($goods_info)){
			return false;
		}
		
		
		$user_id = session(C("USER_ID"));
		if(empty($user_id)){	//判断是否登录
			$goods_info['final_price'] = $goods_info['goods_sale_price'];	//最终价格
			return $goods_info;
		}else{
			$user = M('user');
			$where['user_id'] = $user_id;
			$user_info = $user->where($where)->find();
			if($user_info['customer_id']== 0 ){ //判断是否是普通会员
				$goods_info['final_price'] = $goods_info['goods_sale_price'];	//最终价格
				return $goods_info;
			}else{
				$customer_id = $user_info['customer_id'];
				$customer = M('customer');
				$where = array();
				$where['customer_id'] = $customer_id;
				$customer_info = $customer->where($where)->find();	//客户信息
				if(empty($customer_info)){	//判断客户是否存在  如果不存在，取基准价
					$goods_info['final_price'] = $goods_info['base_price'];	//最终价格
					return $goods_info;
				}else{
					if($customer_info['region_id'] == 0 ){	//判断客户地区ID 是否为0  为0 取基准价
						$goods_info['final_price'] = $goods_info['base_price'];	//最终价格
						return $goods_info;
					}else{	//客户地区ID如果不为0 查找 地区价格表
					
						$region_price = M('region_price');
						$region = M('region');
						
						
						$goods_id = $goods_info['goods_id'];
						$region_id = $customer_info['region_id'];
						$where = array();
						$where['goods_id'] = $goods_id;
						$where['region_id'] = $region_id;
						$region_price_info = $region_price->where($where)->find();	//地区价格信息
						if(empty($region_price_info)){	//地区价格信息是否存在  如果不存在查找地区上一级
							$where = array();
							$where['region_id'] = $region_id;
							$region_info = $region->where($where)->find();	//获取地区信息
							if(empty($region_info)){	//如果地区信息不存在 取基准价
							
								$goods_info['final_price'] = $goods_info['base_price'];
								
							}else{	//如果存在 获取父级的ID再去查询地区价格表
								
							/*************************/	
								
								$rp_id = parent_price($goods_id,$region_info);
								
								if($rp_id == 0 ){	//该地区和上级地区没有设置金额  取基准价
								
									$goods_info['final_price'] = $goods_info['base_price'];
									
								}else{	//根据地区金额ID 获取地区金额
									
									$where = array();
									$where['rp_id'] = $rp_id;
									$region_price_info = $region_price->where($where)->find();	//获取地区金额信息
									$goods_info['final_price'] = $region_price_info['rp_price'];
								}
								
							/*************************/		
								
							}
							
						}else{	//如果存在  最终价格 取地区价
						
							$goods_info['final_price'] = $region_price_info['rp_price'];	//最终价格
						}
					
						return $goods_info;
						
						
					}
				}
				
			}
			
			
		}
}


//递归查询父级区域价格
function parent_price($goods_id,$region_info){
	
	$region_price = M('region_price');
	$region = M('region');
	
	if($region_info['region_type'] > 0){
		$region_id = $region_info['parent_id'];	//获取父级ID
		$where['region_id'] = $region_id;
		$where['goods_id'] = $goods_id;
		$region_price_info = $region_price->where($where)->find();	//获取信息
		if(empty($region_price_info)){
			$where = array();
			$where['region_id'] = $region_id;
			$region_info = $region->where($where)->find();	//获取地区信息
			parent_price($goods_id,$region_info);
		}else{
			return $region_price_info['rp_id'];
		}
	}else{
		return 0;
	}
}



//创建TOKEN
function creatToken() {
    $code = chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE));
    session('TOKEN', authcode($code));
}

//判断TOKEN
function checkToken($token) {
    if ($token == session('TOKEN')) {
        session('TOKEN', NULL);
        return TRUE;
    } else {
        return FALSE;
    }
}

/* 加密TOKEN */
function authcode($str) {
    $key = "ANDIAMON";
    $str = substr(md5($str), 8, 10);
    return md5($key . $str);
}







