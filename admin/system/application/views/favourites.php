<? 
$attributes = array('name'=>'listform');
print form_open('welcome/favourites',$attributes)?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1><br></td>
    </tr>
    <tr>
    	<td align="left" valign="">Select User : 
        	<?
			/**
			if(isset($fav_array) && count($fav_array)>0){
				$get_fav = str_replace(",","-",$fav_array['fav_channel_id']);
			}
			**/
			if(count($users)>0){
				$opt_users[] = "Select";
				foreach($users as $row){
					$opt_users[$row->id] = $row->name;
				}
			}else{
				$opt_users[] = "Select";
			}
			
			print form_dropdown('users-changel',$opt_users,$this->input->post('users-changel'),'onchange="doSubmit(this.value)"');
			?>
        </td>
    </tr>
</table>
<? print form_close();
if($this->session->flashdata('ae_fav')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('ae_fav')."</p>";
	 print "</div>";
}
?>
<br>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
                <div class="roundedcornr_top_main_tv"><div></div></div>
                    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
                   		<table border='0' cellspacing='0' cellpadding='0' width='99%'>
                            <tr>
                                <th style="border-right:1px #FFF solid;" width="60%">Channel Name</th>
                                <th style="border-right:1px #FFF solid;" width="30%">Icon</th>
                                <th width="10%">Action</th>
                            </tr>
                        </table>
                    </div>
                <div class="roundedcornr_bottom_main_tv"><div></div></div>
            </div><br>
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
	<? if(isset($favourites) && count($favourites)>0){
		foreach($favourites as $row){
			?>
             <tr>
             	<td valign="middle" align="center" width="60%"><?=$row->name?></td>
                <td valign="middle" align="center" width="30%"><img src="<?=base_url()?>icons/TV/<?=$row->logo?>" /></td>
                <td width="10%" align="center"><a href="javascript:deleteconform('welcome/deletefavourites','<?=$_POST['users-changel']?>','<?=$row->id?>')"><img src="<?=base_url()?>images/cross.png" /></a></td>
    		</tr>
            <?
		}
	?>
    <? } ?>
</table>
<script language="javascript">
function doSubmit(val){
	document.listform.submit();
}
</script>