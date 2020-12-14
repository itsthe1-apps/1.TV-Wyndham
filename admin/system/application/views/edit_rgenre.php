<h1 class="page_title"><?php echo $title;?></h1>
<hr/>
<?php
$attributes = array('autocomplete'=>'off');
echo form_open($this->uri->uri_string(),$attributes);

$data_name 		= array('name'=>'name','id'=>'name','size'=> 25, 'onKeyup'=>'GenerateURL(this.value);');
$data_url 		= array('name'=>'url','id'=>'url','size'=> 25,'type'=>'hidden');
$data_language	= array('en'=>'English', 'fr'=>'French');

print form_input($data_url,$category['url']);


$table ='<div class="device_details">';
$table.='<div class="main_control_btns" class="buttons" style="margin-top:0px;" >';
$table.='<label class="group_first_label" for="name">Genre Name<span class="star"> * </span></label>';
$table.='<label class="seperator_char">:</label>';
$table.=form_input($data_name,$category['name']);
$table.="<span id='error'>".form_error('name');
$table.='</div>';
$table.='</div>';

$table.= '<div class="main_control_btns" class="buttons" style="margin-top:0px;" >';
$table.='<button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>&nbsp;';
$table.='<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Edit Genre</button></div></td>';
$table.='</div>';

$table.="<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr style='display:none;'>";
$table.="<td width='20%'><label for='LangID'>Language</label></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>".form_dropdown('LangID',$data_language,$category['language'])."</td>";
$table.="<td>&nbsp;</td>";
$table.="</tr>";

$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="'.base_url().'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Update</button></div></td>';
$table.="</tr>";

$table.="</table>";

print $table;
echo form_hidden('id',$category['id']);
echo form_close();
?>
<script type="text/javascript">
function GenerateURL(x){
	var url = 'radio/index/'+x.replace(" ","");
	document.getElementById('url').value = url + "/";	
}
</script>