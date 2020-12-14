<?
if($this->session->flashdata('song_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('song_c')."</p>";
	 print "</div>";
}
if($this->session->flashdata('song_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('song_u')."</p>";
	 print "</div>";
}
if($this->session->flashdata('song_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('song_d')."</p>";
	 print "</div>";
}
if($this->session->flashdata('song_img')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('song_img')."</p>";
	 print "</div>";
}
?>
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Artist</th>
<th>Genre</th>
<th>Album</th>
<th>Icon</th>
<th>Path</th>
<th>Description</th>
<th>Actions</th>
</tr>
<?php
foreach($song as $key => $value)
	{
?>
	<tr>
    	<td valign="top" align="center"><?=$value['id']?></td>
        <td valign="top" align="center"><?=$value['name']?></td>
        <td valign="top" align="center"><?=$value['a_name']?></td>
        <td valign="top" align="center"><?=$value['g_name']?></td>
        <td valign="top" align="center"><?=$value['al_name']?></td>
        <td valign="top" align="center"><img  width="50" src="<?=base_url();?>uploads/song/<?=$value['icon'];?>"/></td>
        <td valign="top" align="center"><?=$value['path']?></td>
        <td valign="top" align="center"><?=$value['description']?></td>
        <td valign="top" align="center"><?= anchor('welcome/song_edit/'.$value['id'].'/'.$value['artistid'].'/'.$value['genreid'].'/'.$value['albumid'],'edit')?> / <?= anchor('welcome/song_delete/'.$value['id'],'delete')?></td>	
	</tr>
<?
} 
?>
<tr>
<td colspan="9"><?=anchor("welcome/addsong","Add Song")?></td>
</tr>
</table>
<div id="page"><?=$pageination;?></div>