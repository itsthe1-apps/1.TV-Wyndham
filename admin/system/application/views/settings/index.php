<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="top"><!--<div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/backend/addsettings" class="positive"><img src="<?= base_url() ?>images/apply2.png" alt=""/>ADD SETTINGS</a></div>--></td>
    </tr>
</table>
<?php
if ($this->session->flashdata('settings_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('settings_message') . "</p>";
    print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
    <div class="roundedcornr_top_main_tv"><div></div></div>
    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
        <table border='0' cellspacing='0' cellpadding='0' width='99%'>
            <tr>
                <th width="37%" style="border-right:1px #FFF solid;">Logo Image</th>
                <th width="15%" style="border-right:1px #FFF solid;">Theme</th>
                <th width="14%">Actions</th>
            </tr>
        </table>
    </div>
    <div class="roundedcornr_bottom_main_tv"><div></div></div>
</div><br />

<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
    <?php
    if (count($radio) > 0) {
        foreach ($radio as $value) {
            ?>
            <tr>
                <td valign="middle" align="center" width="35%"><img src="<?= $this->config->item('logo_icon_url') ?>/<?= $value->se_logo ?>"/></td>
                <td valign="middle" align="center" width="15%"><?= $value->th_name ?></td>
                <td valign="middle" align="center" width="14%">
                    <a href="<?= base_url() ?>index.php/backend/editsettings/<?= $value->se_id ?>"><img src="<?= base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('backend/deletesettings','<?= $value->se_id ?>','')"><img src="<?= base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="2" align="left">No Data Found</td>
        </tr>
    <?php } ?>
</table>
<div id="page" align="center"><?= $pagination; ?></div>