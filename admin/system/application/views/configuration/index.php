<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="top"><!--<div class="buttons" style="float:right; margin-top:0px;"><a href="<? //base_url() ?>index.php/backend/addconfig" class="positive"><img src="<?= base_url() ?>images/apply2.png" alt=""/>ADD CONFIGURATION</a></div>--></td>
    </tr>
</table>
<? if ($this->session->flashdata('config_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('config_message') . "</p>";
    print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
    <div class="roundedcornr_top_main_tv"><div></div></div>
    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
        <table border='0' cellspacing='0' cellpadding='0' width='99%'>
            <tr>
                <th width="15%" style="border-right:1px #FFF solid;">Table Booking</th>
                <th width="15%" style="border-right:1px #FFF solid;">Wake Up Call</th>
                <!--<th width="15%" style="border-right:1px #FFF solid;">Resturant Booking Call</th>-->
                <th width="15%" style="border-right:1px #FFF solid;">Order Taxi</th>
                <th width="15%" style="border-right:1px #FFF solid;">Room Service Request</th>
                <th width="15%" style="border-right:1px #FFF solid;">Laundery Request</th>
                <th width="10%">Action</th>
            </tr>
        </table>
    </div>
    <div class="roundedcornr_bottom_main_tv"><div></div></div>
</div><br />

<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
	<? if (count($configuration) > 0) {
       	foreach ($configuration as $value) {?>
        <tr>
        	<td valign="middle" align="center" width="15%"><?=$value->se_table_booking?></td>
            <td valign="middle" align="center" width="15%"><?=$value->se_wakeup_call?></td>
           <!-- <td valign="middle" align="center" width="15%"><?=$value->se_restaurant_booking?></td>-->
            <td valign="middle" align="center" width="15%"><?=$value->se_order_taxi?></td>
            <td valign="middle" align="center" width="15%"><?=$value->se_room_service?></td>
            <td valign="middle" align="center" width="15%"><?=$value->se_laundery_request?></td>
			<td valign="middle" align="center" width="10%">
				<a href="<?= base_url() ?>index.php/backend/editconfig/<?=$value->se_id ?>"><img src="<?=base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>
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