<html>
<body>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?=base_url()?>index.php/guest/addnamelanguage/<?=$guest_id?>" class="positive"><img src="<?=base_url()?>images/apply2.png" alt=""/>ADD NAME</a></div></td>
    </tr>
</table>

<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
                <div class="roundedcornr_top_main_tv"><div></div></div>
                    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
                   		<table border='0' cellspacing='0' cellpadding='0' width='99%'>
                            <tr>
                                <th width="20%" style="border-right:1px #FFF solid;">Language</th>
                                <th width="20%" style="border-right:1px #FFF solid;">Title</th>
                                <th width="20%" style="border-right:1px #FFF solid;">Name</th>
                                <th width="20%" style="border-right:1px #FFF solid;">Surname</th>
                                <th width="20%">Action</th>
                            </tr>
                        </table>
                    </div>
                <div class="roundedcornr_bottom_main_tv"><div></div></div>
            </div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
<?
if(count($otherlanguage)>0){
	foreach($otherlanguage as $row){
?>
<tr>
	<td align="center" width="20%"><?=$row->language?></td>
    <td align="center" width="20%"><?=$row->title?></td>
    <td align="center" width="20%"><?=$row->name?></td>
    <td align="center" width="20%"><?=$row->surname?></td>
    <td align="center" width="20%">
    	<a href="<?=base_url()?>index.php/guest/editnamelanguage/<?=$guest_id?>/<?=$row->id?>"><img src="<?=base_url()?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('guest/delete_namelanguage/<?=$guest_id?>','<?=$row->id?>','')"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>&nbsp;</td>
</tr>
<? }}else{
	$this->greeting->alter_table_otherlanguage();
	?>
<tr>
	<td align="center" colspan="11">No Data Found</td>
</tr>
<? }?>
</table>
<p align="center"><?=$pagination?></p>
</body>
</html>