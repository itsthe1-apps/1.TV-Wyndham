<html>
    <body>

        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle">
                    <?php if (count($rooms) < ALLOWED_ROOMS) { ?>
                        <div class="buttons" style="float:right; margin-top:0px;">
                            <a href="<?= base_url() ?>index.php/backend/addrooms" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD ROOM</a>
                        </div>
                    <?php } ?>
                    &nbsp;
                </td>
            </tr>
        </table>
        <?php
        $pop_atts = array(
            'width' => '800',
            'height' => '600',
            'scrollbars' => 'yes',
            'status' => 'yes',
            'resizable' => 'yes',
            'screenx' => '0',
            'screeny' => '0'
        );
        ?>
        
        <div class="table_glob">
            <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
                <thead>
                    <tr class="success">
                        <th width="10%">Room Number</th>
                        <th width="10%">Room Type</th>
                        <th width="10%">Devices</th>
                        <th width="10%">Floor Map</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($rooms) > 0) {
                        foreach ($rooms as $row) {
                            ?>
                            <tr class="active">
                                <td width="10%"><?= $row->room_number ?>&nbsp;</td>
                                <td width="10%"><?= $row->rt_type ?>&nbsp;</td>
                                <td width="10%"><?= anchor_popup('backend/roomdevice/' . $row->id, 'Devices', $pop_atts); ?></td>
                                <td width="10%"><?php //Edit by Yesh              ?>
                                    <?php if ($row->emergency_img == NULL) { ?>
                                        No Floor Map <?//print text as no floor map ?>
                                    <?php } else { ?>
                                        <a href="<?= $this->config->item('room_path_url') . $row->emergency_img; ?>" target="_blank">
                                            <img src="<?= $this->config->item('room_path_url') . $row->emergency_img; ?>" width="30%"/>
                                            <br>View Floor Map
                                        </a>
                                    <?php } ?>
                                </td>
                                <td width="10%">
                                    <a href="<?= base_url() ?>index.php/backend/editrooms/<?= $row->id ?>">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>&nbsp; | &nbsp;
                                    <a href="javascript:deleteconform('backend/deleterooms','<?= $row->id ?>','')">
                                        <span class="glyphicon glyphicon-remove-sign"></span> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td align="center" colspan="11">No Data Found</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

        <p align="center"><?= $pagination ?></p>
    </body>
</html>