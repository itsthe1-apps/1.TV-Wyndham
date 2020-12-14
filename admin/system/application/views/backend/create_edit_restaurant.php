<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
	//Ckeditor's configuration
		$ckeditor = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'description',
			'path'	=>	'js/ckeditor',
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"450px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
			),
		
			//Replacing styles from the "Styles tool"
			'styles' => array(
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Blue',
						'font-weight' 		=> 	'bold'
					)
				),
				
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 		=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		);
$rtt_sh = isset($time_tracker['rtt_sh']) ? explode(',',$time_tracker['rtt_sh']) : array();
$rtt_sm = isset($time_tracker['rtt_sm']) ? explode(',',$time_tracker['rtt_sm']) : array();
$rtt_eh = isset($time_tracker['rtt_eh']) ? explode(',',$time_tracker['rtt_eh']) : array();
$rtt_em = isset($time_tracker['rtt_em']) ? explode(',',$time_tracker['rtt_em']) : array();
$interval_time = isset($time_tracker['rtt_interval']) ? explode(':',$time_tracker['rtt_interval']) : array();

$attributes = array('name' => 'myform','autocomplete'=>'off');

$upload_file = !empty($upload_file_error) ? $upload_file_error : "";

function hours($name=false,$selected=false){
	$html = '<select name="'.$name.'">';
	$html.= '<option value="00" selected="selected">00</option>';
	for($i=1;$i<=23;$i++){
		$i = $i<10 ? '0'.$i : $i;
		$sel = $selected==$i ? 'selected="selected"' : '';
		$html.= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
	}
	$html.= '</select>';
	return $html;
}

function minutes($name=false,$selected=false){
	$html = '<select name="'.$name.'">';
	$html.= '<option value="00" selected="selected">00</option>';
	for($i=1;$i<=59;$i++){
		$i = $i<10 ? '0'.$i : $i;
		$sel = $selected==$i ? 'selected="selected"' : '';
		$html.= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
	}
	$html.= '</select>';
	return $html;
}

echo form_open_multipart($this->uri->uri_string(), $attributes);

$data_name = array('name' => 'name', 'id' => 'name', 'class' => 'form-control', 'size' => 25, 'value'=>isset($restaurant['name']) ? $restaurant['name'] : $this->input->post('name'));
$data_icon = array('name' => 'icon1[]', 'id' => 'icon1', 'class' => 'form-control','multiple' => true,'value'=>$this->input->post('icon'));

//$data_menu_icon = array('name' => 'icon2', 'id' => 'icon2','value'=>$this->input->post('icon2'));

$data_description = array('name' => 'description', 'id' => 'description', 'class' => 'form-control', 'rows' => 5, 'cols' => '40', 'value' => isset($restaurant['description']) ? html_entity_decode($restaurant['description']) : html_entity_decode($this->input->post('description')), 'onkeypress'=>'check_length(this.form,this);');

if(isset($restaurant['image'])){
	//$file	= $this->TVclass->set_image_path("RESTAURANT",basename($restaurant['image']));
	$file = $restaurant['image'];
	print form_input(array('name'=>'file_img_name1','type'=>'hidden', 'value'=>$file));
}
/**
if(isset($restaurant['menu_image'])){
	$file	= $this->TVclass->set_image_path("RESTAURANT",basename($restaurant['menu_image']));
	print form_input(array('name'=>'file_img_name2','type'=>'hidden', 'value'=>$file));
}
**/
/**
  echo $this->validation->error_string;
**/

$table = "<table width='100%' border='0' cellpadding='5' cellspacing='0' class='table'>";

$table.="<tr>";
$table.="<td width='30%'><label for='name'>Language</label><span class='star'> * </span></td>";
$table.="<td width='10%'>:</td>";
$table.="<td width='30%'>".$this->TVclass->language_dp('language',isset($restaurant['language']) ? $restaurant['language'] : $this->session->userdata($session_keyword),'id="language"')."</td>";
$table.="<td width='25%'></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>Restaurant Name</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input($data_name) . "</td>";
$table.="<td><span id='error'>" . form_error('name') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='icon'>Image <font class='image_size'>(width=".$image_width.", Height=".$image_height.")</font></label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$image_names = explode("|",$restaurant['image']);

$html_img = '';
foreach ($image_names as $img) {
    $html_img .= "<img  width='120' style='margin:10px;' src='".$this->config->item('rest_icon_url').$img."' align='right'>";
}
isset($restaurant['image']) && $restaurant['image']!="" ? $st_img = $html_img : $st_img = ""; 

$table.="<td>" . form_upload($data_icon) . "&nbsp;&nbsp;$st_img</td>".form_hidden('rest_current_imgs', $restaurant['image']);
$table.="<td><span id='error'>".$upload_file."</span></td>";
$table.="</tr>";

