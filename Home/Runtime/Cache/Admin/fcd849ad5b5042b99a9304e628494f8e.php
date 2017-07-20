<?php if (!defined('THINK_PATH')) exit();?>﻿
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/User/insert/navTabId/listuser/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>会员名称：</dt>
				<dd><input type="text" class="alphanumeric required"  style="width:100%" name="user_name"/></dd>
			</dl>
			<dl>
				<dt>姓名：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="true_name"/></dd>
			</dl>
			<dl>
				<dt>性别:</dt>
			<dd>
				<input type="radio" name="user_sex" value="0" checked="">
				&nbsp;保密&nbsp;
				<input type="radio" name="user_sex" value="1">
				&nbsp;男&nbsp;
				<input type="radio" name="user_sex" value="2">
				&nbsp;女&nbsp
			</dd>
				<!--<dd><input type="text"  style="width:100%" name="user_email" value="<?php echo ($vo["user_email"]); ?>"/></dd>-->
			</dl>
			<dl>
				<dt>邮箱地址：</dt>
				<dd><input type="text"  style="width:100%" class="required email"  name="user_email"/></dd>
			</dl>
			
			<dl>
				<dt>密码</dt>
				<dd><input id="mypass" type="password" class="required alphanumeric" minlength="6" maxlength="20"  style="width:100%" name="user_pwd"/></dd>
			</dl>
			
			<dl>
				<dt>重复密码：</dt>
				<dd><input type="password" equalto="#mypass" class="required" equalto="#xxxId"  style="width:100%" name="reuser_pwd"/></dd>
			</dl>
			
			
			<p>
			<label>密保问题：</label>
			<select class="combox required" name="secure_id" id="w_combox_city" ref="w_combox_area" >
		       
			   <option value="all">---问题选择---</option>
			   
			   
			   <?php if(is_array($secure)): $i = 0; $__LIST__ = $secure;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo["secure_id"]); ?>><?php echo ($vo["secure_question"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
          </p>		  				 		  		  
			<dl>
				<dt>密保的答案</dt>
				<dd><input type="text"  style="width:100%" name="user_answer" /></dd>
			</dl>
		
			
			
			<dl>
				<dt>客户：</dt>
				<dd>
					<select class="combox required" name="customer_id" id="w_combox_city2" ref="w_combox_area" >
						<option value="0">请选择</option>
					   <?php if(is_array($customer_info)): $i = 0; $__LIST__ = $customer_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo1["customer_id"]); ?>><?php echo ($vo1["customer_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</dd>
			</dl>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>