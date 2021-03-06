
<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
$attributes = array('name' => 'myform', 'autocomplete' => 'off','class'=>'form-inline form_elements_list');

$upload_file = !empty($upload_file_error) ? $upload_file_error : "";


print form_open_multipart($this->uri->uri_string(), $attributes);

$data_array = array();

$experience_id;
$experience_type;
$experience_img_url;
$experience_description;
$language;

if ($task == 'edit') {

    foreach ($experience_data as $key => $value) {
      $experience_id = $value->experience_id;
      $experience_type = $value->experience_type;
      $experience_img_url = $value->experience_img_url;
      $experience_description = $value->description;
      $language = $value->language;
    }
}

//CK Editor
$ckeditor = array(
    //ID of the textarea that will be replaced
    'id' => 'description',
    'path' => 'js/ckeditor',
    //Optionnal values
    'config' => array(
        'toolbar' => "Full", //Using the Full toolbar
        'width' => "100%", //Setting a custom width
        'height' => '200px', //Setting a custom height
    ),
    //Replacing styles from the "Styles tool"
    'styles' => array(
        //Creating a new style named "style 1"
        'style 1' => array(
            'name' => 'Blue Title',
            'element' => 'h2',
            'styles' => array(
                'color' => 'Blue',
                'font-weight' => 'bold'
            )
        ),
        //Creating a new style named "style 2"
        'style 2' => array(
            'name' => 'Red Title',
            'element' => 'h2',
            'styles' => array(
                'color' => 'Red',
                'font-weight' => 'bold',
                'text-decoration' => 'underline'
            )
        )
    )
);

///////////////////////////////////////////////////////////////////////////////////////////////////




if ($task == 'edit') {
    $language_data = $language;
//    if ($language_data->num_rows() > 0) {
//        foreach ($language_data->result() as $row) {
//            $data_array[$row->language] = $row->language;
//        }
//    }
} else {
    $data_array = array($this->session->userdata($session_keyword) => $this->session->userdata($session_keyword));
}

$data_type = array('name' => 'experience_type', 'id' => 'experience_type');
$data_icon = array('name' => 'image_experience[]','multiple' => true, 'id' => 'image_experience',"class" => "btn btn-primary upload_glob", 'value' => $this->input->post('image_experience'));
$data_description = array('name' => 'description', 'id' => 'description', 'rows' => 5, 'cols' => '40', 'value' => isset($experience_description) ? $experience_description : '', 'onkeypress' => 'check_length(this.form,this);');


$table = '<div class="device_details">';
$table.='<div class="form-group">';
$table.='<label class="group_first_label" for="language">Language<span class="star"> * </span></label>';
$table.='<label class="seperator_char">:</label>';
$table.= $this->TVclass->language_dp('language', $data_array, 'id="language"  style="height:50px;"');
$table.="</div>";
$table.="</div>";

$table.='<div class="device_details">';
$table.=' <div class="form-group">';
$table.='<label class="group_first_label" for="spa_type">Attraction Name <span class="star"> * </span></label>';
$table.='<label class="seperator_char">:</label>';
$table.= form_input(['name' => 'experience_type', 'id' => 'experience_type', 'class' => 'form-control', 'placeholder' => 'Attraction Name', 'value' => isset($experience_type) ? $experience_type : '']);
$table.="<span id='error'>".form_error('experience_type')."</span>";
$table.="</div>";
$table.="</div>";

$table.='<div class="device_details">';
$table.=' <div class="form-group">';
$table.='<label class="group_first_label">Image <br/><font style="font-size:9px;" class="image_size">(Width="' . $image_width . '", Height="' . $image_height . '")</font> <span class="star"> * </span></label>';
$table.='<label class="seperator_char">:</label>';


isset($experience_img_url) ? $st_img = $experience_img_url : $st_img = "";
$img_validation = isset($experience_img_url) ? $img_error : '';

$image_names = explode("|",$st_img);
$html_img = '';
foreach ($image_names as $img) {
    $html_img .= "<img  width='100' src='".$this->config->item('experience_icon_url').$img."'>". "&nbsp;&nbsp;";
}
if ($st_img == '') {
    $html_img = '';
}
$table.= form_upload($data_icon) . "&nbsp;&nbsp;<br/>";
$table.="<div class='image_list_preview'>";
$table.=$html_img ."".form_hidden('exp_img_current', $st_img);
$table.="</div>";
$table.="<span id='error' valign='top' align='left'>'".isset($experience_img_url) ? $img_validation : ''."'</span>";


$table.='<div class="device_details">';
$table.=' <div class="form-group">';    
$table.='<label class="group_first_label">Description</label>';
$table.='<label class="seperator_char">:</label>';
$table.= form_textarea($data_description) . display_ckeditor($ckeditor);
$table.="<span id='error'>" . form_error('description') . "</span>";
$table.="</div>";
$table.="</div>";

print $table;
?>
<br/>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if($task == 'edit') {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Health Club</button>';
        //print form_submit('update','Update Device');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create Health Club</button>';
        //print form_submit('submit','Create Device');
        
    }
    ?>
</div>


<?php
echo form_close();
?>
