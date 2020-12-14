<? $attributes = array('autocomplete'=>'off','class'=>'form-inline form_elements_list')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1 class="page_title"><? print $title;?></h1>
<hr/>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_type">Device Type<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'device_type', 'id' => 'device_type', 'class' => 'form-control', 'placeholder' => 'Device Type', 'value' => !empty($devicetypes['device_type']) ? $devicetypes['device_type'] : $this->input->post('device_type')]); ?>
        <span id='error'><?= form_error('device_type') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if (isset($devicetypes['id'])) {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Device Type</button>';
        //print form_submit('update','Update Device');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Device Type</button>';
        //print form_submit('submit','Create Device');
    }
    ?>
</div>

<? print form_close(); ?>