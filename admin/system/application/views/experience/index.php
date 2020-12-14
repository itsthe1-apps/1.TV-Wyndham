<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="middle"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle">
                    <div class="main_control_btns" class="buttons" style="float:right; margin-top:0px;" > 
                        <?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?>
                        <a href="<?= base_url() ?>index.php/experience/add_experience" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Attraction</a>
                    </div>
                </td>
            </tr>
        </table>
        <?php
        if ($this->session->flashdata('promotion_message')) {
            print "<div id='msg'>";
            echo "<p id='ms' align='justify'>" . $this->session->flashdata('promotion_message') . "</p>";
            print "</div>";
        }
        ?>
        <div class="roundedcornr_box_main_tv" style="width:99%;">
            <div class="roundedcornr_content_main_tv">
                <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='0' width='99%'>
                    <thead>
                        <tr class="success">
                            <th>Attraction Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($experience_details) > 0) {
                            foreach ($experience_details as $key => $value) {?>
                                <tr>
                                    <td valign="middle" ><?=$value->experience_type ?></td>            
                                    <td valign="middle" width="50%"><?=$value->description ?></td> 
                                    <?php
                                    $image_names = explode("|", $value->experience_img_url);
                                    $html_img = '';
                                    foreach ($image_names as $img) {
                                        $html_img .= "<img style='margin-bottom:5px;' width='100' src='" . $this->config->item('exp_icon_url') . $img . "'>" . "&nbsp;&nbsp;";
                                    }
                                    ?>
                                    <td valign="middle" align="center"><?= $value->experience_img_url == "image" ? '-' : $html_img ?></td>
                                    <td width="15%" valign="middle" align="center">
                                        <a href="<?= base_url() ?>index.php/experience/edit_experience/<?=$value->experience_id ?>">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>&nbsp; | &nbsp;
                                        <a href="javascript:deleteconform('experience/delete','<?=$value->experience_id ?>','')">
                                            <span class="glyphicon glyphicon-remove-sign"></span> Delete
                                        </a>&nbsp;
                                    </td>
                                </tr>
                           <?php
                            }
                        }else{
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