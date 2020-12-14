<?php
$login = array(
	'name'	=> 'login',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value' => set_value('login'),
	'class' => "fields"
);

$reset	= array(
	'name'  => 'reset',
	'value' => 'Reset Now',
	'class'	=> 'button',
	);

if(form_error($login['name'])!="")
{
	$style = "style='width:79%; margin-left:180px;'";
}else
{
	$style = "style='width:60%'";
}

?>
<h1><? print $this->lang->line('heading_forgotpsd'); ?></h1>
<?php echo form_open($this->uri->uri_string()); ?>
<?php echo $this->dx_auth->get_auth_error(); ?>
<table <?=$style?> cellpadding="5" cellspacing="10" id="login">
	<tr>
    	<td><?php echo form_label('Username or Email Address', $login['name']);?>&nbsp;</td>
        <td>&nbsp;:</td>
        <td><?php echo form_input($login); ?>&nbsp;</td>
        <td><?php echo form_error($login['name']); ?>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="4"><?php echo form_submit($reset);?>&nbsp;</td>
    </tr>
</table>
<?php echo form_close()?>