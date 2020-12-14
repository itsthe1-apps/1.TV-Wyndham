<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
    <h1 class="page_title"><?php echo $title; ?></h1>
    <hr/>
    <span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
$attributes = array('name' => 'myform', 'autocomplete' => 'off', 'class' => 'form-inline form_elements_list');
echo form_open_multipart($this->uri->uri_string(), $attributes);
//echo "<pre>";
//print_r($edit_data);
//echo "</pre>";
if (isset($edit_data['background_image'])) {
    $file = $edit_data['background_image'];
    print form_input(array('name' => 'edit_image', 'type' => 'hidden', 'value' => $file));
}
?>
    <div class="device_details">
        <div class="form-group">
            <label class="group_first_label" for="se_logo">Language <span class='star'> * </span></label>
            <label class="seperator_char">:</label>
            <?php
            echo $this->TVclass->language_dp('language', isset($edit_data['language']) ? $edit_data['language'] : $this->session->userdata($session_keyword), 'id="language"');
            ?>
            <span id='error'><?= form_error('language') ?></span>
        </div>
    </div>
    <div class="device_details">
        <div class="form-group">
            <label class="group_first_label" for="se_logo">Background Image <span class='star'> * </span></label>
            <label class="seperator_char">:</label>
            <?php
            $st_img = isset($edit_data['background_image']) ? "<img src='" . $this->config->item('bgs_img_url') . '/' . $edit_data['background_image'] . "' align='right' width='100'>" : "";
            $attrs = array("name" => "background_image", "class" => "btn btn-primary upload_glob");
            echo form_upload($attrs) . '&nbsp;&nbsp;' . $st_img
            ?>
            <span id="error"><span id="error"><?= isset($image_error) ? $image_error : '' ?></span>

        </div>
    </div>
    <div class="device_details">
        <div class="form-group">
            <label class="group_first_label" for="se_current_theme">Location<span class='star'> * </span></label>
            <label class="seperator_char">:</label>
            <?php
            $html_attrs = 'id="background_module" class="form-control select_form_option"';
            $selected_location = isset($edit_data['background_module']) ? $edit_data['background_module'] : $this->input->post('background_module');
            foreach ($devicetype as $row) {
                $opt_devicetypes[$row->id] = $row->device_type;
            }
            print form_dropdown('background_module', $enumval, $selected_location, $html_attrs);
            ?>
            <span id='error'><?= form_error('background_module') ?></span>
        </div>
    </div>
    <div class="main_control_btns" class="buttons" style="margin-top:0px;">
        <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span
                class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back
        </button>
        <?php
        if (isset($edit_data['background_id'])) {
            print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Backround</button>';
            //print form_submit('update','Update Device');
        } else {
            print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Backround</button>';
            //print form_submit('submit','Create Device');
        }
        ?>
    </div>
<?php print form_close(); ?>