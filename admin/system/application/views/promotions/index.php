<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="top"><?=$this->TVclass->language_dp('language',$this->session->userdata($session_keyword),"onChange='language_change(this.value,\"$session_keyword\")'")?><div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/promotions/add" class="positive"><img src="<?= base_url() ?>images/apply2.png" alt=""/>ADD PROMOTIONS</a></div></td>
    </tr>
</table>
<?
if ($this->session->flashdata('promotion_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('promotion_message') . "</p>";
    print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
    <div class="roundedcornr_top_main_tv"><div></div></div>
    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
        <table border='0' cellspacing='0' cellpadding='0' width='99%'>
            <tr>
                <th width="25%" style="border-right:1px #FFF solid;">Type</th>
                <th width="25%" style="border-right:1px #FFF solid;">Icon</th>
                <th width="20%" style="border-right:1px #FFF solid;">URL</th>
                <th width="20%" style="border-right:1px #FFF solid;">Duration</th>
                <th width="10%">Actions</th>
            </tr>
        </table>
    </div>
    <div class="roundedcornr_bottom_main_tv"><div></div></div>
</div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
 <?
    if (count($promotions) > 0) {
        foreach ($promotions as $key => $value) {?>
            <tr>
                <td valign="middle" align="center" width="25%"><?=$value->pr_type ?></td>
                <td valign="middle" align="center" width="25%"><?=$value->pr_type=="image" ? '<img width="80" src="'.$this->config->item('promotion_icon_url').$value->pr_url.'"/>' : '-'?></td>
                <td valign="middle" align="center" width="20%"><?=$value->pr_type=="video" ? $value->pr_url : '-'?></td>
                <td valign="middle" align="center" width="20%"><?=$value->pr_duration.' Milliseconds'?></td>
                <td width="10%" valign="middle" align="center">
                	<a href="<?= base_url() ?>index.php/promotions/edit/<?=$value->pr_id ?>"><img src="<?=base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('promotions/delete','<?=$value->pr_id ?>','')"><img src="<?=base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
                </td>
            </tr>
       <?
		}
	}else{
	   ?>
        <tr>
                <td valign="middle" align="center" colspan="4">No Data Found</td>
        </tr>
       <?
		}
	   ?>
</table>
<div id="page" align="center"><?=$pagination; ?></div>