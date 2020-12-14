<? $attributes = array('autocomplete'=>'off','class'=>'form-inline form_elements_list')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1 class="page_title"><? print $title;?></h1>
<hr/>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="rt_type">Room Type<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'rt_type', 'id' => 'UID', 'class' => 'form-control', 'placeholder' => 'Room Type', 'value' => !empty($roomtypes['rt_type']) ? $roomtypes['rt_type'] : $this->input->post('rt_type')]); ?>
        <span id='error'><?= form_error('rt_type') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if(isset($roomtypes['rt_id'])){
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Room Type</button>';
        //print form_submit('update','Update Device');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create Room Type</button>';
        //print form_submit('submit','Create Device');
    }
    ?>
</div>

<? print form_close(); ?>