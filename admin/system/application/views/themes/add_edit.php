<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<h1 class="page_title"><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<hr/>
<?php
$attributes = array('name' => 'myform', 'autocomplete' => 'off', 'class' => 'form-inline form_elements_list');
echo form_open($this->uri->uri_string(), $attributes);
?>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="th_name">Name<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
<?php echo form_input(['name' => 'th_name', 'id' => 'th_name', 'class' => 'form-control', 'placeholder' => 'Name', 'value' => isset($edit_data['th_name']) ? $edit_data['th_name'] : $this->input->post('th_name')]); ?>
        <span id='error'><?= form_error('th_name') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="th_folder">Folder<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
<?php echo form_input(['name' => 'th_folder', 'id' => 'th_folder', 'class' => 'form-control', 'placeholder' => 'Folder', 'value' => isset($edit_data['th_folder']) ? $edit_data['th_folder'] : $this->input->post('th_folder')]); ?>
        <span id='error'><?= form_error('th_folder') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary">
        <span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back
    </button>
    <? if(isset($edit_data['th_id'])){?>
    <button type="submit" class="btn btn-success" name="update">
        <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update</button>
    <? }else{ ?>
    <button type="submit" class="btn btn-success" name="submit">
        <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create</button>
    <? } ?>
</div>
<? print form_close();?>