<script type="text/javascript">
$(document).ready(function(){
	<? if(!empty($message['room_id'])){ ?>
		$('.greeting_dp').show();
		$('.themes_dp').show();
		$('.language_dp').show();
	<? }else{ ?>
		$('.greeting_dp').hide();
		$('.themes_dp').hide();
		$('.language_dp').hide();
	<? } ?>
	$('#room_number').live('change', function(){
		$('.greeting_dp').show();
		$('.themes_dp').show();
		$('.language_dp').show();
		$('#is_updated_field').val(1);
	});
	$('#greeting').live('change', function(){
		$('#is_updated_field').val(1);
	});
        $('#name_title').live('change', function(){
		$('#is_updated_field').val(1);
	});
        $('#name').live('change', function(){
		$('#is_updated_field').val(1);
	});
        $('#surname').live('change', function(){
		$('#is_updated_field').val(1);
	});
	$('#themes').live('change', function(){
		$('#is_updated_field').val(1);
	});
	$('#language').live('change', function(){
		$('#is_updated_field').val(1);
	});
});
</script>
<? $attributes = array('autocomplete'=>'off')?>
<? 
	print form_open($this->uri->uri_string(),$attributes);
	$update_field = array('name'=>'is_updated_field','id'=>'is_updated_field','type'=>'hidden');
	print form_input($update_field);
	//print_r($record);
?>
<h1><? print $title;?></h1>
<table width="100%" cellpadding="0" cellspacing="5">
	<tr>
    	<td width='20%'>Room Number <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=$record['room_number'];?></td>
        <td><span id="error"><?=form_error('name')?></span></td>
    </tr>
    <tr>
    	<td width='20%'>Is Occupied</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_checkbox('occupied',1,!empty($record['occupied']) || $this->input->post('occupied')==1 ? TRUE : FALSE,'size=25')?></td>
        <td><span id="error"><?=form_error('occupied')?></span></td>
    </tr>
      <tr>
    	<td width='20%'>Is Clean Vacant</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_checkbox('clean_vacant',1,!empty($record['clean_vacant']) || $this->input->post('clean_vacant')==1 ? TRUE : FALSE,'size=25')?></td>
        <td><span id="error"><?=form_error('clean_vacant')?></span></td>
    </tr>         
          <tr>
    	<td width='20%'>Is Maintenance Required</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_checkbox('maintenance_request',1,!empty($record['maintenance_request']) || $this->input->post('maintenance_request')==1 ? TRUE : FALSE,'size=25')?></td>
        <td><span id="error"><?=form_error('maintenance_request')?></span></td>
    </tr>
          <tr>
    	<td width='20%'>Extra Bed</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_checkbox('extra_bed',1,!empty($record['extra_bed']) || $this->input->post('extra_bed')==1 ? TRUE : FALSE,'size=25')?></td>
        <td><span id="error"><?=form_error('extra_bed')?></span></td>
    </tr>
          <tr>
    	<td width='20%'>Is BabyCot Required</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_checkbox('babycot_request',1,!empty($record['babycot_request']) || $this->input->post('babycot_request')==1 ? TRUE : FALSE,'size=25')?></td>
        <td><span id="error"><?=form_error('babycot_request')?></span></td>
    </tr>
          <tr>
    	<td width='20%'>Is Cleaning Request</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_checkbox('cleaning_request',1,!empty($record['cleaning_request']) || $this->input->post('cleaning_request')==1 ? TRUE : FALSE,'size=25')?></td>
        <td><span id="error"><?=form_error('cleaning_request')?></span></td>
    </tr>
          <tr>
    	<td width='20%'>Is TurnDown Done</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_checkbox('turndown_done',1,!empty($record['turndown_done']) || $this->input->post('turndown_done')==1 ? TRUE : FALSE,'size=25')?></td>
        <td><span id="error"><?=form_error('turndown_done')?></span></td>
    </tr>
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($record['room_id'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Room Status</button>';
				//print form_submit('update','Update Skin');
                        }			?>
        </div></td>
    </tr>
</table>
<? print form_close(); ?>
<br /><br />
<?
if(count($room_guest)>0){
	print form_open();
	print '<h1>GUEST</h1>';
	print '<ul>';
	foreach($room_guest as $row){ 
	?>
        <li><?=$row->title.'.'.$row->name.' '.$row->surname?> <a href="javascript:deleteconform('<?=$this->uri->uri_string()?>','<?=$row->guest_id?>','')"><img src="<?=base_url()?>images/cross.png" /></a></li>
        <? }
	print '</ul>';
	print form_close();
}
?>