<html>
<head>
<link href="<?=base_url();?>css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body bgcolor="#e6ebf4">
<?

foreach($users as $row)
{
	$username   	= $row->username;
	$role_name  	= $row->role_name;
	$contact_no 	= $row->contact_no;
	$email			= $row->email;
}
//$exp_company = explode(",",$company);
?>
<h1><? print $this->lang->line('user_details'); ?></h1>
<table width="97%" border="0" cellpadding="0" cellspacing="0" id="table_sub_view" style="margin-left:7px; margin-top:15px;">
  <tr>
    <td width="25%">Username&nbsp;</td>
    <td width="7%">:&nbsp;</td>
    <td width="68%"><?=$username?>&nbsp;</td>
  </tr>
  <tr>
    <td>User Role&nbsp;</td>
    <td>:&nbsp;</td>
    <td><?=!empty($role_name) ? $role_name : '-';?>&nbsp;</td>
  </tr>
  <tr>
    <td>Contact No&nbsp;</td>
    <td>:&nbsp;</td>
    <td><?=!empty($contact_no) ? $contact_no : '-'; ?>&nbsp;</td>
  </tr>
  <tr>
    <td>Email&nbsp;</td>
    <td>:&nbsp;</td>
    <td><?=!empty($email) ? $email : '-';?>&nbsp;</td>
  </tr>

</table>
<br/><p><a href="#" onClick="window.close()" style="color:#000000; text-decoration:underline;">Close Window</a></p>
</body>
</html>