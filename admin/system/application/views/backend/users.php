<html>
	<head><title>Manage users</title></head>
	<body>
	<?php  				
		// Show reset password message if exist
		if (isset($reset_message))
			echo $reset_message;
		
		// Show error
		echo validation_errors();
		$this->table->set_heading('&nbsp', 'Username', 'Email', 'Group', 'Banned');
		
		foreach ($users as $user) 
		{
			//print_r($user);
			$banned = ($user->banned == 1) ? 'Yes' : 'No';
			
			$this->table->add_row(
				form_checkbox('checkbox_'.$user->id, $user->id),
				anchor('auth/edit/'.$user->id,$user->username), 
				$user->email, 
				$user->role_name, 			
				$banned
				//date('Y-m-d', strtotime($user->last_login)), 
				//date('Y-m-d', strtotime($user->created)
				);
		}
		

//making attributes for submit button
$ban 		= array('name' => 'ban', 'id' => 'ban', 'value' => 'Block User', 'class' => 'button');
$unban		= array('name' => 'unban', 'id' => 'unban', 'value' => 'Allow User', 'class' => 'button');
$add		= array('name' => 'user_register', 'id' => 'user_register', 'value' => 'Add User', 'class' => 'button');
$edit		= array('name' => 'user_edit', 'id' => 'user_edit', 'value' => 'Edit User', 'class' => 'button', 'onclick' => "return getValue('edit')");
$delete		= array('name' => 'user_delete', 'id' => 'user_delete', 'value' => 'Delete User', 'class' => 'button', 'onclick' => "return getValue('delete')");


if(isset($not_found)){
	$dsp_msg = '<span class="error">'.$not_found.'</span>';
}else if(isset($msg)){
	$dsp_msg = '<span class="success_msg">'.$msg.'</span>';
}

$popup = array( 
    'width'     =>  '600', 
    'height'    =>  '350',
	'left'		=> 	'330' ,
	'top'		=>	'150'  
); 

$clicked_user  = array('name' => 'clicked_user', 'id' => 'clicked_user', 'type' => 'hidden');
$attributes = array('name' => 'myform');

$current_uri = "/".$this->uri->segment(1)."/".$this->uri->segment(2);

$order_val = array('name' => 'order_val', 'id' => 'order_val', 'type' => 'hidden');

$order_by_url = $this->session->userdata('orderby');

echo form_open($this->uri->uri_string(),$attributes);
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
    	<td align="left" valign="top"><h1><? print $this->lang->line('heading_uesers'); ?>&nbsp;&nbsp;<? if(isset($dsp_msg)){ print $dsp_msg; }?></h1>&nbsp;</td>
    	<td align="right" valign="top">
		<? 
			if($this->dx_auth->is_admin())
			{
				print form_submit($ban)."&nbsp;".form_submit($unban);
			}
			print $this->dx_auth->add_button($this->dx_auth->get_role_id(), $current_uri)==TRUE ? "&nbsp;".form_submit($add) : "";
			print $this->dx_auth->edit_button($this->dx_auth->get_role_id(), $current_uri)==TRUE ? "&nbsp;".form_submit($edit) : "";
			print $this->dx_auth->delete_button($this->dx_auth->get_role_id(), $current_uri)==TRUE ? "&nbsp;".form_submit($delete) : "";
			
		?></td>
    </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" id="table_users">
	<tr>
    	<th width="6%" align="left">&nbsp;</th>
        <th width="29%" align="left">Name&nbsp;</th>
        <th width="29%" align="left">E-mail&nbsp;</th>
        <th width="26%" align="left">Group&nbsp;</th>
        <th width="10%" align="left">Enabled&nbsp;</th>
  </tr>
	<? 
	if(count($users)>0)
	{
	foreach($users as $row){
	 //if($row->role_name!=$this->lang->line('is_admin'))
	 	//{
	?>
    <tr>
    	<td align="center"><? print form_checkbox("checkbox_".$row->id,$row->id,"","onclick='setValue(\"$row->id\")' id='validcheck[]', class='fields'");?>&nbsp;</td>
    	<!--<td><? //print anchor_popup('backend/user_view/'.$row->id, "<span style='color:#003798; text-decoration:underline'>".$row->username."</span>", $popup); ?>&nbsp;</td>-->
        <td><?=$row->username?>&nbsp;</td>
        <td><? print $row->email; ?>&nbsp;</td>
        <td align="center"><? print $row->role_name; ?>&nbsp;</td>
        <td align="center">
        	<?
				if($row->banned==0){ print "<img src='".base_url()."images/tick.png'/>";}
				if($row->banned==1){ print "<img src='".base_url()."images/publish_x.png'/>";}
			?>
        </td>
    </tr>
    <? //}
	} 
	}else{
		print "<td colspan='5'>No Data Found</td>";
	}
	?>
</table>
<?				
		echo form_input($clicked_user);
		echo form_input($order_val);
		echo form_close();
		echo $pagination;
	?>
	</body>
<script language="javascript">
function orderBy(x)
	{
		document.getElementById('order_val').value=x.value;
		document.myform.submit();
	}
function getValue(from)
{
	if(document.getElementById('validcheck[]') && (from=="edit" || from=="delete"))
	{
		count = 0;
		str = '';
		mylength = document.myform.elements["validcheck[]"].length;
		if(typeof(mylength) == "undefined"){
			//var mycheck = 1;
			if(document.getElementById('clicked_user').value==""){
				 alert("You must choose at least 1 user");
				 return false;
			}else{
				count++;
			}
		}
		for(x=0; x<document.myform.elements["validcheck[]"].length; x++){
			if(document.myform.elements["validcheck[]"][x].checked==true){
				str += document.myform.elements["validcheck[]"][x].value + ',';
				document.getElementById('clicked_user').value = document.myform.elements["validcheck[]"][x].value;
				count++;
			}
		}
		
		if(count==0){
			alert("You must choose at least 1 user");
			return false;
		}
		if(count>1 && from=="edit"){
				alert("You can choose a maximum of 1 user");
				return false;
		}
		if(count>0 && from=="delete")
		{
			 if (confirm("Are you sure you want to delete user/users?")==true){
    			return true;
 			 }else{
   				 return false;
			}
		}
		return true;
	}else{
		alert('Empty users.');
		return false;
	}

}

function setValue(x)
{
	if(document.getElementById('clicked_user').value=="")
	{
		document.getElementById('clicked_user').value=x;
	}else{
		document.getElementById('clicked_user').value="";
	}
}
</script>
</html>