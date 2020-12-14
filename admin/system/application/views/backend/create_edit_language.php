<? $attributes = array('autocomplete'=>'off')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1><? print $title;?></h1>
<table width='100%' border='0' cellpadding='5' cellspacing='0'>
	<tr>
    	<td width='209'>Short Label<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('short_label',!empty($language['short_label']) ? $language['short_label'] : $this->input->post('short_label'),'size=25 maxlength=20')?></td>
        <td width="844"><span id="error"><?=form_error('short_label')?></span></td>
    </tr>
    <tr>
    	<td width='209'>Description<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('desc',!empty($language['desc']) ? $language['desc'] : $this->input->post('desc'),'size=25')?></td>
        <td><span id="error"><?=form_error('desc')?></span></td>
    </tr>
     <tr>
    	<td width='209'>Hotel Lanugage Tag<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('hotel_lang_tag',!empty($language['hotel_lang_tag']) ? $language['hotel_lang_tag'] : $this->input->post('hotel_lang_tag'),'size=25 maxlength=20')?></td>
        <td><span id="error"><?=form_error('hotel_lang_tag')?></span></td>
    </tr>
    <tr>
    	<td width='209'>Is Activated</td>
        <td width='34'>:</td>
        <td width='209'><?=form_checkbox('is_activated',1,!empty($language['is_activated']) || $this->input->post('is_activated')==1 ? TRUE : FALSE)?></td>
        <td><span id="error"><?=form_error('is_activated')?></span></td>
    </tr>
   <tr>
    	<td width='209'>Date format<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('dateformat',!empty($language['dateformat']) ? $language['dateformat'] : $this->input->post('dateformat'),'size=25 maxlength=20')?></td>
        <td><span id="error"><?=form_error('dateformat')?></span></td>
    </tr>
    <tr>
    	<td width='209'>Time format<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('timeformat',!empty($language['timeformat']) ? $language['timeformat'] : $this->input->post('timeformat'),'size=25 maxlength=20')?></td>
        <td><span id="error"><?=form_error('timeformat')?></span></td>
    </tr>
    <tr>
    	<td width='209'>Price Decimals<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('price_decimals',!empty($language['price_decimals']) ? $language['price_decimals'] : $this->input->post('price_decimals'),'size=25 maxlength=10')?></td>
        <td><span id="error"><?=form_error('price_decimals')?></span></td>
    </tr>
   <tr>
    	<td width='209'>Price Decimals Sign<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('price_decimal_sign',!empty($language['price_decimal_sign']) ? $language['price_decimal_sign'] : $this->input->post('price_decimal_sign'),'size=25 maxlength=10')?></td>
        <td><span id="error"><?=form_error('price_decimal_sign')?></span></td>
    </tr>
    <tr>
    	<td width='209'>Price Thousand Sign<span class='star'> * </span></td>
        <td width='34'>:</td>
        <td width='209'><?=form_input('price_thousand_sign',!empty($language['price_thousand_sign']) ? $language['price_thousand_sign'] : $this->input->post('price_thousand_sign'),'size=25 maxlength=10')?></td>
        <td><span id="error"><?=form_error('price_thousand_sign')?></span></td>
    </tr>
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($language['id'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Language</button>';
				//print form_submit('update','Update Language');
			}else{
				print '<button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Create language</button>';
				 //print form_submit('submit','Create language');
			}
			?>
            </div>
        </td>
    </tr>
</table>
<? print form_close(); ?>