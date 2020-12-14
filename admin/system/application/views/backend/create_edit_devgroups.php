<? $attributes = array('autocomplete'=>'off')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1><? print $title;?></h1>

<table width="100%" cellpadding="0" cellspacing="5">
	<tr>
    	<td width='20%'>Group Name <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='20%'><?=form_input('group_name',!empty($devicegroups['group_name']) ? $devicegroups['group_name'] : $this->input->post('group_name'),'size=25 maxlength=100')?></td>
        <td><span id="error"><?=form_error('group_name')?></span></td>
    </tr>
    <tr>
    	<td colspan="4" align="left"><br/><div class="buttons">
        	<button onclick="history.back();return false;" class="positive"><img src="<?=base_url()?>images/cross.png" alt=""/>Back</button>
			<?
			if(isset($devicegroups['id'])){
				print '<button type="submit" class="positive" name="update"><img src="'.base_url().'images/apply2.png" alt=""/>Update Device Group</button>';
				//print form_submit('update','Update Group');
			}else{
				print '<button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Create Device Group</button>';
				//print form_submit('submit','Create Group');
			}
			?>
            </div>
        </td>
    </tr>
</table>
<? print form_close(); ?>