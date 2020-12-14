<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle">
            <a href="<?= base_url() ?>index.php/backend/addbackground" class="btn btn-success" role="button">
                <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD BACKGROUND
            </a>
        </td>
    </tr>
</table>
<?php
if ($this->session->flashdata('settings_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('settings_message') . "</p>";
    print "</div>";
}
?>
<div class="table_glob">
    <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='3' width='99%'>
        <thead>
            <tr class="success">
                <th width="27%">Background Image</th>
                <th width="15%">Location</th>
                <th width="20%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($result) > 0) {
                foreach ($result as $item) {
                    ?>
            <tr class="active">
                        <td>
                            <img src="<?= $this->config->item('bgs_img_url') ?>/<?= $item->background_image ?>" width="100"/>
                        </td>
                        <td>
                            <?= $item->background_module ?>
                        </td>
                        <td>
                            <a href="<?= base_url() ?>index.php/backend/editbackground/<?= $item->background_id ?>">
                               <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>&nbsp;|&nbsp;
                            <a href="javascript:deleteconform('backend/deletebackground','<?= $item->background_id ?>','')">
                                <span class="glyphicon glyphicon-remove-sign"></span> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3" align="center">No Data Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div id="page" align="center"><?= $pagination; ?></div>