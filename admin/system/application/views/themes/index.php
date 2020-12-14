<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle">
            <a href="<?= base_url() ?>index.php/backend/addthemes" class="btn btn-success" role="button">
                <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD THEME
            </a>
        </td>
    </tr>
</table>
<? if ($this->session->flashdata('themes_message')) {
print "<div id='msg'>";
echo "<p id='ms' align='justify'>" . $this->session->flashdata('themes_message') . "</p>";
print "</div>";
}
?>

<div class="table_glob">
    <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='0' width='99%'>
        <thead>
            <tr class="success">
                <th width="35%" >Name</th>
                <th width="30%">Folder</th>
                <th width="24%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <? if (count($themes) > 0) {
            foreach ($themes as $value) {?>
            <tr class="active">
                <td><?= $value->th_name ?></td>
                <td><?= $value->th_folder ?></td>
                <td>
                    <a href="<?= base_url() ?>index.php/backend/editthemes/<?= $value->th_id ?>">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>&nbsp;|&nbsp;
                    <a href="javascript:deleteconform('backend/deletethemes','<?= $value->th_id ?>','')">
                        <span class="glyphicon glyphicon-remove-sign"></span> Delete
                    </a>
                </td>
            </tr>
            <? 	}
            }else{?>
            <tr>
                <td colspan="2" align="left">No Data Found</td>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<div id="page" align="center"><?= $pagination; ?></div>