<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left">
            <h1 class="page_title"><?php echo $title; ?>
            </h1>
        </td>
        <td align="right">
            <?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?>
            <div class="buttons" style="float:right; margin-top:0px;">
                <a href="<?= base_url() ?>index.php/backend/add_television_brands" class="btn btn-success" role="button">
                    <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD TV BRANDS
                </a>
            </div>
        </td>
    </tr>
</table>
<? if ($this->session->flashdata('localinfo_message')) {
print "<div id='msg'>";
echo "<p id='ms' align='justify'>" . $this->session->flashdata('tickertape_message') . "</p>";
print "</div>";
}
?>

<div class="table_glob">
    <table border='0' cellspacing='0' cellpadding='3' width='99%' class="table table-bordered table-hover">
        <thead>
            <tr class="success">
                <th width="35%" style="border-right:1px #FFF solid;">Brand Name</th>
                <th width="35%" style="border-right:1px #FFF solid;">Brand Folder</th>
                <th width="30%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($tvbrands) > 0) {
                foreach ($tvbrands as $tvbrand) {
                    //var_dump($tvbrand);
                    ?>
                    <tr class="active">
                        <td ><?= $tvbrand->brnd_name; ?></td>
                        <td><?= $tvbrand->brnd_folder; ?></td>
                        <td>
                            <a href="<?= base_url() ?>index.php/backend/edit_television_brands/<?= $tvbrand->id ?>">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>&nbsp;|&nbsp;
                            <a href="javascript:deleteconform('backend/delete_television_brands','<?= $tvbrand->id ?>','')">
                                <span class="glyphicon glyphicon-remove-sign"></span> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" width="35%" align="center">No Data Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div id="page" align="center"><?= $pagination; ?></div>