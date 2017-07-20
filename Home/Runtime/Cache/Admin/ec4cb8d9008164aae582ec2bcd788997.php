<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/User/update/navTabId/listuser/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="user_id" value="<?php echo ($vo["user_id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			<!-- <dl>
				<dt>ID:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="user_id" value="<?php echo ($vo["user_id"]); ?>"/></dd>
			</dl> -->
			
			<dl>
				<dt>会员名称:</dt>
				<dd><input type="text" class="alphanumeric" style="width:100%" name="user_name" value="<?php echo ($vo["user_name"]); ?>"/></dd>
			</dl>
				<dl>
				<dt>姓名:</dt>
				<dd><input type="text"  style="width:100%" name="true_name" value="<?php echo ($vo["true_name"]); ?>"/></dd>
			</dl>
			
			<dl>
				<dt>邮箱地址:</dt>
				<dd><input type="text"  style="width:100%" name="user_email" value="<?php echo ($vo["user_email"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>密码</dt>
				<dd><input id="mypass" type="password"  style="width:100%" name="user_pwd" value="" /></dd>
			</dl>
			
							
			<dl>
				<dt>性别:</dt>
			<dd>
			<input type="radio" name="user_sex" value="0" <?php echo $vo['user_sex']==0?'checked':'';?> />
            &nbsp;保密&nbsp;
            <input type="radio" name="user_sex" value="1" <?php echo $vo['user_sex']==1?'checked':'';?>>
            &nbsp;男&nbsp;
            <input type="radio" name="user_sex" value="2" <?php echo $vo['user_sex']==2?'checked':'';?>>
            &nbsp;女&nbsp;</dd>
				<!--<dd><input type="text"  style="width:100%" name="user_email" value="<?php echo ($vo["user_email"]); ?>"/></dd>-->
			</dl>
			<p>
			<label>密保问题：</label>
		   <select class="combox required" name="secure_id" id="w_combox_city" ref="w_combox_area" >
		       
			  
			      
			   <?php if(is_array($secure)): $i = 0; $__LIST__ = $secure;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo1["secure_id"]); ?>  <?php echo $vo['secure_id']==$vo['secure_id']?'selected':'';?>><?php echo ($vo1["secure_question"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			   
	      </select>
          </p>
			<dl>
				<dt>密保的答案</dt>
				<dd><input type="text"  style="width:100%" name="user_answer" value=""/></dd>
			</dl>		
			<!--
			<dl>
				<dt>权限:</dt>
					<dd>													
						<input type="radio" name="user_lock" value="1" <?php ?>> &nbsp;设置权限&nbsp;
						<input type="radio" name="user_lock" value="0" <?php ?>>&nbsp;不设置权限&nbsp	
					</dd>
			</dl>
			-->
			
			<dl>
				<dt>用户ID:</dt>
				<dd><input type="text"  style="width:100%" name="customer_id" value="<?php echo ($vo["customer_id"]); ?>"/></dd>
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