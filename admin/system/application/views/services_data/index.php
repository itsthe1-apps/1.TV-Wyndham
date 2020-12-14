<html>
<body>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="middle"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle">
            <div class="main_control_btns" class="buttons" style="float:right; margin-top:0px;" >
                <?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?>
                <a href="<?= base_url() ?>index.php/services_data/add_service_data" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Service</a>
            </div>
        </td>
    </tr>
</table>
<div class="roundedcornr_box_main_tv" style="width:99%;">
    <div class="roundedcornr_content_main_tv">
        <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='0' width='99%'>
            <thead>
            <tr class="success">
                <th>Type</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (count($services_data_details) > 0) {
                foreach ($services_data_details as $key => $value) {
                    ?>
                    <tr>
                        <td valign="left" ><?= $value->service_type ?></td>
                        <td valign="left" ><?= $value->description ?></td>
                        <?php
                        $image_names = explode("|", $value->service_img_url);
                        $html_img = '';
                        foreach ($image_names as $img) {
                            $html_img .= "<img  width='100'style='margin-bottom:5px;' src='" . $this->config->item('spa_icon_url') . $img . "'>" . "&nbsp;&nbsp;";
                        }
                        ?>
                        <td valign="left"><?= $value->service_img_url == "image" ? '-' : $html_img ?></td>
                        <td width="10%" valign="left" align="center">
                            <a href="<?= base_url() ?>index.php/spa/edit_spa/<?= $value->services_data_id ?>">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>&nbsp; | &nbsp;
                            <a href="javascript:deleteconform('spa/delete','<?= $value->services_data_id ?>','')">
                                <span class="glyphicon glyphicon-remove-sign"></span> Delete
                            </a>&nbsp;
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
            </tbody>
        </table>
    </div>
    <!--<div class="roundedcornr_bottom_main_tv"><div></div></div> comented by Lakshan-->
</div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form"></table>
<p align="center"><?= $pagination ?></p>
</body>
</html>