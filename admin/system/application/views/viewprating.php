<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="top"><h1><?php echo $title;?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?=base_url()?>index.php/welcome/addpRating" class="positive"><img src="<?=base_url()?>images/apply2.png" alt=""/>ADD PARENTAL RATING</a></div></td>
    </tr>
</table>
<?
if($this->session->flashdata('pRating_c')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('pRating_c')."</p>";
	 print "</div>";
}
else if($this->session->flashdata('pRating_u')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('pRating_u')."</p>";
	 print "</div>";
}
else if($this->session->flashdata('pRating_d')){
	print "<div id='msg'>";
     echo "<p id='ms' align='justify'>".$this->session->flashdata('pRating_d')."</p>";
	 print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
                <div class="roundedcornr_top_main_tv"><div></div></div>
                    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
                   		<table border='0' cellspacing='0' cellpadding='0' width='99%'>
                            <tr>
                                <th width="30%" style="border-right:1px #FFF solid;">Name</th>
                                <th width="25%" style="border-right:1px #FFF solid;">Level</th>
                                <th width="25%" style="border-right:1px #FFF solid;">Languages</th>
                                <th width="20%">Action</th>
                            </tr>
                        </table>
                    </div>
                <div class="roundedcornr_bottom_main_tv"><div></div></div>
            </div><br/>
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
<?
foreach($prating as $key => $value)
{
?>
<tr>
	<td align="center" width="30%"><?=$value['name']?></td>
    <td align="center" width="25%"><?=$value['level']?></td>
    <td align="center" width="25%"><? print $this->PRating->language($value['language'])?></td>
    <td align="center" width="20%">
    	<a href="<?=base_url()?>index.php/welcome/editprating/<?=$value['id']?>"><img src="<?=base_url()?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;
		<a href="javascript:deleteconform('welcome/deleteprating','<?=$value['id']?>','')"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
    </td>
</tr>
<?
}
?>
</table>
<div id="page" align="center"><?=$pageination;?></div>