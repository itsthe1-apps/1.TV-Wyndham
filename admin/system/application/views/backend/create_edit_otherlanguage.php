<? $attributes = array('autocomplete'=>'off')?>
<? print form_open($this->uri->uri_string(),$attributes); 
print form_hidden('greeting_id',$greeting_id);
?>
<h1><? print $title;?></h1>

<table width="100%" cellpadding="0" cellspacing="5">
	<tr>
    	<td width='20%'>Language  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=$this->TVclass->language_dp('greeting_language',isset($otherlanguage['greeting_language']) ? $otherlanguage['greeting_language'] : '');?></td> 
 		<td><span id="error"><?=form_error('greeting_language')?></span></td>
    </tr>
     <tr>
    	<td width='20%'>Greeting Title  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('greeting_title',!empty($otherlanguage['greeting_title']) ? $otherlanguage['greeting_title'] : $this->input->post('greeting_title'),'size=25 maxlength=50')?></td> 
 		<td><span id="error"><?=form_error('greeting_title')?></span> (Ex: Dear, Hello, etc)</td>
    </tr>
    <tr>
    	<td width='20%'>Description  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('greeting_desc',!empty($otherlanguage['greeting_desc']) ? $otherlanguage['greeting_desc'] : $this->input->post('greeting_desc'),'size=25 maxlength=100')?></td> 
 		<td><span id="error"><?=form_error('greeting_desc')?></span>(Ex: Welcome to our ABC Hotel)</td>
    </tr>
    
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($otherlanguage['detail_id'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Other Language</button>';
			}else{
				print '<button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Create Other Language</button>';
			}
			?>
                  </div></td>
    </tr>
</table>
<? print form_close(); ?>