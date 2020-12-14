<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle"><?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?>
            <div class="buttons" style="float:right; margin-top:0px;">
                <a href="<?= base_url() ?>index.php/backend/addtickertape" class="btn btn-success" role="button">
                    <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD TICKER TAPE</a>
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
                <th width="25%">Ticker Tape URL</th>
                <th width="30%">Language</th>
                <th width="24%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <? if (count($tickertape) > 0) {
            foreach ($tickertape as $value){
            ?>
            <tr class="active">
                <td valign="middle"><?= $value->tickertape_url ?></td>
                <td valign="middle"><?= $value->language ?></td>
                <td valign="middle">
                    <a href="<?= base_url() ?>index.php/backend/edittickertape/<?= $value->id ?>">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>&nbsp;|&nbsp;
                    <a href="javascript:deleteconform('backend/deletetickertape','<?= $value->id ?>','')">
                        <span class="glyphicon glyphicon-remove-sign"></span> Delete
                    </a>
                </td>
            </tr>
            <? 	}
            }else{?>
            <tr>
                <td colspan="3" align="center">No Data Found</td>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<div id="page" align="center"><?= $pagination; ?></div>