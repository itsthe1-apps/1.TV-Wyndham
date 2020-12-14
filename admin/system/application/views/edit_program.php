<h1><?php echo $title;?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
//print uri_string();
$attributes = array('name' => 'myform');
echo form_open_multipart(uri_string(),$attributes);

$data_name			= array('name'=>'proname','id'=>'proname','size'=> 25);
$data_Stime			= array('name'=>'Stime','id'=>'Stime','size'=> 25);
$data_Etime			= array('name'=>'Etime','id'=>'Etime','size'=> 25);
//$data_genreName		= array('name'=>'genreName','id'=>'genreName','size'=> 25);
$data_description 	= array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40');
//$data_prName		= array('name'=> 'prName','id'=> 'prName');
//$data_prLevel		= array('name'=> 'prLevel','id'=> 'prLevel');
$data_language		= $this->config->item('languages');
//print_r($category);

$table="<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='130'><label for='name'>Channel Name</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='250'>".form_input($data_name,$category['name'])."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('name')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='ChannelNum'>Channel Number</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='250'>".form_input($data_Stime,$category['startTime'])."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('Stime')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='EndTime'>End time</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_input($data_Etime,$category['endTime'])."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('Etime')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='tvgenre'>Genre</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='250'>".form_dropdown('GndrId', $genre, $category['genreId'], 'onchange="addValue(\'genre\')"', 'id="GndrId"')."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('GndrId')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130' valign='top'><label for='description'>Description</label><span class='star'>*</span></td>";
$table.="<td width='30' valign='top'>:</td>";
$table.="<td width='150'>".form_textarea($data_description,$category['description'])."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('description')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='prName'>Parental Name</label></td>";
$table.="<td width='30'>:</td>";
//$table.="<td width='150'>".form_input($data_prNam,$prName)."</td>";
$table.="<td width='150'>".form_dropdown('prLevel', $pRating, $category['prLevel'], 'onchange="addValue(\'prLevel\')"')."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('prLevel')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='LangID'>Language</label></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='250'>".form_dropdown('LangID', $data_language,$category['language'])."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('language')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td colspan='3'>".form_submit('submit','Update Program')."</td>";
$table.="</tr>";

$fields = array('type'=>'hidden', 'name'=>'genreName', 'id'=>'genreName');
if(isset($category['genreName'])){ $val=$category['genreName']; }else{ $val="Action"; }
echo form_input($fields,$val);

$fields = array('type'=>'hidden', 'name'=>'prName', 'id'=>'prName');
if(isset($category['prName'])){ $val=$category['prName']; }else{ $val="Select"; }
echo form_input($fields,$val);

echo form_hidden('Id',$category['id']);

$table.="</table>";

print $table;

echo form_close();
?>
<script language="javascript">
function addValue(x)
{
	if(x=="genre")
	{
		var e = document.myform.GndrId; 
		var strUser = e.options[e.selectedIndex].text;
		document.getElementById('genreName').value=strUser;
	}
	else if(x=="prLevel")
	{
		var e = document.myform.prLevel; 
		var strUser = e.options[e.selectedIndex].text;
		document.getElementById('prName').value=strUser;
	}
}
</script>