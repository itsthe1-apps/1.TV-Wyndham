<? $attributes = array('autocomplete'=>'off','class'=>'form-inline form_elements_list')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1 class="page_title"><? print $title;?></h1>
<hr/>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="rg_name">Room Group Name<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'rg_name', 'id' => 'rg_name', 'class' => 'form-control', 'placeholder' => 'Room Group Name', 'value' => !empty($roomgroups['rg_name']) ? $roomgroups['rg_name'] : $this->input->post('rg_name')]); ?>
        <span id='error'><?= form_error('rg_name') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
         <label class="group_first_label">Room List</label>
            <label class="seperator_char">:</label>
        <?php
        if (isset($roomgroups)) {
            $store_room_id = array();
            if (count($group_room) > 0) {
                foreach ($group_room as $row) {
                    $store_room_id[] = $row->gr_room_id;
                }
            }
            ?>
            <ul class="list-group list_glob">
                <?php
                if (count($rooms) > 0) {
                    foreach ($rooms as $row) {
                        $is_selected = in_array($row->id, $store_room_id) ? TRUE : FALSE;

                        print '<li class="list-group-item">' . form_checkbox('room_number[]', $row->id, $is_selected) ." ". $row->room_number . '</li>';
                    }
                }
                ?>
            </ul>
        <?php } ?>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" >
    <button onclick="history.back();return false;" type="submit" class="btn btn-primary" name="update"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if (isset($roomgroups['rg_id'])) {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Room Group</button>';
        //print form_submit('update','Update Group');
    } else {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create Room Group</button>';
        //print form_submit('submit','Create Group');
    }
    ?>
</div>
<table width="100%" cellpadding="0" cellspacing="5">


    <tr>
        <td colspan="4" align="left"><br/><div class="buttons">

            </div>
        </td>
    </tr>
</table>
<? print form_close(); ?>