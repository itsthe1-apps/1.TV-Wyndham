<? $attributes = array('autocomplete'=>'off','class'=>'form-inline form_elements_list')?>
<? print form_open_multipart($this->uri->uri_string(),$attributes); ?>
<h1 class="page_title"><? print $title;?></h1>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="room_number">Room number<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'room_number', 'id' => 'room_number', 'class' => 'form-control', 'placeholder' => 'Room number', 'value' => !empty($rooms['room_number']) ? $rooms['room_number'] : $this->input->post('room_number')]); ?>
        <span id='error'><?= form_error('room_number') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="emergency_img">Floor Map <span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php  
        $attrs = array("name"=>"emergency_img","class"=>"btn btn-primary upload_glob");
        echo form_upload($attrs); ?>
        <span id="error"><?= isset($upload_file_error) ? $upload_file_error : ''; ?></span>

    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="room_type">Room type <span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="room_type" class="form-control select_form_option"';
        $selected_room = !empty($rooms['room_type']) ? $rooms['room_type'] : $this->input->post('room_type');
        $room_type_dp[''] = 'Select Room Type';
        if (count($room_type) > 0) {
            foreach ($room_type as $row_room_type) {
                $room_type_dp[$row_room_type->rt_id] = $row_room_type->rt_type;
            }
        }
        print form_dropdown('room_type', $room_type_dp, $selected_room, $html_attrs);
        ?>
        <span id='error'><?= form_error('room_type') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="butler_email">Butler Email <span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'butler_email', 'id' => 'butler_email', 'class' => 'form-control', 'placeholder' => 'Butler Email ', 'value' => !empty($rooms['butler_email']) ? $rooms['butler_email'] : $this->input->post('butler_email')]); ?>
        <span id='error'><?= form_error('butler_email') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if (isset($rooms['id'])) {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Room</button>';
        //print form_submit('update','Update Device');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create Room</button>';
        //print form_submit('submit','Create Device');
    }
    ?>
</div>

<? print form_close(); ?>