<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<br /><br />
<?
	$attributes = array('name' => 'myform','autocomplete'=>'off');
	echo form_open_multipart($this->uri->uri_string(), $attributes);
	
	if(isset($edit_data['se_logo'])){
		$file	= $edit_data['se_logo'];
		print form_input(array('name'=>'edit_image','type'=>'hidden', 'value'=>$file));
	} 
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr>
    	<td width="130" valign="top"><label for="se_logo">Logo</label><span class="star"> * </span></td>
        <td width="30" valign="top">:</td>
        <td width="350" valign="top">
        	<?
				$st_img = isset($edit_data['se_logo']) ? "<img src='".$this->config->item('logo_icon_url').'/'.$edit_data['se_logo']."' align='right'>" : "";
            	print form_upload('se_logo').'&nbsp;&nbsp;'.$st_img;
			?>
        </td>
        <td valign="top"><span id="error"><?=isset($image_error) ? $image_error : ''?></span></td>
    </tr>
    <tr>
    	<td width="130" valign="top"><label for="se_current_theme">Current Theme</label><span class="star"> * </span></td>
        <td width="30" valign="top">:</td>
        <td width="350" valign="top">
        	<?
				$opt_theme[''] = 'Select';
				if(count($current_theme)){
					foreach($current_theme as $row){
						$opt_theme[$row->th_id] = $row->th_name;
					}
				}
				print form_dropdown('se_current_theme',$opt_theme,isset($edit_data['se_current_theme']) ? $edit_data['se_current_theme'] : $this->input->post('se_current_theme'));
			?>
        </td>
        <td valign="top"><span id="error"><?=form_error('')?></span></td>
    </tr>
    <tr>
    	<td colspan="4" align="left"><br/>
        	<div class="buttons">
            <button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
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