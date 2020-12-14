<?
$id	  = array('name' => 'getId', 'id' => 'getId', 'value' => !empty($role_id) ? $role_id : $this->input->post('getId'), 'type' => 'hidden');
$group = array('name' => 'role_name','id' => 'name', 'size' => 30, 'class' => 'fields', 'value' => !empty($name) ? $name : $this->input->post('role_name'));
$role_parent = array('name' > 'role_parent', 'type' => 'hidden');

if(isset($role_id))
	$submit = array(
			'name'	=> 'edit',
			'value'	=> 'Save Update',
			'class'	=> 'button'
	);
else
	$submit = array(
			'name'	=> 'add',
			'value'	=> 'Add Group',
			'class'	=> 'button'
	);

$back = array(
    'name' 	=> 'button',
    'class' => 'button',
    'value' => 'true',
    'type' 	=> 'reset',
    'content' => 'Back',
	'onclick' => 'history.go(-1)'
);

if(validation_errors()==TRUE)
{
	$style = "style='width:100%;'";
}else
{
	$style = "style='width:90%;'";
}
?>

<body onLoad="document.getElementById('role_name').focus()">
<h1 align="left"><? print $heading; ?></h1>
<?
$attributes = array('name' => 'addgroups', 'onsubmit' => 'return validateForm(this)');
echo form_open($this->uri->uri_string(),$attributes);
?>
<table <?=$style?> cellpadding="5" cellspacing="10" id="login">
	<tr>
    	<td align="left" valign="top"><?php echo form_label('Group Name', $group['id']);?><span class="errormark">*</span>&nbsp;</td>
        <td align="left" valign="top">&nbsp;:</td>
        <td align="left" valign="top"><?php echo form_input($group)?>&nbsp;</td>
        <td align="left" valign="top"><?php echo form_error($group['name']); ?>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" align="left" valign="top"><?php echo form_button($back);?></td>
        <td colspan="2" align="left" valign="top"><?php echo form_submit($submit);?></td>
    </tr>
</table>
<?
print form_input($id);
print form_input($role_parent);
echo form_close();
?>
<script language="javascript">
String.prototype.trim = function() {
  return this.replace(/^\s*(\b.*\b|)\s*$/, "$1");
}
function validateForm(frm)
{
	if(frm.name.value.trim()=="")
	{
		alert('Enter a valid group name.');
		frm.name.focus();
		return false;
	}
	return true;
}
</script>