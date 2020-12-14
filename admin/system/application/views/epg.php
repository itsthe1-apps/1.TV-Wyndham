<h1><?php echo $title;?></h1>
<?
if($this->session->flashdata('epg_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('epg_c')."</p>";
	 print "</div>";
}
if($this->session->flashdata('epg_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('epg_u')."</p>";
	 print "</div>";
}
if($this->session->flashdata('epg_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('epg_d')."</p>";
	 print "</div>";
}
?>
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
<tr>
<th width="12%">Channelname</th>
<th width="25%">Path</th>
<th width="14%">Actions</th>
</tr>
<?php
foreach($epg as $key => $value)
	{
?>
	<tr>
    	<td valign="top" align="center"><?=$value['name']?></td>
        <td valign="top" align="center"><?=$value['path']?></td>
        <td valign="top" align="center"><?= anchor('welcome/editepg/'.$value['id'].'/'.$value['channel'],'edit')?> / <?= anchor('welcome/deleteepg/'.$value['id'],'delete')?></td>	
	</tr>
<?
} 
?>
<tr>
<td colspan="3"><?=anchor("welcome/addepg","Add Epg")?></td>
</tr>
</table>
<div id="page"><?=$pageination;?></div>