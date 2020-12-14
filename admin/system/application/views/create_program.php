<h1><?php echo $title;?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
//echo $this->validation->error_string;

//print "<span style='color:#FF0000'>".validation_errors()."</span>";
$attributes = array('name' => 'myform');
echo form_open_multipart('welcome/addprogram',$attributes);

$data_name			= array('name'=>'proname','id'=>'proname','size'=> 25);
$data_Stime			= array('name'=>'Stime','id'=>'Stime','size'=> 25);
$data_Etime			= array('name'=>'Etime','id'=>'Etime','size'=> 25);
//$data_genreName		= array('name'=>'genreName','id'=>'genreName','size'=> 25);
$data_description 	= array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40');
//$data_prName		= array('name'=> 'prName','id'=> 'prName');
//$data_prLevel		= array('name'=> 'prLevel','id'=> 'prLevel');
$data_language		= $this->config->item('languages');


$table="<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='130'><label for='proname'>Program Name</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_input($data_name,$proname)."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('proname')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='StartTime'>Start time</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_input($data_Stime,$Stime)."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('Stime')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='EndTime'>End time</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_input($data_Etime,$Etime)."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('Etime')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='genre'>Genre</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_dropdown('GndrId',$genre, $GndrId, 'onchange="addValue(\'genre\')"')."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('GndrId')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130' valign='top'><label for='description'>Description</label><span class='star'>*</span></td>";
$table.="<td width='30' valign='top'>:</td>";
$table.="<td width='150'>".form_textarea($data_description,$description)."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('description')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='prName'>Parental Name</label></td>";
$table.="<td width='30'>:</td>";
//$table.="<td width='150'>".form_input($data_prNam,$prName)."</td>";
$table.="<td width='150'>".form_dropdown('prLevel', $pRating, $prLevel, 'onchange="addValue(\'prLevel\')"')."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('prLevel')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='LangID'>Language</label></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_dropdown('LangID',$data_language,$LangID)."</td>";
//$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('language')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td colspan='3'>".form_submit('submit','Creat Program')."</td>";
$table.="</tr>";


$fields = array('type'=>'hidden', 'name'=>'genreName', 'id'=>'genreName');
if($genreName!=""){ $val=$genreName; }else{ $val="Action"; }
echo form_input($fields,$val);

$fields = array('type'=>'hidden', 'name'=>'prName', 'id'=>'prName');
if($prName!=""){ $val=$prName; }else{ $val="Select"; }
echo form_input($fields,$val);

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