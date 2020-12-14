<script language="javascript">
    function listbox_move(listID, direction) {
        var listbox = document.getElementById(listID);
        var selIndex = listbox.selectedIndex;
        if(-1 == selIndex) {
            alert("Please select an option to move.");
            return;
        }
        var increment = -1;
        if(direction == 'up')
        increment = -1;
    else
    increment = 1;

if((selIndex + increment) < 0 ||
    (selIndex + increment) > (listbox.options.length-1)) {
    return;
}


var selValue = listbox.options[selIndex].value;
var selText = listbox.options[selIndex].text;
listbox.options[selIndex].value = listbox.options[selIndex + increment].value
listbox.options[selIndex].text = listbox.options[selIndex + increment].text
listbox.options[selIndex + increment].value = selValue;
listbox.options[selIndex + increment].text = selText;
listbox.selectedIndex = selIndex + increment;
}

function listbox_moveacross(sourceID, destID) {
var src = document.getElementById(sourceID);
var dest = document.getElementById(destID);
for(var count=0; count < src.options.length; count++) {
    if(src.options[count].selected == true) {
        var option = src.options[count];
        var newOption = document.createElement("option");
        newOption.value = option.value;
        newOption.text = option.text;
        newOption.selected = true;
        try {
            dest.add(newOption, null); //Standard
            src.remove(count, null);
        }catch(error) {
            dest.add(newOption); // IE only
            src.remove(count);
        }
        count--;
    }
}
}

function listbox_selectall(listID, isSelect) {
var listbox = document.getElementById(listID);
for(var count=0; count < listbox.options.length; count++) {
    listbox.options[count].selected = isSelect;
}
}

</script>
<?
$popup = array(
    'width' => '800',
    'height' => '800',
    'left' => '280',
    'top' => '0'
);
?>
<? $attributes = array('name' => 'myform', 'action' => 'POST'); ?>
</style>



<? $attributes = array('name' => 'listform', 'autocomplete' => 'off', 'onsubmit' => 'return validateForm();') ?>
<? print form_open($this->uri->uri_string(), $attributes); ?>
<style type="text/css">
    <!--
    .text {
        color: #FFF;
        visibility: hidden;
    }
    -->
</style>

<h1><? print $title; ?></h1>

<table width="100%" cellpadding="5" cellspacing="5" border="0" id="quote">
    <tr>
        <th align="center" width="48%" valign="top" height="20">User List</th>
        <th align="center" width="4%" valign="top" height="20">&nbsp;</th>
        <th align="center" width="48%" valign="top" height="20">To</th>
    </tr>
    <tr>
        <td align="center" valign="top"><?
		//print_r($message);
		$opt_rc 		= array();
		if (count($guest_list) > 0) {
			foreach ($guest_list as $row){
				$opt_rc[$row->id] = $row->name;
			}
		}
		print form_dropdown('list1[]', $opt_rc, '', 'size="10", style="width:98%", id="list1", multiple');
		?>
        </td>
        <td align="center">
        <input type="button" name="right3" value="&gt;&gt;" onclick="listbox_moveacross('list1', 'list2')"/><br /><input type="button" name="left2" value="&lt;&lt;" onclick="listbox_moveacross('list2', 'list1')"/></td>
        <td align="center" valign="top"><?
			$users_array		= $this->message->get_message_users_array($msg_id)->result();
			$selected_values	= array();
			$dp_values			= array();
			if(count($users_array)>0){
				foreach ($users_array as $row) {
					$dp_values[$row->user]	= $row->name;
					$selected_values[]		= $row->user;
				}
			}
		/**
			$users_array	= $this->message->get_message_users_array($msg_id);
			$opt_rc2	= array();
			$get_id		= array();
			foreach ($guest_list as $row) {
				print_r($row);
				if(isset($msg_id) && !empty($msg_id)){
					$explode_users = explode(",",$users_array);
					if(in_array($row->id,$explode_users)){
						$opt_rc2[$row->id]	= $row->name;
						$get_id[]			= $row->id;
					}
				}
			}
		**/
		print form_dropdown('list2[]', $dp_values, $selected_values, 'size="10", style="width:98%", id="list2", multiple');
		?>
        </td>
    </tr> 
    <tr>
        <td  align="center" colspan="3"><?=form_textarea('message', !empty($message['d_msg']) ? $message['d_msg'] : $this->input->post('message'), 'size=25 maxlength=1000') ?></td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="5">
    <tr>
        <td width="20%" align="center"><br/><div class="buttons">
                <button onclick="history.back();return false;" class="positive"><img src="<?= base_url() ?>images/cross.png" alt=""/>Back</button>
                    <?
                    if (isset($message['id'])) {
						//onclick="loopSelected()"
                        print '<button type="submit" class="positive" name="update"><img src="' . base_url() . 'images/apply2.png" alt=""/>Update Message</button>';
                        //print form_submit('update','Update Skin');
                    } else {
                        print '<button type="submit" class="positive" name="submit"><img src="' . base_url() . 'images/apply2.png" alt=""/>Send Message</button>';
                        //print form_submit('submit','Create Skin');
                    }
                    ?>
            </div></td>
    </tr>
</table>
<? print form_close(); ?>
<script language="javascript">
String.prototype.trim=function(){return this.replace(/^\s*(\b.*\b|)\s*$/,"$1");}
var frm = document.listform;

function validateForm()
{
	if(frm.list2.value.trim()==""){
		alert('Please select users first.');
		frm.list1.focus();
		return false;
	}
	if(frm.message.value.trim()==""){
		alert('Message required.');
		frm.message.focus();
		return false;
	}
}
</script>