<? $attributes = array('autocomplete'=>'off')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1><? print $title;?></h1>
<table width="100%" cellpadding="0" cellspacing="5">
	<tr>
    	<td width='130'>Skin Name<span class='star'> * </span></td>
        <td width='30'>:</td>
        <td width='150'><?=form_input('sk_name',!empty($skins['sk_name']) ? $skins['sk_name'] : $this->input->post('sk_name'),'size=25')?></td>
        <td><span id="error"><?=form_error('sk_name')?></span></td>
    </tr>
    <tr>
    	<td width='130'>Skin Css<span class='star'> * </span></td>
        <td width='30'>:</td>
        <td width='150'><?=form_input('sk_css',!empty($skins['sk_css']) ? $skins['sk_css'] : $this->input->post('sk_css'),'size=25')?></td>
        <td><span id="error"><?=form_error('sk_css')?></span></td>
    </tr>
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($skins['id'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Skin</button>';
				//print form_submit('update','Update Skin');
			}else{
				print '<button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Create Skin</button>';
				 //print form_submit('submit','Create Skin');
			}
			?>
            </div>
        </td>
    </tr>
</table>
<? print form_close(); ?>