<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1></td>
        
        <td align="right" valign="middle"><div class="buttons" style="float:right; margin-top:0px;">
            <a href="<?=base_url()?>index.php/welcome/addtv" class="btn btn-success">
                <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD TV
            </a>
        </div>
    </td>
    </tr>
</table>
<?
//echo $this->uri->segment(3, 0);
if($this->session->flashdata('tv_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('tv_c')."</p>";
	 print "</div>";
}
if($this->session->flashdata('tv_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('tv_u')."</p>";
	 print "</div>";
}
if($this->session->flashdata('tv_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('tv_d')."</p>";
	 print "</div>";
}
if($this->session->flashdata('tv_img')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('tv_img')."</p>";
	 print "</div>";
}
?>
<table border='0' cellspacing='0' cellpadding='0' width='99%' class="table table-bordered table-hover">
    <thead>
        <tr class="success">
            <th width="30%" style="border-right:1px #FFF solid;">Channel Name</th>
            <th width="20%" style="border-right:1px #FFF solid;">Channel Number</th>
            <th width="20%" style="border-right:1px #FFF solid;">Path</th>
            <th style="border-right:1px #FFF solid;">Icon</th>
            <th width="15%">Actions</th>
        </tr>
    </thead>
    <tbody>
<?php
if(count($tv)>0){
foreach($tv as $key => $value)
{
?>
	<tr id="tv_row">
    	<td valign="middle" align="center" width="30%"><?=$value->name?></td>
        <td valign="middle" align="center" width="20%"><?=$value->number?></td>
        <td valign="middle" align="center" width="20%"><?=$value->mrl?></td>
        <?
		$file = basename($value->logo);
		/**
        if($value['logo']!="")
		{
		//print $value['logo'];
			$icon_split=explode("\\",$value['logo']);
		//print_r($icon_split);
		
		
		}
		**/
		?>
        <td valign="middle" align="center"><img  width="80" height="50" src="<?=$this->config->item('tv_icon_url')?><? if($file){ print $file;}?>"/></td>
        <td valign="middle" align="center" width="15%">
		<a href="<?=base_url()?>index.php/welcome/tv_edit/<?=$value->id?>"><img src="<?=base_url()?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('welcome/deletetv','<?=$value->id?>')"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>&nbsp;<a href="<?=base_url()?>index.php/welcome/addfavourites/<?=$value->id?>"><img src="<?=base_url()?>images/favourites.png" width="18" height="18" border="0" title="Add To Favourites"/></a></td>	
	</tr>
<? }
}else{ ?>
	<tr>
    	<td align="center" colspan="5" width="99%">No Data Found</td>
    </tr>
<?
}
?>
    </tbody>
</table>
<div id="page" align="center"><?=$pagination;?></div>