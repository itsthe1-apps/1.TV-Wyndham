<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<br /><br />
<?
	$data_language		= $this->config->item('languages');
	$attributes = array('name' => 'myform','autocomplete'=>'off');
	echo form_open_multipart($this->uri->uri_string(), $attributes);
	
	if(isset($edit_data['ra_logo'])){
		$file	= $edit_data['ra_logo'];
		print form_input(array('name'=>'edit_image','type'=>'hidden', 'value'=>$file));
	} 
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
    	<td width="130"><label for="ra_name">Name</label><span class="star"> * </span></td>
        <td width="30">:</td>
        <td width="150"><?=form_input('ra_name',isset($edit_data['ra_name']) ? $edit_data['ra_name'] : $this->input->post('ra_name'),'maxlength=100')?></td>
        <td align="left"><span id="error"><?=form_error('ra_name')?></span></td>
    </tr>
    <tr>
    	<td width="130"><label for="ra_mrl">MRL</label><span class="star"> * </span></td>
        <td width="30">:</td>
        <td width="150"><?=form_input('ra_mrl',isset($edit_data['ra_mrl']) ? $edit_data['ra_mrl'] : $this->input->post('ra_mrl'),'maxlength=50')?></td>
        <td><span id="error"><?=form_error('ra_mrl')?></span></td>
    </tr>
    <tr>
    	<td width="130"><label for="ra_logo">Logo</label><span class="star"> * </span></td>
        <td width="30">:</td>
        <td width="150">
        	<?
				$st_img = isset($edit_data['ra_logo']) ? "<img src='".$this->config->item('radio_icon_url').$edit_data['ra_logo']."' align='right'>" : "";
            	print form_upload('ra_logo').'&nbsp;&nbsp;'.$st_img;
			?>
        </td>
        <td><span id="error"><?=isset($image_error) ? $image_error : ''?></span></td>
    </tr>
    <tr>
    	<td width="130"><label for="ra_description">Description</label></td>
        <td width="30">:</td>
        <td width="150">
			<?
				$ra_description = array('name'=>'ra_description', 'cols'=>40, 'rows'=>5, 'value'=>isset($edit_data['ra_description']) ? $edit_data['ra_description'] : $this->input->post('ra_description'));
            	print form_textarea($ra_description);
			?>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td width="130"><label for="ra_language">Language</label></td>
        <td width="30">:</td>
        <td width="150"><?=form_dropdown('ra_language',$data_language,isset($edit_data['ra_language']) ? $edit_data['ra_language'] : $this->input->post('ra_language'))?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="4" align="left"><br/>
        	<div class="buttons">
            <button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
            <? if(isset($edit_data['ra_id'])){?>
            	<button type="submit" class="positive" name="update"><img src="<?=base_url()?>images/apply2.png" alt=""/>Update</button>
            <? }else{ ?>
            	<button type="submit" class="positive" name="submit"><img src="<?=base_url()?>images/apply2.png" alt=""/>Create</button>
			<? } ?>
            </div>
        </td>
    </tr>
</table>
<? print form_close();?>