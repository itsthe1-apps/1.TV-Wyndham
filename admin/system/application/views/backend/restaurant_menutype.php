<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/restaurants/addrestaurantmenutype" class="positive"><img src="<?= base_url() ?>images/apply2.png" alt=""/>ADD RESTAURANT MENU TYPE</a></div></td>
    </tr>
</table>
<?
if ($this->session->flashdata('rmt_m')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('rmt_m') . "</p>";
    print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
    <div class="roundedcornr_top_main_tv"><div></div></div>
    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
        <table border='0' cellspacing='0' cellpadding='0' width='99%'>
            <tr>
                <th width="35%" style="border-right:1px #FFF solid;">Name</th>
                <th width="16%" style="border-right:1px #FFF solid;">Code</th>
                <th width="14%">Actions</th>
            </tr>
        </table>
    </div>
    <div class="roundedcornr_bottom_main_tv"><div></div></div>
</div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
       <?
    if (count($rest_menutype) > 0) {
        foreach ($rest_menutype as $key => $value) {
            ?>
            <tr>
                <td valign="middle" align="center" width="35%"><?=$value->name ?> (<a href="<?=base_url()?>index.php/restaurants/otherlanguage/<?=$value->id?>">Other Languages</a>)</td>
                <td valign="middle" align="center" width="16%"><?=$value->code ?></td>
                <td valign="middle" align="center" width="14%">
                	<a href="<?= base_url() ?>index.php/restaurants/editrestaurantmenutype/<?=$value->id ?>"><img src="<?=base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('restaurants/deletrestaurantmenutype','<?=$value->id ?>','')"><img src="<?=base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
                </td>
            </tr>
       <?
		}
	}else{
	   ?>
        <tr>
                <td valign="middle" align="center" colspan="2">No Data Found</td>
        </tr>
       <?
		}
	   ?>
</table>
<div id="page" align="center"><? $pagination; ?></div>