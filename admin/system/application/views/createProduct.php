<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
$text_area_length = $this->config->item('max_textarea_length');
$attributes = array('name' => 'myform');
$upload_file = !empty($upload_file_error) ? $upload_file_error : "";
$upload_file_thumbnail = !empty($upload_file_error_thumbnail) ? $upload_file_error_thumbnail : "";

echo form_open_multipart('welcome/addproduct', $attributes);

$data_name = array('name' => 'name', 'id' => 'name', 'size' => 25);
$data_icon = array('name' => 'icon', 'id' => 'icon');
//$data_prNum			= array('name'=>'prLevel','id'=>'prLevel','size'=> 25);
//$data_prNam			= array('name'=>'prName','id'=>'prName','size'=> 25);
$data_path = array('name' => 'path', 'id' => 'path', 'size' => 25);
$mrl_tralier = array('name' => 'mrl_trailer', 'id' => 'mrl_trailer', 'size' => 25);
$data_duration = array('name' => 'runtime', 'id' => 'runtime', 'size' => 25);
$data_description = array('name' => 'description', 'id' => 'description', 'rows' => 5, 'cols' => '40');
$data_language = $this->config->item('languages');

/**
  echo $this->validation->error_string;
 * */
$table = "<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='25%'><label for='name'>MovieName</label><span class='star'> * </span></td>";
$table.="<td width='10%'>:</td>";
$table.="<td width='30%'>" . form_input($data_name, $name) . "</td>";
$table.="<td width='35%'><span id='error'>" . form_error('name') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='icon'>Image <font class='image_size'>(width=".$image_width.", Height=".$image_height.")</font></label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>" . form_upload($data_icon) . "</td>";
$table.="<td><span id='error'>$upload_file</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='icon'>Thumbnail <font class='image_size'>(width=".$image_width_th.", Height=".$image_height_th.")</font></label></td>";
$table.="<td>:</td>";
$table.="<td>" . form_upload('thumbnail') . "</td>";
$table.="<td><span id='error'>$upload_file_thumbnail</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='tvgenre'>Genre</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>" . form_dropdown('GndrId', $M_genre, $GndrId, 'onchange="addValue(\'genre\')"') . "</td>";
$table.="<td><span id='error'>" . form_error('GndrId') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='prName'>Parental Name</label></td>";
$table.="<td>:</td>";
//$table.="<td width='150'>".form_input($data_prNam,$prName)."</td>";
$table.="<td>" . form_dropdown('prLevel', $pRating, $prLevel, 'onchange="addValue(\'prLevel\')"') . "</td>";
$table.="<td><span id='error'>" . form_error('prLevel') . "</span></td>";
$table.="</tr>";


$table.="<tr>";
$table.="<td><label for='path'>Movie URL</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input($data_path, $path) . "</td>";
$table.="<td><span id='error'>" . form_error('path') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='path'>Trailer URL</label></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input($mrl_tralier,$mrl_t) . "</td>";
$table.="<td>&nbsp;</td>";
$table.="</tr>";


$table.="<tr>";
$table.="<td><label for='duration'>Duration</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input($data_duration, $runtime,'style="width:80px;"') . " (Minutes)</td>";
$table.="<td><span id='error'>" . form_error('runtime') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td valign='top'><label for='description'>Description</label></td>";
$table.="<td valign='top'>:</td>";
$table.="<td>" . form_textarea($data_description, $description,'maxlength="'.$text_area_length.'" onkeyup="return ismaxlength(this)"') . "<br/>(Max length $text_area_length characters)</td>";
$table.="<td><span id='error'>" . form_error('description') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='LangID'>Language</label></td>";
$table.="<td>:</td>";
$table.="<td>" . form_dropdown('LangID', $data_language, $LangID) . "</td>";
$table.="<td>&nbsp;</td>";
$table.="</tr>";

$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="' . base_url() . 'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="submit"><img src="' . base_url() . 'images/apply2.png" alt=""/>Create Movie</button></div></td>';
$table.="</tr>";


$fields = array('type' => 'hidden', 'name' => 'genreName', 'id' => 'genreName');
if ($genreName != "") {
    $val = $genreName;
} else {
    $val = "Action";
}
echo form_input($fields, $val);

$fields = array('type' => 'hidden', 'name' => 'prName', 'id' => 'prName');
if ($prName != "") {
    $val = $prName;
} else {
    $val = "Select";
}
echo form_input($fields, $val);

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