<?php //Edit by Yesh     ?>
<?php $attributes = array('autocomplete' => 'off','class'=>'form-inline form_elements_list') ?>
<?php print form_open_multipart($this->uri->uri_string(), $attributes); ?>
<h1 class="page_title"><?php print $title; ?></h1>
<hr/>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="message">Message<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_textarea(['name' => 'message', 'id' => 'message', 'class' => 'form-control', 'placeholder' => 'Message', 'value' => !empty($exitmsg['message']) ? $exitmsg['message'] : $this->input->post('message')]); ?>
        <span id='error'><?= form_error('message') ?></span>
    </div>
</div>
<br/>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="rtsp">RTSP<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'rtsp', 'id' => 'rtsp', 'class' => 'form-control', 'placeholder' => 'RTSP', 'value' => !empty($exitmsg['rtsp']) ? $exitmsg['rtsp'] : $this->input->post('rtsp')]); ?>
        <span id='error'><?= form_error('rtsp') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="icon">Image Message <span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php  
        $attrs = array("name"=>"icon","id"=>"icon","class"=>"btn btn-primary upload_glob");
        echo form_upload($attrs); ?>
        <span id="error"><?= isset($upload_file_error) ? $upload_file_error : ''; ?></span>

    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="status">Status<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="device_types" class="form-control select_form_option"';
        $status = $this->config->item('status');
        $selected = !empty($exitmsg['status']) ? $exitmsg['status'] : 0;
        print form_dropdown('status', $status, $selected, $html_attrs);
        ?>
        <span id='error'><?= form_error('status') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if (isset($exitmsg['id'])) {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Exit Message</button>';
        //print form_submit('update','Update Device');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create Exit Message</button>';
        //print form_submit('submit','Create Device');
    }
    ?>
</div>

<?php print form_close(); ?>