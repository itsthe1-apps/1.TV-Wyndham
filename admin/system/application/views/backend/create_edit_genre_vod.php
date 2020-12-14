<? $attributes = array('autocomplete'=>'off')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1><? print $title;?></h1>

<table width="100%" cellpadding="0" cellspacing="5">
	<tr>
    	<td width='20%'>Name</td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('name',!empty($mgenre['Code']) ? $mgenre['Code'] : $this->input->post('name'),'size=25 maxlength=100')?></td>
        <td><span id="error"><?=form_error('name')?></span></td>
    </tr>
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($mgenre['GndrId'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Genre</button>';
				//print form_submit('update','Update Skin');
			}else{
				print '<button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Create Genre</button>';
				 //print form_submit('submit','Create Skin');
			}
			?>
        </div></td>
    </tr>
</table>
<? print form_close(); ?>