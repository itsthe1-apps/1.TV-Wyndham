<? $attributes = array('autocomplete'=>'off')?>
<? print form_open($this->uri->uri_string(),$attributes); 
print form_hidden('rest_mtype_id',$rest_mtype_id);
?>
<h1><? print $title;?></h1>

<table width="100%" cellpadding="0" cellspacing="5">
	<tr>
    	<td width='20%'>Language  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=$this->TVclass->language_dp('rest_mtype_language',isset($otherlanguage['rest_mtype_language']) ? $otherlanguage['rest_mtype_language'] : '');?></td> 
 		<td><span id="error"><?=form_error('rest_mtype_language')?></span></td>
    </tr>
    
    <tr>
    	<td width='20%'>Name  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('rest_mtype_desc',!empty($otherlanguage['rest_mtype_desc']) ? $otherlanguage['rest_mtype_desc'] : $this->input->post('rest_mtype_desc'),'size=25 maxlength=100')?></td> 
 		<td><span id="error"><?=form_error('rest_mtype_desc')?></span></td>
    </tr>
    
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($otherlanguage['rest_detail_id'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Other Language</button>';
			}else{
				print '<button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Create Other Language</button>';
			}
			?>
                  </div></td>
    </tr>
</table>
<? print form_close(); ?>