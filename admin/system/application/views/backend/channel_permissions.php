<html>
    <head><title>Manage Channel Permissions</title></head>
    <body>	

        <h1 class="page_title">Channel Permissions</h1>
        <hr/>
        <?php
        // Build drop down menu
        // Build drop down menu
        foreach ($roles as $role) {
            $options[$role->id] = $role->name;
        }

        // Change allowed uri to string to be inserted in text area
        /**
          if ( ! empty($allowed_uris))
          {
          $allowed_uris = implode(",", $allowed_uris);
          }
         * */
        //print_r($allowed_uris);
        // Build form
        $attributes = array('name' => 'list', 'class' => 'form-inline form_elements_list');
        echo form_open($this->uri->uri_string(), $attributes);
        ?>
        <div class="device_details">
            <div class="form-group">
                <label class="group_first_label" for="role_name_label"><?php echo form_label($this->lang->line('package_channel_name'), 'role_name_label'); ?><span class='star'> * </span></label>
                <label class="seperator_char">:</label>
                <?php
                $html_attrs = 'id="role" class="form-control select_form_option"';


                print form_dropdown('role', $options, '', $html_attrs);
                ?>
                <span id='error'><?= form_error('device_type') ?></span>
            </div>
        </div>
        <div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
            <button type="submit" class="btn btn-primary" name="show">
                <span class="glyphicon glyphicon-th-list" style="padding-right:10px;"></span>
                <?php echo $this->lang->line('add_channel_package_name'); ?>
            </button>
        </div>
        <br/>
        <?php
//echo 'Allowed STB IP (One IP per line) :<br/><br/>';

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
                    foreach ($all_channels as $channel) {
                        echo '<tr class="active"><td>';
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



                        echo form_checkbox($data) . " ";
                        echo $channel['name'] . " [<b>" . $channel['number'] . "</b> ]<br>";
                        if ($counter % 30 == 0)
                            echo "</td><td valign=top>";
                        $counter += 1;
                        echo '</td></tr>';
                    }

                    //echo form_textarea('allowed_uris', $allowed_uris); 
                    //echo form_submit('save', ' Save ');
                    ?>
                </tbody>
            </table>
        </div>
        <div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
            <button onClick="history.back();return false;" class="btn btn-primary">
                <span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back
            </button>
            <button type="submit" class="btn btn-success" name="save">
                <span class="glyphicon glyphicon-ok" style="padding-right:10px;"></span>Save
            </button>
        </div>

        <?
        echo form_close();
        ?>

        <SCRIPT LANGUAGE="JavaScript">

            function checkAll()
            {
                for (i = 0; i < document.list.elements.length; i++)
                {
                    if (document.list.elements[i].type == "checkbox")
                    {
                        document.list.elements[i].checked = true;
                    }
                }
            }

            function uncheckAll()
            {
                for (i = 0; i < document.list.elements.length; i++)
                {
                    if (document.list.elements[i].type == "checkbox")
                    {
                        document.list.elements[i].checked = false;
                    }
                }
            }
            //  End -->
        </script>


    </body>
</html>