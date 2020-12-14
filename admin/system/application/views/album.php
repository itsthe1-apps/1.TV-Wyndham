<?
if($this->session->flashdata('alb_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('alb_c')."</p>";
	 print "</div>";
}
if($this->session->flashdata('alb_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('alb_u')."</p>";
	 print "</div>";
}
if($this->session->flashdata('alb_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('alb_d')."</p>";
	 print "</div>";
}
?>
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Artist</th>
<th>Genre</th>
<th>Description</th>
<th>Actions</th>
</tr>
<?php
foreach($alb as $key => $value)
	{
?>
	<tr>
    	<td valign="top" align="center"><?=$value['al_id']?></td>
        <td valign="top" align="center"><?=$value['al_name']?></td>
        <td valign="top" align="center"><?=$value['a_name']?></td>
        <td valign="top" align="center"><?=$value['g_name']?></td>
        <td valign="top" align="center"><?=$value['al_description']?></td>
        <td valign="top" align="center"><?= anchor('welcome/alb_edit/'.$value['al_id'].'/'.$value['al_artistid'].'/'.$value['al_genreid'],'edit')?> / <?= anchor('welcome/alb_delete/'.$value['al_id'],'delete')?></td>	
	</tr>
<?
} 
?>
<tr>
<td colspan="9"><?=anchor("welcome/addalbum","Add Album")?></td>
</tr>
</table>
<div id="page"><?=$pageination;?></div>