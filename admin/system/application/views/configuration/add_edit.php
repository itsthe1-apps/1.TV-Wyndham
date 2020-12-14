<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<br /><br />
<?
	$attributes = array('name' => 'myform','autocomplete'=>'off');
	echo form_open($this->uri->uri_string(), $attributes);
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
    	<td width="157"><label for="tb_booking">Table Booking</label></td>
        <td width="3">:</td>
        <td width="150"><?=form_input('se_table_booking',isset($edit_data['se_table_booking']) ? $edit_data['se_table_booking'] : $this->input->post('se_table_booking'),'maxlength=100')?></td>
        <td width="150" align="left"><span id="error"><?=form_error('se_table_booking')?></span></td>
    </tr>    
    <tr>
    	<td width="157"><label for="tb_wakeup">Wake Up Call</label></td>
        <td width="3">:</td>
        <td width="150"><?=form_input('se_wakeup_call',isset($edit_data['se_wakeup_call']) ? $edit_data['se_wakeup_call'] : $this->input->post('se_wakeup_call'),'maxlength=100')?></td>
        <td align="left"><span id="error"><?=form_error('se_wakeup_call')?></span></td>
    </tr>
    <!--<tr>
    	<td width="130"><label for="tb_resturant">Resturant Booking Call</label></td>
        <td width="30">:</td>
        <td width="150"><?=form_input('se_restaurant_booking',isset($edit_data['se_restaurant_booking']) ? $edit_data['se_restaurant_booking'] : $this->input->post('se_restaurant_booking'),'maxlength=100')?></td>
        <td align="left"><span id="error"><?=form_error('se_restaurant_booking')?></span></td>
    </tr>-->
    <tr>
    	<td width="157"><label for="tb_order">Order Taxi</label></td>
        <td width="3">:</td>
        <td width="150"><?=form_input('se_order_taxi',isset($edit_data['se_order_taxi']) ? $edit_data['se_order_taxi'] : $this->input->post('se_order_taxi'),'maxlength=100')?></td>
        <td align="left"><span id="error"><?=form_error('se_order_taxi')?></span></td>
    </tr>
    <tr>
    	<td width="157"><label for="tb_room">Room Service Request</label></td>
        <td width="3">:</td>
        <td width="150"><?=form_input('se_room_service',isset($edit_data['se_room_service']) ? $edit_data['se_room_service'] : $this->input->post('se_room_service'),'maxlength=100')?></td>
        <td align="left"><span id="error"><?=form_error('se_room_service')?></span></td>
    </tr>
    <tr>
    	<td width="157"><label for="tb_laundery">Laundery Request</label></td>
        <td width="3">:</td>
        <td width="150"><?=form_input('se_laundery_request',isset($edit_data['se_laundery_request']) ? $edit_data['se_laundery_request'] : $this->input->post('se_laundery_request'),'maxlength=100')?></td>
        <td align="left"><span id="error"><?=form_error('se_laundery_request')?></span></td>
    </tr>
    
    <tr>
    	<td colspan="4" align="left"><br/>
        	<div class="buttons">
            <button onClick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
            <? if(isset($edit_data['se_id'])){?>
            	<button type="submit" class="positive" name="update"><img src="<?=base_url()?>images/apply2.png" alt=""/>Update</button>
            <? }else{ ?>
            	<button type="submit" class="positive" name="submit"><img src="<?=base_url()?>images/apply2.png" alt=""/>Create</button>
			<? } ?>
            </div>
        </td>
    </tr>
</table>
<? print form_close();?>