
<html>
    <head><title>Manage roles</title></head>
    <body>
        <?php
        // Show error
        echo validation_errors();

        // Build drop down menu
        $options[0] = 'None';
        foreach ($roles as $role) {
            $options[$role->id] = $role->name;
        }

        // Build table
        /**
          $this->table->set_heading('', 'ID', 'Name');

          foreach ($roles as $role)
          {
          $this->table->add_row(form_checkbox('checkbox_'.$role->id, $role->id), $role->id, $role->name);
          }
         * */
        // Build form
        $attributes = array('name' => 'listform', 'class' => 'form-inline form_elements_list');
        echo form_open($this->uri->uri_string(), $attributes);

        //echo form_label('Role parent', 'role_parent_label');
        //echo form_dropdown('role_parent', $options); 
        ?>
        <h1 class="page_title">
            Create Package
        </h1>
        <hr/>
        <div class="device_details">
            <div class="form-group">
                <label class="group_first_label" for="Urole_nameID">Package Name<span class='star'> * </span></label>
                <label class="seperator_char">:</label>
                <?php echo form_input(['name' => 'role_name', 'id' => 'role_name', 'class' => 'form-control', 'placeholder' => 'Package Name']); ?>
                <span id='error'><?= form_error('UID') ?></span>
                <div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
                    <button class="btn btn-success" type="submit" name="add" onClick="return validateForm();"><img src="'.base_url().'images/apply2.png" alt=""/>
                        <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>
                        <?php echo $this->lang->line('add_package_name') ?>
                    </button>
                </div>
            </div>
        </div>
        <hr/>

        <h1 class="page_title"><?php echo $title; ?></h1>
        <?php
        //echo form_label($this->lang->line('package_name'), 'role_name_label');
        //echo form_input('role_name', ''); 
        //echo "&nbsp;&nbsp;&nbsp;";
        //echo form_submit('add', $this->lang->line('add_package_name')); 
        //echo form_submit('delete', $this->lang->line('delete_package_name'));
        // Show table
        //echo $this->table->generate(); 
        ?>
        <div class="table_glob">
            <table class="table table-bordered table-hover" cellspacing='0' cellpadding='3' width='99%' id="table_form">
                <thead>
                    <tr class="success">
                        <th width="30%" >&nbsp;Select Package</th>
                        <!--<th width="20%" style="border-right:1px #FFF solid;">ID</th>-->
                        <th width="40%">Package Name</th>
                    </tr>
                </thead>
                <?
                foreach ($roles as $role)
                {
                ?>
                <tbody>
                    <tr class="active">
                        <td width="10%"><?= form_checkbox('checkbox_' . $role->id, $role->id, "", "onclick='setValue(\"$role->id\")' id='validcheck[]'") ?></td>
                       <!-- <td align="center" width="20%"><?= $role->id ?></td>-->
                        <td width="40%"><?= $role->name ?></td>
                    </tr>
                    <?
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
            <button type="submit" class="btn btn-danger"  name="delete" onClick="return getValue(\'delete\')"><img src="'.base_url().'images/apply2.png" alt=""/>
                <span class="glyphicon glyphicon-remove" style="padding-right:10px;"></span>
                <?php echo $this->lang->line('delete_package_name'); ?></button>
        </div>
        <?
        print form_input(array('name' => 'package_id', 'id' => 'package_id', 'type' => 'hidden'));
        echo form_close();

        ?>
    </body>
    <script language="javascript">
        String.prototype.trim = function () {
            return this.replace(/^\s*(\b.*\b|)\s*$/, "$1");
        }
        var frm = document.listform;

        function validateForm()
        {
            if (frm.role_name.value.trim() == "") {
                alert('Package name required.');
                frm.role_name.focus();
                return false;
            }
        }

        function getValue(from)
        {
            if (document.getElementById('validcheck[]') && from == "delete")
            {
                count = 0;
                str = '';
                var mylength = frm.elements["validcheck[]"].length;
                if (typeof (mylength) == "undefined") {
                    //var mycheck = 1;
                    if (frm.package_id.value == "") {
                        alert("You must choose at least 1 package.");
                        return false;
                    } else {
                        count++;
                    }
                }
                for (x = 0; x < frm.elements["validcheck[]"].length; x++) {
                    if (frm.elements["validcheck[]"][x].checked == true) {
                        str += frm.elements["validcheck[]"][x].value + ',';
                        frm.package_id.value = frm.elements["validcheck[]"][x].value;
                        count++;
                    }
                }

                if (count == 0) {
                    alert("You must choose at least 1 package.");
                    return false;
                }
                if (count > 0 && from == "delete")
                {
                    if (confirm("Are you sure you want to delete this?") == true) {
                        frm.submit();
                        return true;
                    } else {
                        return false;
                    }
                }
                return true;

            } else {
                alert('Records Empty.');
                return false;
            }
        }
    </script>
</html>