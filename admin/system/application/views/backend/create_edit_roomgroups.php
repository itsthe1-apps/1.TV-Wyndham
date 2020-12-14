<? $attributes = array('autocomplete' => 'off', 'class' => 'form-inline form_elements_list') ?>
<? print form_open($this->uri->uri_string(), $attributes); ?>
<h1 class="page_title"><? print $title; ?></h1>
<hr/>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="rg_name">Room Group Name<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'rg_name', 'id' => 'rg_name', 'class' => 'form-control', 'placeholder' => 'Room Group Name', 'value' => !empty($roomgroups['rg_name']) ? $roomgroups['rg_name'] : $this->input->post('rg_name')]); ?>
        <span id='error'><?= form_error('rg_name') ?></span>
    </div>
</div>
<br/>
<?php
echo "";
echo "";
$counter = 1;
?>
<div class="table_glob">
    <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='3' width='99%'>
        <thead>
        <tr class="success">
            <td>
                <a href='javascript:checkAll()'>Check All</a> &nbsp;&nbsp|&nbsp;&nbsp
                <a href='javascript:uncheckAll()'>Clear All</a>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        //
        if (!empty($rooms)) {
//                echo "<pre>";
//                print_r($rooms);
//                echo "</pre>";
//                die();
            if (!empty($roomgroups)) {
                $store_room_id = array();
                foreach ($group_room as $row) {
                    $store_room_id[] = $row->gr_room_id;
                }
            }
            foreach ($rooms as $row) {
                echo '<tr class="active"><td>';
                $is_selected = in_array($row->id, $store_room_id) ? TRUE : FALSE;
                $data = array(
                    'name' => 'room_number[]',
                    'id' => 'room_number_' . $counter,
                    'class' => 'room_number_list',
                    'value' => $row->id,
                    'checked' => $is_selected,
                    'style' => 'margin:1px',
                );
                echo form_checkbox($data) . " ";
                echo "Room [<b>" . $row->room_number . "</b> ]<br>";
//                    if ($counter % 30 == 0) {
//                        echo "</td><td valign=top>";
//                    }
                $counter += 1;
                echo '</td></tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;">
    <button onclick="history.back();return false;" type="submit" class="btn btn-primary" name="update"><span
            class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back
    </button>
    <?php
    if (isset($roomgroups['rg_id'])) {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Room Group</button>';
        //print form_submit('update','Update Group');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Create Room Group</button>';
        //print form_submit('submit','Create Group');
    }
    ?>
</div>
<table width="100%" cellpadding="0" cellspacing="5">


    <tr>
        <td colspan="4" align="left"><br/>
            <div class="buttons">

            </div>
        </td>
    </tr>
</table>
<? print form_close(); ?>
<script type="text/javascript">
    var inputCheckboxes = document.getElementsByTagName('input');
    function checkAll() {
        console.log(inputCheckboxes.length);
        for (i = 0; i < inputCheckboxes.length; i++) {
            if (inputCheckboxes[i].type == "checkbox") {
                inputCheckboxes[i].checked = true;
            }
        }
    }
    function uncheckAll() {
        for (i = 0; i < inputCheckboxes.length; i++) {
            if (inputCheckboxes[i].type == "checkbox") {
                inputCheckboxes[i].checked = false;
            }
        }
    }
    //  End -->
</script>
