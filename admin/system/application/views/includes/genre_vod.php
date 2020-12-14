<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?=base_url()?>index.php/welcome/addgenre" class="positive"><img src="<?=base_url()?>images/apply2.png" alt=""/>ADD GENRE</a></div></td>
    </tr>
</table>
<?
if($this->session->flashdata('gen_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('gen_c')."</p>";
	 print "</div>";
}
if($this->session->flashdata('gen_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('gen_u')."</p>";
	 print "</div>";
}
if($this->session->flashdata('gen_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('gen_d')."</p>";
	 print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
                <div class="roundedcornr_top_main_tv"><div></div></div>
                    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
                   		<table border='0' cellspacing='0' cellpadding='0' width='99%'>
                            <tr>
                                <th width="20%" style="border-right:1px #FFF solid;">ID</th>
                                <th width="60%" style="border-right:1px #FFF solid;">Name</th>
                                <th>Action</th>
                            </tr>
                        </table>
                    </div>
                <div class="roundedcornr_bottom_main_tv"><div></div></div>
            </div><br/>
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
<?php
foreach($gen as $key => $value)
	{
?>
	<tr>
    	<td valign="top" align="center" width="20%"><?=$value->id?></td>
        <td valign="top" align="center" width="60%"><?=$value->name?></td>
        <td valign="top" align="center">
			<a href="<?=base_url()?>index.php/welcome/gen_edit/<?=$value->id?>"><img src="<?=base_url()?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;
            <a href="<?=base_url()?>index.php/welcome/gen_delete/<?=$value->id?>"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
        </td>	
	</tr>
<?
} 
?>
</table>
<div id="page" align="center"><?=$pagination;?></div>
