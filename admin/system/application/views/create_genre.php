<h1 class="page_title"><?php echo $title;?></h1>
<hr/>

<?php
$attributes = array('autocomplete'=>'off','class'=>'form-inline form_elements_list');
echo form_open('welcome/addgenre',$attributes);

$data_name 		= array('name'=>'name',"class"=>"form-control",'id'=>'name','size'=> 25, 'onKeyup'=>'GenerateURL(this.value);');
$data_url 		= array('name'=>'url','id'=>'url','size'=> 25,'type'=>'hidden');
$data_language	= array('en'=>'English', 'fr'=>'French');

print form_input($data_url);

$table ='<div class="device_details">';
$table.='<div class="main_control_btns" class="buttons" style="margin-top:0px;" >';
$table.='<label class="group_first_label" for="name">Genre Name<span class="star"> * </span></label>';
$table.='<label class="seperator_char">:</label>';
$table.=form_input($data_name,$name);
$table.="<span id='error'>".form_error('name');
$table.='</div>';
$table.='</div>';

$table.= '<div class="main_control_btns" class="buttons" style="margin-top:0px;" >';
$table.='<button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>&nbsp;';
$table.='<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create Genre</button></div></td>';
$table.='</div>';


$table.='<table>';
$table.="<tr style='display:none;'>";
$table.="<td width='20%'><label for='LangID'>Language</label></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>".form_dropdown('LangID',$data_language,$LangID)."</td>";
$table.="<td>&nbsp;</td>";
$table.="</tr>";

$table.="<tr>";

$table.="</tr>";

$table.="</table>";

print $table;
echo form_close();
?>
<script type="text/javascript">
function GenerateURL(x){
	var url = 'welcome/Tv/'+x.replace(" ","");
	document.getElementById('url').value = url + "/";	
}
</script>