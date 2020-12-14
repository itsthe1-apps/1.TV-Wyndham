<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle"><?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?>
            <div class="buttons" style="float:right; margin-top:0px;">
                <a href="<?= base_url() ?>index.php/newsnpromo/add" class="btn btn-success" role="button">
                    <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD LOCAL INFO
                </a>
            </div>
        </td>
    </tr>
</table>
<?php
if ($this->session->flashdata('newsnpromo_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('newsnpromo_message') . "</p>";
    print "</div>";
}
?>
<table border='0' cellspacing='0' cellpadding='3' width='99%' class="table table-bordered table-hover">
    <thead>
        <tr class="success">
            <th width="25%" style="border-right:1px #FFF solid;">Image</th>
            <th width="30%" style="border-right:1px #FFF solid;">Name</th>
            <th width="30%" style="border-right:1px #FFF solid;">Description</th>
            <th width="14%">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (count($newsnpromo) > 0) {
        foreach ($newsnpromo as $value) {
            ?>
        <tr class="active">
                <td valign="middle" align="center" width="25%"><img src="<?= $this->config->item('newsnpromo_icon_url') . $value->image ?>" title="<?= $value->name ?>" width="100" height="80"/></td>
                <td valign="middle" align="center" width="29%"><?= $value->name ?></td>
                <td valign="middle" align="center" width="30%">
                    <?php
                    $text = $value->description;
                    $text = html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');
                    $length = 100;
                    if (strlen($text) > $length) {
                        $text = substr($text, 0, strpos($text, ' ', $length));
                    }
                    echo $text . '....';
                    ?></td>
                <td valign="middle" align="center" width="14%">
                    <a href="<?= base_url() ?>index.php/newsnpromo/edit/<?= $value->id ?>">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>&nbsp;|&nbsp;
                    <a href="javascript:deleteconform('newsnpromo/delete','<?= $value->id ?>','')">
                        <span class="glyphicon glyphicon-remove-sign"></span> Delete
                    </a>&nbsp;
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="4" align="center">No Data Found</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div id="page" align="center"><?= $pagination; ?></div>