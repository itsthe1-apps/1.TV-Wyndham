<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="middle"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle">
                    <?php if ($total_devices < DEVICE_LIMIT) { 
                            $status_opt = array();
                            if (count($status_text) > 0) {
                                foreach ($status_text as $row) {
                                    $status_opt[$row->st_id] = $row->st_name;
                                }
                            }
                            print 'Status : ' . form_dropdown('status_text', $status_opt, $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")' style='display:inline;width:150px' class='language form-control select_form_option'");
                            ?>
                            <a href="<?= base_url() ?>index.php/guest/addguest" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Guest</a>
                       
                    <?php } ?>
                </td>
            </tr>
        </table>
        <div class="roundedcornr_box_main_tv" style="width:99%;">
            <div class="roundedcornr_content_main_tv">
                <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='0' width='99%'>
                    <thead>
                        <tr class="success">
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Skin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($subscribers) > 0) {
                            foreach ($subscribers as $row) {
                                ?>
                                <tr class="active">
                                    <td align="left"><?= $row->title . ' ' . $row->name ?>&nbsp;</td>
                                    <td align="left"><?= $row->surname ?>&nbsp;</td>
                                    <td align="left"><?= $row->sk_name ?>&nbsp;</td>
                                    <td align="left">
                                        <a href="<?= base_url() ?>index.php/guest/editguest/<?= $row->id ?>">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>&nbsp; | &nbsp;
                                        <a href="javascript:deleteconform('guest/deleteguest','<?= $row->id ?>','')">
                                            <span class="glyphicon glyphicon-remove-sign"></span> Delete
                                        </a>&nbsp;
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="left" colspan="12">No Data Found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--<div class="roundedcornr_bottom_main_tv"><div></div></div> comented by Lakshan--> 
        </div><br />
        <table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form"></table>
        <p align="center"><?= $pagination ?></p>
    </body>
</html>