<html>
<body>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?=base_url()?>index.php/backend/addlanguage" class="positive"><img src="<?=base_url()?>images/apply2.png" alt=""/>ADD LANGUAGE</a></div></td>
    </tr>
</table>
<? print form_open('backend/language')?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
                <div class="roundedcornr_top_main_tv"><div></div></div>
                    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
                   		<table border='0' cellspacing='0' cellpadding='0' width='99%'>
                            <tr>
                                 <th width="10%" style="border-right:1px #FFF solid;">Short Label</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Description</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Hotel Language Tag</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Active</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Date Format</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Time Format</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Price Decimals</th>
                                <th width="11%" style="border-right:1px #FFF solid;">Price Decimal Sign</th>
                                <th width="10%" style="border-right:1px #FFF solid;">Price Thousand Sign</th>
                                <th width="9%">Action</th>
                            </tr>
                        </table>
                    </div>
                <div class="roundedcornr_bottom_main_tv"><div></div></div>
            </div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
<?
if(count($language)>0){
	foreach($language as $row){
?>
<tr>
	<td align="center" width="10%"><?=$row->short_label?>&nbsp;</td>
    <td align="center" width="10%"><?=$row->desc?>&nbsp;</td>
    <td align="center" width="10%"><?=$row->hotel_lang_tag?>&nbsp;</td>
    <td align="center" width="10%"><?=$row->is_activated?>&nbsp;</td>
    <td align="center" width="10%"><?=$row->dateformat?>&nbsp;</td>
    <td align="center" width="10%"><?=$row->timeformat?>&nbsp;</td>
    <td align="center" width="10%"><?=$row->price_decimals?>&nbsp;</td>
    <td align="center" width="11%"><?=$row->price_decimal_sign?>&nbsp;</td>
    <td align="center" width="10%"><?=$row->price_thousand_sign?>&nbsp;</td>
    <td align="center" width="9%">
    	<a href="<?=base_url()?>index.php/backend/editlanguage/<?=$row->id?>"><img src="<?=base_url()?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('welcome/deletelanguage','<?=$row->id?>','')"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a></td>
</tr>
<? }}else{?>
<tr>
	<td align="center" colspan="10">No Data Found</td>
</tr>
<? }?>
</table>
<div align="center"><?=$pagination?></div>
<? print form_close();?>
</body>
</html>