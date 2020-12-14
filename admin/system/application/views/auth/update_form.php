<?php

$username='';
$id='';
$ip='';

//print_r($user);
foreach($user as $row)
{
		$id			= $row['id'];
		if($user_post!=""){ $username = $user_post; }else{ $username = $row['username'];};
		if($user_passwd!=""){ $password = $user_passwd; }else{ $password = $row['password']; }
		if($user_confirm_password!=""){ $conf_pwd = $user_confirm_password; }else{ $conf_pwd = $row['password']; }
		if($user_contact!=""){ $contact	= $user_contact; }else{ $contact = $row['contact_no'];}
                if($staff_code!=""){ $staff_code	= $staff_code; }else{ $staff_code = $row['staff_code'];}
		if($user_email!=""){ $email	= $user_email; }else{ $email = $row['email'];}
		if($user_role!=""){ $role_id = $user_role; }else{ $role_id = $row['role_id'];}
}

$id = array(
	'id'	=> "user_id",
	'name'	=> "user_id",
	'value'	=> $id,
	'type'	=> 'hidden'
);

$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'class' => 'fields'
);

//Setting Paramaters
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'size'	=> 30,
	'class' => "fields",
	'value' => $username
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'maxlength' => "20",
	'class' => "fields",
	'value' => $password
);

$contact = array(
	'name'	=>	'contact_no',
	'id'	=>	'contact_no',
	'size'	=>	30,
	'class'	=>	'fields',
	'value'	=>	$contact	
);


$staff_code = array(
	'name'	=>	'staff_code',
	'id'	=>	'staff_code',
	'size'	=>	30,
	'class'	=>	'fields',
	'value'	=>	$staff_code	
);

$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'size'	=> 30,
	'maxlength' => "20",
	'class' => "fields",
	'value' => $conf_pwd
);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => "fields",
	'value'	=> $email
);

$submit	= array(
	'name'  => 'register',
	'value' => 'Save Update',
	'class'	=> 'button',
	);

$back = array(
    'name' 	=> 'button',
    'class' => 'button',
    'value' => 'true',
    'type' 	=> 'reset',
    'content' => 'Back',
	'onclick' => 'history.go(-1)'
);

$user_data = $this->dx_auth->get_user_by_id($admin_id);

$options[''] = 'Select';
foreach ($roles as $role)
{
	$options[$role->id] = $role->name;
}
/*
foreach ($roles as $role)
{
	if($user_data[0]['role_id']==1)
	{
		if($role->name=="Admin")
			$options[$role->id] = $role->name;
	}else{
		if($role->name!="Admin")
			$options[$role->id] = $role->name;
	}
}
*/


if(validation_errors()==TRUE)
{
	$style = "style='width:100%;'";
}else
{
	$style = "style='width:90%;'";
}

?>

<html>
<body>
<h1 align="left"><? print $this->lang->line('heading_update'); ?></h1>
<?php echo form_open($this->uri->uri_string())?>
<? 
$sel_group		= $role_id; 
?>
<table <?=$style?> cellpadding="5" cellspacing="10" id="login">
	<tr>
    	<td align="left" valign="top"><?php echo form_label('Username', $username['id']);?><span class="errormark">*</span>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_input($username)?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($username['name']); ?>&nbsp;</td>
    </tr>
    <tr>
    	<td align="left" valign="top"><?php echo form_label('Password', $password['id']);?><span class="errormark">*</span>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_password($password)?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($password['name']); ?>&nbsp;</td>
    </tr>
    <tr>
    	<td align="left" valign="top"><?php echo form_label('Confirm Password', $confirm_password['id']);?><span class="errormark">*</span>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_password($confirm_password);?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($confirm_password['name']); ?>&nbsp;</td>
    </tr>
    <tr>
    	<td align="left" valign="top"><?php echo form_label('Contact No', $contact['id']);?>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_input($contact)?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($contact['name']); ?>&nbsp;</td>
    </tr>
       <tr>
    	<td align="left" valign="top"><?php echo form_label('Staff Code', $staff_code['id']);?>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_input($staff_code)?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($staff_code['name']); ?>&nbsp;</td>
    </tr>
    <tr>
    	<td align="left" valign="top"><?php echo form_label('Email Address', $email['id']);?><span class="errormark">*</span>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_input($email);?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($email['name']); ?>&nbsp;</td>
    </tr>
     <tr>
    	<td align="left" valign="top"><?php echo form_label('User Group');?><span class="errormark">*</span>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_dropdown('role', $options, $sel_group,"class='fields'"); ?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error('role'); ?>&nbsp;</td>
    </tr>
     <tr>
    	<td align="left" valign="top">Enter the code<span class="errormark">*</span>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo $this->dx_auth->get_captcha_image(); ?></td>
        <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><?php echo form_input($captcha);?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($captcha['name']); ?>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="4" align="left" valign="top"><?php echo form_button($back);?>&nbsp;<?php echo form_submit($submit);?></td>
    </tr>
</table>
 <?php echo form_input($id);?>
<?php echo form_close()?>
</body>
</html>