<html>
<body>
     <span class="messages">
    <strong>Added Devices:&nbsp;</strong><?=$total_devices?>
    </span>
	&nbsp;&nbsp;&nbsp; [<span class="messages"><strong>Allowed Devices:</strong>
 <?=DEVICE_LIMIT?>
&nbsp;&nbsp;</span>]
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1></td>
        <td align="right" valign="top">
		<? if($total_devices < DEVICE_LIMIT){?>
        <div class="buttons" style="float:right; margin-top:0px;"><a href="<?=base_url()?>index.php/backend/adddevice" class="positive"><img src="<?=base_url()?>images/apply2.png" alt=""/>ADD DEVICES</a></div>
		<? }?>
    </td>
    </tr>
</table>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
                <div class="roundedcornr_top_main_tv"><div></div></div>
                    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
                   		<table border='0' cellspacing='0' cellpadding='0' width='99%'>
                            <tr>
                                <th width="10%" style="border-right:1px #FFF solid;">Device UID</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Device Type</th>
                                <th width="8%" style="border-right:1px #FFF solid;">Mac Address</th>
                                <th width="8%" style="border-right:1px #FFF solid;">Action</th>
                            </tr>
                        </table>
                    </div>
                <div class="roundedcornr_bottom_main_tv"><div></div></div>
            </div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
<?
if(count($devices)>0){
	foreach($devices as $row){
?>
<tr>
	<td align="center" width="10%"><?=$row->UID?>&nbsp;</td>
    <td align="center" width="10%">
	<?
		$device_type = $this->Devices->device_type_byid($row->device_type);
		print $device_type['device_type'];
	?>&nbsp;</td>
    <td align="center" width="8%"><?=$row->mac_address?></td>
    <td align="center" width="8%"><a href="<?=base_url()?>index.php/backend/editdevice/<?=$row->id?>"><img src="<?=base_url()?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('backend/deletedevice','<?=$row->id?>','')"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>&nbsp;</td>
</tr>
<? }}else{?>
<tr>
	<td align="center" colspan="12">No Data Found</td>
</tr>
<? }?>
</table>
<p align="center"><?=$pagination?></p>
</body>
</html>