
<script type="text/javascript">
function get_value(x){
	if(x=="image"){
		document.getElementById('image_pro').disabled = false;
		document.getElementById('pr_url').disabled = true;
		//document.getElementById('pr_duration').disabled = true;
	}else if(x=="video"){
		document.getElementById('image_pro').disabled = true;
		document.getElementById('pr_url').disabled = false;
		//document.getElementById('pr_duration').disabled = false;
	}else{
		document.getElementById('image_pro').disabled = true;
		document.getElementById('pr_url').disabled = true;
		//document.getElementById('pr_duration').disabled = true;
	}
}

function onload_hide(){
	<? if((isset($promotions) && $promotions['pr_type']=="image") || (isset($_POST['pr_type']) && $_POST['pr_type']=="image")){
		if(isset($_POST['pr_type']) && ($_POST['pr_type']=="" || $_POST['pr_type']=="video")){?>
				document.getElementById('image_pro').disabled = true;
	<? }else{ ?>
				document.getElementById('image_pro').disabled = false;
		<? } ?>
	<? }else{ ?>
		document.getElementById('image_pro').disabled = true;
	<? } ?>
	
	<? if((isset($promotions) && $promotions['pr_type']=="video") || (isset($_POST['pr_type']) && $_POST['pr_type']=="video")){
		if(isset($_POST['pr_type']) && ($_POST['pr_type']=="" || $_POST['pr_type']=="image")){?>
			document.getElementById('pr_url').disabled = true;
			//document.getElementById('pr_duration').disabled = true;
		<? } else { ?>
			document.getElementById('pr_url').disabled = false;
			//document.getElementById('pr_duration').disabled = false;
		<? } ?>
	<? }else{ ?>
		document.getElementById('pr_url').disabled = true;
		//document.getElementById('pr_duration').disabled = true;
	<? } ?>	
}
window.onload = onload_hide;
</script>
<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
$attributes = array('name' => 'myform','autocomplete'=>'off');

$upload_file = !empty($upload_file_error) ? $upload_file_error : "";


print form_open_multipart($this->uri->uri_string(), $attributes);

$data_name = array('name' => 'name', 'id' => 'name', 'size' => 25, 'value'=>isset($restaurant['name']) ? $restaurant['name'] : $this->input->post('name'));
$data_icon = array('name' => 'image_pro', 'id' => 'image_pro','value'=>$this->input->post('icon'));

$data_menu_icon = array('name' => 'icon2', 'id' => 'icon2','value'=>$this->input->post('icon2'));

$data_description = array('name' => 'description', 'id' => 'description', 'rows' => 5, 'cols' => '40', 'value' => isset($restaurant['description']) ? $restaurant['description'] : $this->input->post('description'));

if(isset($promotions) && $promotions['pr_type']=="image"){
	$file	= $promotions['pr_url'];
	print form_input(array('name'=>'file_img_name1','type'=>'hidden', 'value'=>$file));
}
/**
  echo $this->validation->error_string;
 * */

$type_dropdown['']	= 'Select';
$type_dropdown['image']	= 'Image';
$type_dropdown['video']	= 'Video';

// Setup promotion
$data_array = array();

if(isset($promotions['pr_id'])){
	$language_data = $this->Promotions_model->get_promotion_language($promotions['pr_id']);
	if($language_data->num_rows()>0){
		foreach($language_data->result() as $row){
			$data_array[$row->language] = $row->language;
		}
	}
}else{
	$data_array = array($this->session->userdata($session_keyword) => $this->session->userdata($session_keyword));
}

$table = "<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='25%'><label for='name'>Language</label><span class='star'> * </span></td>";
$table.="<td width='10%'>:</td>";
$table.="<td width='30%'>".$this->TVclass->language_dp('language[]',$data_array,'id="language" multiple="multiple" style="height:50px;"')."</td>";
$table.="<td width='35%'></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td valign='top' align='left'><label for='name'>Type</label><span class='star'> * </span></td>";
$table.="<td valign='top' align='left'>:</td>";
$table.="<td valign='top' align='left'>" . form_dropdown('pr_type',$type_dropdown,isset($promotions) && !isset($_POST['pr_type']) ? $promotions['pr_type'] : $this->input->post('pr_type'),'onchange="get_value(this.value)"') . "</td>";
$table.="<td><span id='error' valign='top' align='left'>" . form_error('pr_type') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td valign='top' align='left'><label for='icon'>Image <font class='image_size'>(Width=".$image_width.", Height=".$image_height.")</font></label><span class='star'> * </span></td>";
$table.="<td valign='top' align='left'>:</td>";

isset($promotions) && $promotions['pr_type']=="image" ? $st_img = "<img  width='50' src='".$this->config->item('promotion_icon_url').$promotions['pr_url']."' align='right' style='margin-top: -25px;'>" : $st_img = "";
$img_validation = isset($img_error) ? $img_error : '';
$table.="<td valign='top' align='left'>" . form_upload($data_icon) . "&nbsp;&nbsp;$st_img</td>";
$table.="<td valign='top' align='left'><span id='error' valign='top' align='left'>$img_validation</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130' valign='top' align='left'><label for='name'>Video URL</label><span class='star'> * </span></td>";
$table.="<td width='30' valign='top' align='left'>:</td>";
$table.="<td width='30' valign='top' align='left'>".form_input('pr_url',isset($promotions) && $promotions['pr_url'] && $promotions['pr_type']=="video" && !isset($_POST['pr_url']) ? $promotions['pr_url'] : $this->input->post('pr_url'),'id="pr_url" maxlength="120"')."</td>";
$table.="<td><span id='error' valign='top' align='left'>" . form_error('pr_url') . "</span><b>DUNE</b>:udp://@,<b>AMINO</b>:src=igmp://</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130' align='left'><label for='name'>Video Duration</label><span class='star'> * </span></td>";
$table.="<td width='30' align='left'>:</td>";
$table.="<td width='30' align='left'>".form_input('pr_duration',isset($promotions) && $promotions['pr_duration'] && !isset($_POST['pr_duration']) ? $promotions['pr_duration'] : $this->input->post('pr_duration'),'id="pr_duration" style="width:60px;"')." Milliseconds </td>";
$table.="<td><span id='error' valign='top' align='left'>" . form_error('pr_duration') . "</span></td>";
$table.="</tr>";

if($task == "update"){
	$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="' . base_url() . 'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="update"><img src="' . base_url() . 'images/apply2.png" alt=""/>Update Promotions</button></div></td>';
$table.="</tr>";
}else{
	$table.="<tr>";
	$table.='<td colspan="4" valign="top"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="' . base_url() . 'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="submit"><img src="' . base_url() . 'images/apply2.png" alt=""/>Create Promotions</button></div></td>';
	$table.="</tr>";
}
$table.="</table>";

print $table;

echo form_close();
?>
