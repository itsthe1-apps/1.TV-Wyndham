<style type="text/css">
body {
	font-size: 12px;
	margin:20px 0;
}

h3{
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
}

.result{
	color:#993300;
}
.line{
	border-top:1px #666666 solid;
	color: #666;
	margin-top:10px;
}
form select, select{
	border:1px #999999 solid;
}
form input[type="submit"], input[type="button"]{
	background-color: #F5F5F5;
    border: 1px solid #999999;
    color: #565656;
    cursor: pointer;
    font-size: 12px;
    font-weight: bold;
    line-height: 100%;
    margin: 0 7px 0 0;
    outline: medium none;
    padding: 3px;
    text-decoration: none;
    text-transform: uppercase;
}
ol li{
	padding-bottom:10px;
}
</style>
<form method="post" name="device_form" onsubmit="return FormValidate()">
<input type="hidden" name="room_id" value="<?=$room_id?>"/> 
<input type="hidden" name="delete_id" id="delete_id" />
<table width="90%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
    	<td valign="top" align="left"><h3>Room Number : </h3></td>
        <td valign="top" align="left" class="result"><?=$room['room_number']?></td>
    </tr>
    <tr>
    	<td valign="top" align="left"><h3>Room Type : </h3></td>
        <td valign="top" align="left" class="result"><?=$room['rt_type']?></td>
    </tr>
    <tr>
    	<td valign="top" align="left" colspan="2"><div class="line">&nbsp;</div></td>
    </tr>
    <tr>
    	<td align="left" valign="top" colspan="2">
        	<?
				$devices_dp[''] = 'Select Your Device';
				if(count($devices)>0){
					foreach($devices as $row){
						$devices_dp[$row->id] = $row->UID; 
					}
				}
				print form_dropdown('device_id',$devices_dp);
			?>&nbsp;&nbsp;
            <input type="submit" value="Add Device" name="add_device">
        </td>
    </tr>
    <tr>
    	<td align="left" valign="top" colspan="2"><br/>
        	<ol>
            	<?
					if(count($room_devices)>0){
						foreach($room_devices as $row){
							print '<li>'.$row->UID.'&nbsp;&nbsp;<a href="#" onClick="deleteDevice('.$row->device_id.')"><img src="'.base_url().'images/cross.png"/></a></li>';
						}
					}
				?>
            </ol>
        </td>
    </tr>
</table><br><br>
<input type="button" value="Close" style="margin-left:40px;" onClick="javascript:window.close();">
</form>

<script type="text/javascript">
function FormValidate(){
	if(document.device_form.device_id.value==""){
		alert("Please select a device!");
		document.device_form.device_id.focus();
		return false;
	}
	return true;
}
function deleteDevice(id){
	if(confirm('Are you sure do you want to delete this record?')){
		document.getElementById('delete_id').value = id;
		document.device_form.submit();
	}
}
</script>