/**
$table.="<tr>";
$table.="<td width='130'><label for='icon'>Menu Image</label><span class='star'> * </span></td>";
$table.="<td width='30'>:</td>";

isset($restaurant['menu_image']) ? $st_menu_img = "<img  width='50' src='".$restaurant['menu_image']."' align='right'>" : $st_menu_img = "";

$table.="<td width='150'>" . form_upload($data_menu_icon) . "&nbsp;&nbsp;$st_menu_img</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";
**/
//print substr($restaurant['daliy_time'],11,2);

$table.="<tr>";
$table.="<td><label for='daliy_time'>Daily Time</label></td>";
$table.="<td>:</td>";
$table.="<td>".form_input('daliy_time',isset($restaurant['daliy_time']) ? $restaurant['daliy_time'] : '','class="form-control"')."</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='breakf_time'>Break First Time</label></td>";
$table.="<td>:</td>";
$table.="<td>".form_input('breakf_time',isset($restaurant['breakf_time']) ? $restaurant['breakf_time'] : '','maxlength=40 class="form-control"')."</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='lunch_time'>Lunch Time</label></td>";
$table.="<td>:</td>";
$table.="<td>".form_input('lunch_time',isset($restaurant['lunch_time']) ? $restaurant['lunch_time'] : '','maxlength=40 class="form-control"')."</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='dinner_time'>Dinner Time</label></td>";
$table.="<td>:</td>";
$table.="<td>".form_input('dinner_time',isset($restaurant['dinner_time']) ? $restaurant['dinner_time'] : '','maxlength=40 class="form-control"')."</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";


	$popup = array(
		'class'     =>  'blue-button',
		'width'     =>  '600',
		'height'    =>  '400',
		'screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
		'screeny'   =>  '\'+((parseInt(screen.height) - 400)/2)+\''
	);
	
	$im_1 = isset($interval_time[1]) && $interval_time[1]==15 ? 'selected="selected"' : '';
	$im_2 = isset($interval_time[1]) && $interval_time[1]==30 ? 'selected="selected"' : '';
	
	$table.="<tr>";
	$table.="<td><label for='interval'>Interval</label></td>";
	$table.="<td>:</td>";
	$table.="<td>" .
	"<select name='int_hours'><option value='00'>00</option></select> : ".
	"<select name='int_minutes'><option value='15' $im_1>15</option><option value='30' $im_2>30</option></select>&nbsp;&nbsp;";
	$table.="</td><td><span id='error'></span></td>";
	$table.="</tr>";
// Time Fields
print form_hidden('total_fields',6);

for($i=1;$i<=5;$i++){
	$table.="<tr>";
	$table.="<td align='right'><label for='start_time_".$i."'>Start Time</label></td>";
	$table.="<td>:</td>";
	$table.="<td>" . 
		hours('start_hours_'.$i, isset($rtt_sh[$i - 1]) ? $rtt_sh[$i - 1] : $this->input->post('start_hours_'.$i))." : ".
		minutes('start_minutes_'.$i, isset($rtt_sm[$i - 1]) ? $rtt_sm[$i - 1] : $this->input->post('start_minutes_'.$i)).'&nbsp;  End Time : '.
		hours('end_hours_'.$i, isset($rtt_eh[$i - 1]) ? $rtt_eh[$i - 1] : $this->input->post('end_hours_'.$i))." : ".
		minutes('end_minutes_'.$i, isset($rtt_em[$i - 1]) ? $rtt_em[$i - 1] : $this->input->post('end_minutes_'.$i)).'&nbsp;</td>';
	$table.="<td><span id='error'></span></td>";
	$table.="</tr>";
}

$table.="<tr>";
$table.="<td><label for='name'>Dress</label></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input('dress',isset($restaurant['dress']) ? $restaurant['dress'] : '','class="form-control"'). "</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>Venue</label></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input('venue',isset($restaurant['venue']) ? $restaurant['venue'] : '','class="form-control"'). "</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>Service Type</label></td>";
$table.="<td>:</td>";
$table.="<td>" . form_checkbox('is_service',1,isset($restaurant['is_service']) && $restaurant['is_service']==1 ? 'checked="checked"' : ''). "</td>";
$table.="<td><span id='error'></span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td valign='top'><label for='description'>Description</label><span class='star'> * </span></td>";
$table.="<td valign='top'>:</td>";
$table.="<td>" . form_textarea($data_description) . display_ckeditor($ckeditor). "</td>";
$table.="<td><span id='error'>" . form_error('description') . "</span></td>";
$table.="</tr>";

if($task == "update"){
	$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="btn btn-danger">Back</button>
&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="update">Update Restaurant</button></div></td>';
$table.="</tr>";
}else{
	$table.="<tr>";
	$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="btn btn-danger">Back</button>
	&nbsp;&nbsp;<button type="submit" class="btn btn-success" name="submit">Create Restaurant</button></div></td>';
	$table.="</tr>";
}
$table.="</table>";

print $table;

echo form_close();
?>