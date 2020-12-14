<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="middle"><?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?><div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/promotions/add_ticker_promo" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD PROMOTIONS</a></div></td>
    </tr>
</table>
<?php
if ($this->session->flashdata('promotion_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('promotion_message') . "</p>";
    print "</div>";
}
?>
<table border='0' cellspacing='0' cellpadding='0' width='99%' class="table table-bordered table-hover">
    <thead>
        <tr class="success">
          <th width="25%" style="border-right:1px #FFF solid;">Restaurant</th>
          <th width="25%" style="border-right:1px #FFF solid;">Promotion Text</th>
          <th width="10%">Actions</th>
       </tr>
    </thead>
<tbody>
    <?php
    $options = $this->config->item('ticker_promo_menu');
    if (count($ticker_promos) > 0) {
        foreach ($ticker_promos as $value) {
            foreach ($options as $key => $val) {
                if($value->restaurant_id == $key){
                    $value->restaurant_id = $val;
                }
            }
            ?>
            <tr>
                <td valign="middle" align="center" width="25%"><?= $value->restaurant_id; ?></td>
                <td valign="middle" align="center" width="25%"><?= $value->ticker_promo_txt; ?></td>
                <td width="10%" valign="middle" align="center">
                    <a href="<?= base_url() ?>index.php/promotions/edit_ticker_promo/<?= $value->ticker_promo_id ?>"><img src="<?= base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('promotions/delete_ticker_promo','<?= $value->ticker_promo_id ?>','')"><img src="<?= base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td valign="middle" align="center" colspan="4">No Data Found</td>
        </tr>
        <?php
    }
    ?>
    <?php
    /**
      if (count($promotions) > 0) {
      foreach ($promotions as $key => $value) {
      ?>
      <tr>
      <td valign="middle" align="center" width="25%"><?= $value->pr_type ?></td>
      <td valign="middle" align="center" width="25%"><?= $value->pr_type == "image" ? '<img width="80" src="' . $this->config->item('promotion_icon_url') . $value->pr_url . '"/>' : '-' ?></td>
      <td valign="middle" align="center" width="20%"><?= $value->pr_type == "video" ? $value->pr_url : '-' ?></td>
      <td valign="middle" align="center" width="20%"><?= $value->pr_duration . ' Milliseconds' ?></td>
      <td width="10%" valign="middle" align="center">
      <a href="<?= base_url() ?>index.php/promotions/edit/<?= $value->pr_id ?>"><img src="<?= base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('promotions/delete','<?= $value->pr_id ?>','')"><img src="<?= base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
      </td>
      </tr>
      <?php
      }
      } else {
      ?>
      <tr>
      <td valign="middle" align="center" colspan="4">No Data Found</td>
      </tr>
      <?php
      }
     * * */
    ?>
    </tbody>
</table>
<div id="page" align="center"><?= $pagination; ?></div>