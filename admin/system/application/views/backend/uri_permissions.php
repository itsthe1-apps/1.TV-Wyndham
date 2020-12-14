<?
// Build drop down menu
		foreach ($roles as $role)
		{
			$options[$role->id] = $role->name;
		}

		$listing_uris = array();
		
		// Change allowed uri to string to be inserted in text area
		if ( ! empty($allowed_uris) && !$this->input->post('pass_value'))
		{
			$listing_uris = $allowed_uris;
			$allowed_uris = implode("\n", $allowed_uris);
		}
		
		$get_value = array();
		
		if($this->input->post('pass_value'))
		{
			if(isset($_POST['check']) && count($_POST['check'])>0)
			{
				$get_value = $_POST['check'];
				array_walk($get_value, 'trim_value');
				
				$allowed_uris = implode("\n", $get_value);
			}
			
			$is_submit = "go";
			
		
		}
		
$permissions 		= array('name' => 'show', 'id' => 'show', 'value' => 'Show Permissions', 'class' => 'button');
$textarea 			= array("name" => "allowed_uris", "id" => "allowed_uris", "rows" => "10", "cols" => "55", "class" => "fields");
$pass_value			= array("name" => "pass_value", "value" => "Set Permissions", "class" => "button");
//$save_permissions	= array("name" => "save", "value" => "Save Permissions", "class" => "button");

$auto_submit		= array("name" => "is_submit", "id" => "is_submit", "value" => isset($is_submit) ? $is_submit : "", "type" => "hidden");
?>

<h1 align="left"><? print $heading; ?></h1>
<? 
$attributes = array('name' => 'myform', 'id' => 'myform');
echo form_open($this->uri->uri_string(),$attributes); ?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
      <td width="7%"><? print form_label('Groups', 'role_name_label');?>&nbsp;</td>
      <td width="6%">:&nbsp;</td>
      <td width="10%"><? echo form_dropdown('role', $options);?>&nbsp;</td>
      <td width="77%" align="left" valign="top"><? echo form_submit($permissions); ?>&nbsp;</td>
  </tr>
    <tr>
    	<td colspan="4" style="padding-top:12px">
        	<table cellpadding="3" cellspacing="3" width="100%">
            	<tr>
                	<td valign="top" colspan="2" align="left" width="64%">
               	  <table width="40%" cellpadding="0" cellspacing="0" id="table_users">
                        	<tr>
                              <th width="41%" align="center" style="border-bottom: 1px solid #C0C0C0">Module Name&nbsp;</th>
                              <th width="11%" align="center" style="border-bottom: 1px solid #C0C0C0">ADD&nbsp;</th>
                              <th width="21%" align="center" style="border-bottom: 1px solid #C0C0C0">EDIT&nbsp;</th>
                              <th width="27%" align="center" style="border-bottom: 1px solid #C0C0C0">DELETE&nbsp;</th>
                              
                    </tr>
                          
                            <?
								foreach($tabs as $row){
							?>

                            <tr>
                            	<td style="border-bottom: 1px solid #C0C0C0"><? if($row->url!="/welcome/ticketstatus"){
								print form_checkbox("check[]",$row->url."/", in_array($row->url."/", $get_value) ? TRUE : FALSE || in_array($row->url."/", $listing_uris) ? TRUE : FALSE)."&nbsp;".$row->name; }?>&nbsp;</td>                                
                                <td align="center" style="border-bottom: 1px solid #C0C0C0"><? print !empty($row->add) ? form_checkbox("check[]",$row->add."/", in_array($row->add."/", $get_value) ? TRUE : FALSE || in_array($row->add."/", $listing_uris) ? TRUE : FALSE) : "-"; ?>&nbsp;</td>
                                <td align="center" style="border-bottom: 1px solid #C0C0C0"><? print !empty($row->edit) ? form_checkbox("check[]",$row->edit."/", in_array($row->edit."/", $get_value) ? TRUE : FALSE || in_array($row->edit."/", $listing_uris) ? TRUE : FALSE) : "-"; ?>&nbsp;</td>
                                <td align="center" style="border-bottom: 1px solid #C0C0C0"><? print !empty($row->delete) ? form_checkbox("check[]",$row->delete."/", in_array($row->delete."/", $get_value) ? TRUE : FALSE || in_array($row->delete."/", $listing_uris) ? TRUE : FALSE) : "-"; ?>&nbsp;</td>
                               
                            </tr>
                            <tr>
                            <? } ?>
                            </tr>
                        </table>
                    </td>
              </tr>
            </table>
        </td>
    </tr>
</table>
<div style="position: absolute; top:0; left:0; display:none;"><? echo form_textarea($textarea, $allowed_uris); ?></div>
<?
echo "<span style=float:left>".form_submit($pass_value)."</span>&nbsp;";
?>
<span style="color:#990000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:0.9em;">[Note :- <font color="#FF0000">You must select particular module before to give add, edit, delete permissions.</font>]</span>
<?
//echo form_submit($save_permissions);
print form_input($auto_submit);
?>
<? echo form_close(); ?>
<? if($this->input->post('pass_value')){
?>
<script type="text/javascript">
	document.myform.submit();
</script>
<?
}
?>