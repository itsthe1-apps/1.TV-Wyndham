<?php //Edit by Yesh         ?>
<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle">
                    <a href="<?= base_url() ?>index.php/backend/add_exitmsg" class="btn btn-success" role="button">
                        <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD EXIT MESSAGE
                    </a>
                </td>
            </tr>
        </table>
        <div class="table_glob">
            <table border='0' cellspacing='0' cellpadding='3' width='99%' class="table table-bordered table-hover">
            <thead>
                <tr class="success">
                    <th width="20%" >Emergency Message</th>
                    <th width="20%">RTSP</th>
                    <th width="20%" >Status</th>
                    <th width="20%">Image</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (count($exitmsg) > 0) {
                foreach ($exitmsg as $row) {
                    ?>
                <tr class="active">
                        <td ><?= $row->message ?></td>
                        <td ><?= $row->rtsp ?></td>
                        <td >
                            <?php
                            $status = $this->config->item('status');
                            if (is_array($status) && isset($status[$row->status])) {
                                print $status[$row->status];
                            } else {
                                print '-';
                            }
                            ?>
                        </td>
                        <td >
                            <img src="<?= $this->config->item('exit_icon_url') . $row->image_path ?>"  width="100" height="80"/>
                        </td>
                        <td>
                            <a href="<?= base_url() ?>index.php/backend/edit_exitmsg/<?= $row->id ?>">
                                 <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>&nbsp;|&nbsp;
                            <a href="javascript:deleteconform('backend/delete_exitmsg','<?= $row->id ?>','')">
                                <span class="glyphicon glyphicon-remove-sign"></span> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td align="center" colspan="3">No Data Found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <p align="center"><?= $pagination ?></p>
    </body>
</html>