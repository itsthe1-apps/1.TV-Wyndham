<h1><?php echo $title;?></h1>
<?
$attributes = array('name'=>'f_formadd','onsubmit'=>'return validform(this);');
print form_open('welcome/addfavourites/'.$channel_id,$attributes);

$opt_users[''] = 'Select';
if($users>0){
	foreach($users as $row){
		$opt_users[$row->id] = $row->name;
	}
}
$channel_name = $this->Favourites->check_channel($channel_id)->row_array();

if(isset($_POST['users']) && !empty($_POST['users'])){
	$is_exist_fav = $this->Favourites->get_data_id($_POST['users'],$channel_id);
	if($is_exist_fav->num_rows()>0 && !isset($msg)){
		print '<font color="#FF0000">Already you have mapped this channel with selected user.</font>';
	}
}

if(isset($msg)){
	print '<font color="#009900">'.$msg.'</font>';
}

$table  = "<table width='60%' border='0' cellpadding='5' cellspacing='0'>";

$table .= "<tr>";
$table .= "<td width='10%'><label for='user'>Select User</label></td>";
$table .= "<td width='5%'>:</td>";
$table .= "<td width='45%'>".form_dropdown('users',$opt_users,$this->input->post('users'),'onchange="do_sub(this.value);"')."</td>";
$table .= "</tr>";

$table .= "<tr>";
$table .= "<td width='10%'><label for='name'>Channel Name</label></td>";
$table .= "<td width='5%'>:</td>";
$table .= "<td width='45%'>".$channel_name['name']."</td>";
$table .= "</tr>";


$table .= "<tr>";
$table .= '<td colspan="3"><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="'.base_url().'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="fav-submit" id="fav-submit"><img src="'.base_url().'images/apply2.png" alt=""/>Add To Favourites</button></div></td>';
$table .= "</tr>";

$table .= "</table>";

print $table;

print form_close();
?>
<script type="text/javascript">
<?
if(isset($is_exist_fav) && $is_exist_fav->num_rows()>0){
		print 'function disable_submit(){
				document.getElementById("fav-submit").style.display = "none";
			}
			disable_submit();
		';
	}
?>
function validform(frm){
	if(frm.users.value==""){
		alert('Please select a user.');
		frm.users.focus();
		return false;
	}
	return true;
}

function do_sub(){
	document.f_formadd.submit();
}
</script>