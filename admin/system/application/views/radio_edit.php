<h1><?php echo $title;?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
$text_area_length = $this->config->item('max_textarea_length');
//print uri_string();
$upload_file = !empty($upload_file_error) ? $upload_file_error : "";
$attributes = array('name' => 'myform','autocomplete'=>'off');
echo form_open_multipart(uri_string(),$attributes);

$data_chName		= array('name'=>'name','id'=>'name','size'=> 25);
$data_chNum			= array('name'=>'ChNum','id'=>'ChNum','size'=> 25);
//$data_prNum			= array('name'=>'prLevel','id'=>'prLevel','size'=> 25);
//$data_prNam 		= array('name'=>'prName','id'=>'prName','size'=> 25);
//$data_eitxml		= array('name'=>'eitxml','id'=>'eitxml','size'=>25);
//$data_epgxml		= array('name'=>'epgxml','id'=>'epgxml','size'=>25);
$data_path			= array('name'=>'path','id'=>'path','size'=> 25);
$data_icon			= array('name'=> 'icon','id'=> 'icon');
//$data_description 	= array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40');
$data_language		= $this->config->item('languages');

//print_r($category);

if($category['logo']!="")
		{
		$icon_split=explode("\\",$category['logo']);
		}

$file = basename($category['logo']);
print form_input(array('name'=>'file_img_name','type'=>'hidden', 'value'=>$file));

$table="<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='25%'><label for='name'>Channel Name</label><span class='star'> * </span></td>";
$table.="<td width='10%'>:</td>";
$table.="<td width='30%'>".form_input($data_chName,$category['name'])."</td>";
$table.="<td width='35%'><span id='error'>".form_error('name')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='ChannelNum'>Channel Number</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>".form_input($data_chNum,$category['number'])."</td>";
$table.="<td><span id='error'>".form_error('ChNum')."</span></td>";
$table.="</tr>";

/**
$table.="<tr>";
$table.="<td width='130'><label for='tvgenre'>Genre</label></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='250'><span id='error'>".form_dropdown('GndrId', $genre, $category['genreId'], 'onchange="addValue(\'genre\')"', 'id="GndrId"')."</span></td>";
$table.="<td>&nbsp;</td>";
$table.="</tr>";
**/
$get_genres = $get_genre_lists->result();
$selected_gen_values = array();
if($get_genres){
	foreach($get_genres as $row){
		$selected_gen_values[] = $row->TVGenreID;
	}
}
$table.="<tr>";
$table.="<td><label for='tvgenre'>Genre</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>".form_multiselect('GndrId[]',$genre, $selected_gen_values)."</td>";
$table.="<td><span id='error'>".form_error('GndrId[]')."</span></td>";
$table.="</tr>";

$table.="<tr style='display:none;'>";
$table.="<td><label for='prName'>Parental Name</label></td>";
$table.="<td>:</td>";
//$table.="<td width='150'>".form_input($data_prNam,$prName)."</td>";
$table.="<td>".form_dropdown('prLevel', $pRating, $category['prLevel'], 'onchange="addValue(\'prLevel\')"')."</td>";
$table.="<td><span id='error'>".form_error('prLevel')."</span></td>";
$table.="</tr>";


//$table.="<tr>";
//$table.="<td><label for='eitxml'>Eit XML</label></td>";
//$table.="<td>:</td>";
//$table.="<td>".form_input($data_eitxml,$category['eitXML'])."\nhttp(s):// Required</td>";
//$table.="<td><span id='error'>".form_error('eitxml')."</span></td>";
//$table.="</tr>";
//
//$table.="<tr>";
//$table.="<td><label for='epgxml'>Epg XML</label></td>";
//$table.="<td>:</td>";
//$table.="<td>".form_input($data_epgxml,$category['epgXML'])."\nhttp(s):// Required</td>";
//$table.="<td><span id='error'>".form_error('epgxml')."</span></td>";
//$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='path'>Path</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>".form_input($data_path,$category['mrl'])."</td>";
$table.="<td><span id='error'>".form_error('path')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='icon'>Icon <font class='image_size'>(width=".$image_width.", Height=".$image_height.")</font></label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>".form_upload($data_icon)."&nbsp;&nbsp;<img  width='50' src='".base_url()."icons/RADIO/".$file."' align='right'></td>";
$table.="<td><span id='error'>$upload_file</span></td>";
$table.="</tr>";

//$table.="<tr>";
//$table.="<td valign='top'><label for='description'>Description</label></td>";
//$table.="<td valign='top'>:</td>";
//$table.="<td>".form_textarea($data_description,$category['description'],'maxlength="'.$text_area_length.'" onkeyup="return ismaxlength(this)"')."<br/>(Max length $text_area_length characters)</td>";
//$table.="<td><span id='error'>".form_error('description')."</span></td>";
//$table.="</tr>";

$table.="<tr style='display:none;'>";
$table.="<td><label for='LangID'>Language</label></td>";
$table.="<td>:</td>";
$table.="<td>".form_dropdown('LangID', $data_language,$category['language'])."</td>";
$table.="<td><span id='error'>".form_error('language')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="'.base_url().'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Update Radio</button></div></td>';
$table.="</tr>";

$fields = array('type'=>'hidden', 'name'=>'genreName', 'id'=>'genreName');
if(isset($category['genreName'])){ $val=$category['genreName']; }else{ $val="Select"; }
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