<html>
<head><title>Manage Channel Permissions</title></head>
<body>
<h1 class="page_title">Room Group Channel Permissions</h1>
<hr/>
<?php
// Build drop down menu
// Build drop down menu
foreach ($room_groups as $row) {
    $options[$row->rg_id] = $row->rg_name;
}

// Change allowed uri to string to be inserted in text area
/**
 * if ( ! empty($allowed_uris))
 * {
 * $allowed_uris = implode(",", $allowed_uris);
 * }
 * */
//print_r($allowed_uris);
// Build form
$attrs = array('class' => 'form-inline form_elements_list', 'name' => 'list');
echo form_open($this->uri->uri_string(), $attrs);
?>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="role"><?php echo form_label('SELECT ROOM GROUP', 'role_name_label'); ?>
            <span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="role" class="form-control select_form_option"';
        echo form_dropdown('role', $options, $role_id, $html_attrs);
        ?>
        <span id='error'><?= form_error('device_type') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;">
    <button type="submit" class="btn btn-primary" name="show">
        <span class="glyphicon glyphicon-th-list" style="padding-right:10px;"></span>
        <?php echo $this->lang->line('add_channel_package_name'); ?>
    </button>
</div>
<?php
//echo form_submit('show', $this->lang->line('package_role_name')); 		

echo form_label('', 'uri_label');

echo '<hr/>';

//echo 'Allowed STB IP (One IP per line) :<br/><br/>';

echo "<a href='javascript:checkAll()'>Check All</a> &nbsp;&nbsp";
echo "<a href='javascript:uncheckAll()'>Clear All</a>";

$counter = 1;
?>
<div class="table_glob">
    <table border='0' cellspacing='0' cellpadding='3' width='99%'>
        <tr>
            <td valign="top">
                <?


                //print_r($all_channels);
                foreach ($all_channels as $channel) {
                    //print_r($channel);
                    $check_status = FALSE;
                    if (!empty($allowed_uris)) {
                        if (in_array($channel['id'], $allowed_uris)) {
                            $check_status = TRUE;
                        }
                    }

                    //print_r($channel['Channelname']);
                    $data = array(
                        'name' => 'allowed_uris[]',
                        'id' => 'allowed_uris[]',
                        'value' => $channel['id'],
                        'checked' => $check_status,
                        'style' => 'margin:1px',
                    );


                    echo form_checkbox($data);
                    echo " <b>" . $channel['name'] . "</b><br>";
                    if ($counter % 30 == 0) echo "</td><td valign=top>";
                    $counter += 1;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td align="left">
                <br/>
                <div class="main_control_btns" class="buttons" style="margin-top:0px;">
                    <button class="btn btn-primary" onClick="history.back();return false;" class="positive">
                        <span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back
                    </button>
                    <?php
                    print '<button class="btn btn-success" type="submit" class="positive" name="save"><span class="glyphicon glyphicon-ok" style="padding-right:10px;"></span>Save</button>';
                    ?>
                </div>

            </td>
        </tr>
    </table>
</div>
<?
//echo form_textarea('allowed_uris', $allowed_uris);

echo '<br/>';
//echo form_submit('save', 'Save');

echo form_close();
?>

<SCRIPT LANGUAGE="JavaScript">

    function checkAll() {
        for (i = 0; i < document.list.elements.length; i++) {
            if (document.list.elements[i].type == "checkbox") {
                document.list.elements[i].checked = true;
            }
        }
    }

    function uncheckAll() {
        for (i = 0; i < document.list.elements.length; i++) {
            if (document.list.elements[i].type == "checkbox") {
                document.list.elements[i].checked = false;
            }
        }
    }
    //  End -->
</script>


</body>
</html>