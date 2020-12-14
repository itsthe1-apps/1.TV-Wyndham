<?
if($this->session->flashdata('res_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('res_c')."</p>";
	 print "</div>";
}
if($this->session->flashdata('res_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('res_u')."</p>";
	 print "</div>";
}
if($this->session->flashdata('res_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('res_d')."</p>";
	 print "</div>";
}
if($this->session->flashdata('res_img')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('res_img')."</p>";
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
foreach($res as $key => $value)
	{
?>
	<tr>
    	<td valign="top" align="center"><?=$value['id']?></td>
        <td valign="top" align="center"><?=$value['name']?></td>
        <td valign="top" align="center"><?=$value['description']?></td>
        <td valign="top" align="center"><?=$value['icon']?></td>
        <td valign="top" align="center">
            <img  width="50" src="<?=base_url();?>uploads/restaurent/<?=$value['icon'];?>"/>
        </td>
        <!--<td valign="top" align="center"><?=$value['add_date']?></td>-->
      	<td valign="top" align="center"><?=$value['year']?></td>
        <td valign="top" align="center"><?= anchor('welcome/res_edit/'.$value['id'],'edit')?> / <?= anchor('welcome/res_delete/'.$value['id'],'delete')?></td>	
	</tr>
<?
} 
?>
<tr>
<td colspan="9"><?=anchor("welcome/res_add","Add Restaurent")?></td>
</tr>
</table>
<div id="page"><?=$pageination;?></div>