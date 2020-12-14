<? $attributes = array('autocomplete'=>'off')?>
<? print form_open($this->uri->uri_string(),$attributes); 
print form_hidden('guest_id',$guest_id);
?>
<h1><? print $title;?></h1>

<table width="100%" cellpadding="0" cellspacing="5">
	<tr>
    	<td width='20%'>Language  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=$this->TVclass->language_dp('language',isset($otherlanguage['language']) ? $otherlanguage['language'] : '');?></td> 
 		<td><span id="error"><?=form_error('language')?></span></td>
    </tr>
    
    <tr>
    	<td width='20%'>Title  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('title',!empty($otherlanguage['title']) ? $otherlanguage['title'] : $this->input->post('title'),'maxlength=10 style="width:100px;"');?></td> 
 		<td><span id="error"><?=form_error('title')?></span></td>
    </tr>
    
    <tr>
    	<td width='20%'>Name  <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('name',!empty($otherlanguage['name']) ? $otherlanguage['name'] : $this->input->post('name'),'size=25 maxlength=100')?></td> 
 		<td><span id="error"><?=form_error('name')?></span></td>
    </tr>
    
    <tr>
    	<td width='20%'>Surname</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('surname',!empty($otherlanguage['surname']) ? $otherlanguage['surname'] : $this->input->post('surname'),'size=25 maxlength=100')?></td> 
 		<td>&nbsp;</td>
    </tr>
    
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($otherlanguage['id'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Other Language</button>';
			}else{
				print '<button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Create Other Language</button>';
			}
			?>
                  </div></td>
    </tr>
</table>
<? print form_close(); ?>