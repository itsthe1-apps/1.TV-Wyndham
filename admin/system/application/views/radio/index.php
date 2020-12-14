<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/radio/add" class="positive"><img src="<?= base_url() ?>images/apply2.png" alt=""/>ADD RADIO</a></div></td>
    </tr>
</table>
<? if ($this->session->flashdata('radio_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('radio_message') . "</p>";
    print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
    <div class="roundedcornr_top_main_tv"><div></div></div>
    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
        <table border='0' cellspacing='0' cellpadding='0' width='99%'>
            <tr>
                <th width="35%" style="border-right:1px #FFF solid;">Image</th>
                <th width="30%">Name</th>
                <th width="14%">Actions</th>
            </tr>
        </table>
    </div>
    <div class="roundedcornr_bottom_main_tv"><div></div></div>
</div><br />

<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
	<? if (count($radio) > 0) {
       	foreach ($radio as $value) {?>
        <tr>
        	<td valign="middle" align="center" width="35%"><img src="<?=$this->config->item('radio_icon_url').$value->ra_logo?>" title="<?=$value->ra_name?>"  width="100"/></td>
            <td valign="middle" align="center" width="30%"><?=$value->ra_name?></td>
             <td valign="middle" align="center" width="14%">
                	<a href="<?= base_url() ?>index.php/radio/edit/<?=$value->ra_id ?>"><img src="<?=base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('radio/delete','<?=$value->ra_id ?>','')"><img src="<?=base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
                </td>
        </tr>
    <? 	}
	}else{?>
    	<tr>
        	<td colspan="2" align="left">No Data Found</td>
        </tr>
    <? } ?>
</table>
<div id="page" align="center"><?=$pagination; ?></div>