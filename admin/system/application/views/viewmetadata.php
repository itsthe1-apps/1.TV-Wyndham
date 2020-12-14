<h1><?php echo $title;?></h1>
<?
if($this->session->flashdata('metadata_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('metadata_c')."</p>";
	 print "</div>";
}
else if($this->session->flashdata('metadata_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('metadata_u')."</p>";
	 print "</div>";
}
else if($this->session->flashdata('metadata_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('metadata_d')."</p>";
	 print "</div>";
}
?>
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
<tr>
	<th>Director</th>
    <th>Cast</th>
    <th>Languages</th>
    <th>Action</th>
</tr>
<?
foreach($metadata as $key => $value)
{
?>
<tr>
	<td align="center"><?=$value['director']?></td>
    <td align="center"><?=$value['cast']?></td>
    <td align="center"><? print $this->Metadata->language($value['languages']);?></td>
    <td align="center"><?=anchor('welcome/editmetadata/'.$value['id'],'edit')?>&nbsp;/&nbsp;<?=anchor('welcome/deletemetadata/'.$value['id'],'delete')?></td>
</tr>
<?
}
?>
<tr>
	<td colspan="4"><?=anchor("welcome/addMetada","Add Metadata")?></td>
</tr>
</table>