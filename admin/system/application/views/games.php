<?
if($this->session->flashdata('game_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('game_c')."</p>";
	 print "</div>";
}
if($this->session->flashdata('game_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('game_u')."</p>";
	 print "</div>";
}
if($this->session->flashdata('game_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('game_d')."</p>";
	 print "</div>";
}
if($this->session->flashdata('ga_img')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('ga_img')."</p>";
	 print "</div>";
}
?>
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
<tr>
<th>Itemid</th>
<th>Name</th>
<th>Description</th>
<th>Icon</th>
<th>Path</th>
<th>Year</th>
<!--<th>DateAdded</th>-->
<th>Actions</th>
</tr>
<?php
foreach($games as $key => $value)
	{
?>
	<tr>
    	<td valign="top" align="center"><?=$value['id']?></td>
        <td valign="top" align="center"><?=$value['name']?></td>
        <td valign="top" align="center"><?=$value['description']?></td>
        <td valign="top" align="center"><img  width="50" src="<?=base_url();?>uploads/games/<?=$value['icon'];?>"/></td>
        <td valign="top" align="center"><?=$value['path']?></td>
        <td valign="top" align="center"><?=$value['year']?></td>
      	<!--<td valign="top" align="center"><?=$value['add_date']?></td>-->
        <td valign="top" align="center"><?= anchor('welcome/game_edit/'.$value['id'],'edit')?> / <?= anchor('welcome/game_delete/'.$value['id'],'delete')?></td>	
	</tr>
<?
} 
?>
<tr>
<td colspan="9"><?=anchor("welcome/addgame","Add Game")?></td>
</tr>
</table>
<div id="page"><?=$pageination;?></div>