<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/index.php/Admin/Role/update/navTabId/listrole/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="role_id" value="<?php echo ($vo["role_id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			
			<dl>
			    <dt>角色id:</dt>
				<dd><input type="text"   style="width:100%" name="role_id" value="<?php echo ($vo["role_id"]); ?>"  readonly></dd>
			</dl>
			<dl>
				<dt>角色名:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="role_name" value="<?php echo ($vo["role_name"]); ?>"/></dd>
			</dl>
			
			
			
			   
			   
	      
			<div class="divider"></div>
		 
		
			 
		    
			  <table>
				   <caption><b>操作选择：</b></caption>
				   <?php if(is_array($action_data)): $i = 0; $__LIST__ = $action_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?><tr>
				     <td>
					 <?php if(in_array(($action["action_id"]), is_array($action_id_data)?$action_id_data:explode(',',$action_id_data))): ?><label><input type="checkbox"   style="width:20%" name="action_id[]" value="<?php echo ($role["role_id"]); ?>" checked><?php echo ($action["action_name"]); ?>
					 </label>
					 <?php else: ?>
					   <label><input type="checkbox"   style="width:20%" name="action_id[]" value="<?php echo ($action["action_id"]); ?>"><?php echo ($action["action_name"]); ?>
					 </label><?php endif; ?>
					 </td>
				   </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			 </table>
         
		  
		  </div>
			
		
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>