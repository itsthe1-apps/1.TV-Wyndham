<?php
$add = array('name' => 'addGroup', 'id' => 'addGroup', 'value' => 'Add Group', 'class' => 'button');
$edit = array('name' => 'editGroup', 'id' => 'editGroup', 'value' => 'Edit Group', 'class' => 'button', 'onclick' => "return getValue('edit')");
$group_perm = array('name' => 'group_perm', 'id' => 'gorup_perm', 'value' => 'true', 'content' => 'Group Permissions', 'onclick' => 'goHere()', 'class' => 'button');
$delete = array('name' => 'delete', 'id' => 'delete', 'value' => 'Delete Group', 'class' => 'button', 'onclick' => "return getValue('delete')");

$group_id = array('name' => 'group_id', 'id' => 'group_id', 'type' => 'hidden');

if (isset($not_found)) {
    $dsp_msg = '<span class="error">' . $not_found . '</span>';
} else if (isset($msg)) {
    $dsp_msg = '<span class="success_msg">' . $msg . '</span>';
}

$attributes = array('name' => 'myform');

$current_uri = "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2);

$order_val = array('name' => 'order_val', 'id' => 'order_val', 'type' => 'hidden');

$order_by_url = $this->session->userdata('orderby');

echo form_open($this->uri->uri_string(), $attributes);
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td align="left" valign="top"><h1><?php print $this->lang->line('usr_group_heding'); ?>&nbsp;&nbsp;<?php
                if (isset($dsp_msg)) {
                    print $dsp_msg;
                }
                ?></h1>&nbsp;</td>
        <td align="right" valign="top"><?php
            if ($this->dx_auth->is_admin()) {
                print form_button($group_perm) . "&nbsp;";
            }
            print $this->dx_auth->add_button($this->dx_auth->get_role_id(), $current_uri) == TRUE ? form_submit($add) : "";
            print $this->dx_auth->edit_button($this->dx_auth->get_role_id(), $current_uri) == TRUE ? "&nbsp;" . form_submit($edit) : "";
            print $this->dx_auth->delete_button($this->dx_auth->get_role_id(), $current_uri) == TRUE ? "&nbsp;" . form_submit($delete) : "";
            ?></td>
    </tr>
</table>
<div align="center">
    <table width="50%" cellpadding="0" cellspacing="0" id="table_users" align="center">
        <tr>
            <th width="6%">&nbsp;</th>
            <th width="29%">Group Name&nbsp;</th>
        </tr>
        <?php
        if (count($roles) > 0) {
            foreach ($roles as $role) {
                ?>
                <tr>
                    <td align="center"><? print form_checkbox('checkbox_me[]'.$role->id, $role->id, "", "onclick='setValue(\"$role->id\")' id='validcheck[]', class='fields'");?>&nbsp;</td>
                    <td align="center"><?= $role->name ?>&nbsp;</td>
                </tr>
                <?	
                }
                }
                ?>
            </table>
        </div>
        <?php
        echo form_input($group_id);
        echo form_input($order_val);
        echo form_close();
        ?>
        <script language="javascript">
            function orderBy(x) {
                document.getElementById('order_val').value = x.value;
                document.myform.submit();
            }
            function getValue(from) {
                if (document.getElementById('validcheck[]') && (from == "edit" || from == "delete")) {
                    count = 0;
                    str = '';
                    mylength = document.myform.elements["validcheck[]"].length;
                    if (typeof (mylength) == "undefined") {
                        //var mycheck = 1;
                        if (document.getElementById('group_id').value == "") {
                            alert("You must choose at least 1 group");
                            return false;
                        } else {
                            count++;
                        }
                    }
                    for (x = 0; x < document.myform.elements["validcheck[]"].length; x++) {
                        if (document.myform.elements["validcheck[]"][x].checked == true) {
                            str += document.myform.elements["validcheck[]"][x].value + ',';
                            document.getElementById('group_id').value = document.myform.elements["validcheck[]"][x].value;
                            count++;
                        }
                    }

                    if (count == 0) {
                        alert("You must choose at least 1 group");
                        return false;
                    }
                    if (count > 1 && from == "edit") {
                        alert("You can choose a maximum of 1 group");
                        return false;
                    }
                    if (count > 0 && from == "delete")
                    {
                        if (confirm("Are you sure you want to delete group/groups?") == true) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                    return true;
                } else {
                    alert('Empty groups.');
                    return false;
                }

            }

            function setValue(x)
            {
                if (document.getElementById('group_id').value == "")
                {
                    document.getElementById('group_id').value = x;
                } else {
                    document.getElementById('group_id').value = "";
                }
            }

            function goHere()
            {
                window.location = "<?= base_url() ?>index.php/myauth/uri_permissions";
    }

</script>