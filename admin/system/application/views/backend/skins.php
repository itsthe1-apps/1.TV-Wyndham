<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?=base_url()?>index.php/backend/addskin" class="positive"><img src="<?=base_url()?>images/apply2.png" alt=""/>ADD SKIN</a></div></td>
    </tr>
</table>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
                <div class="roundedcornr_top_main_tv"><div></div></div>
                    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
                   		<table border='0' cellspacing='0' cellpadding='0' width='99%'>
                            <tr>
                                 <th width="30%" style="border-right:1px #FFF solid;">Skin Name</th>
                                <th width="20%" style="border-right:1px #FFF solid;">Skin Css</th>
                               <!-- <th width="15%" style="border-right:1px #FFF solid;">Select</th> -->
                                <th width="14%">Actions</th>
                            </tr>
                        </table>
                    </div>
                <div class="roundedcornr_bottom_main_tv"><div></div></div>
            </div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
<?
	if(count($skins)>0){
		foreach($skins as $row){
			?>
            <tr>
                <td align="center" width="30%"><?=$row->sk_name?>&nbsp;</td>
                <td align="center" width="20%"><?=$row->sk_css?>&nbsp;</td>
              <!--  <td align="center" width="15%"><?=form_checkbox('select')?>&nbsp;</td> -->
                <td align="center" width="14%">
                	<a href="<?=base_url()?>index.php/backend/editskin/<?=$row->id?>"><img src="<?=base_url()?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('backend/deleteskin','<?=$row->id?>','')"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>&nbsp;</td>
			</tr>
            <?
		}
	}else{	
?>
	<tr>
		<td align="center" colspan="4">No Data Found</td>
	</tr>
<?
	}
?>
</table>
<div id="page" align="center"><?=$pagination;?></div>