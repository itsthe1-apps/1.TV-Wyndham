<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<h1 class="page_title"><?php echo $title; ?></h1>
<hr/>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?
	$data_language		= $this->config->item('languages');
	$attributes = array('name' => 'myform','autocomplete'=>'off','class'=>'form-inline form_elements_list');
	echo form_open_multipart($this->uri->uri_string(), $attributes);

?>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="language">Language<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php
        print $this->TVclass->language_dp('language',isset($edit_data['language']) ? $edit_data['language'] : $this->session->userdata($session_keyword),'id="language"');
        ?>
        <span id='error'><?= form_error('language') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="tickertape_url">Ticker Tape URL<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'tickertape_url', 'id' => 'tickertape_url', 'class' => 'form-control', 'placeholder' => 'Ticker Tape URL', 'value' => isset($edit_data['tickertape_url']) ? $edit_data['tickertape_url'] : $this->input->post('tickertape_url')]); ?>
        <span id='error'><?= form_error('tickertape_url') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if(isset($edit_data['id'])){
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update</button>';
        //print form_submit('update','Update Device');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create</button>';
        //print form_submit('submit','Create Device');
    }
    ?>
</div>
<? print form_close();?>