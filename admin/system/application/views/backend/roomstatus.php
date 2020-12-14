<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="middle"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle"></td>
            </tr>
        </table>
        <div class="roundedcornr_box_main_tv" style="width:99%;">
            <div class="roundedcornr_content_main_tv">
                <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='0' width='99%'>
                    <thead>
                        <tr class="success">
                            <th>Room Number</th>
                            <th><?= $column1 ?></th>
                            <th><?= $column2 ?></th>
                            <th><?= $column3 ?></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($subscribers) > 0) {
                            foreach ($subscribers as $row) {
                                ?>
                                <tr>
                                    <td align="left" width="10%"><?= $row->room_id ?>&nbsp;</td>
                                    <td align="left" width="10%"><?= $row->status ?>&nbsp;</td>
                                    <td align="left" width="10%"><?= $row->dt ?></td>
                                    <td align="left" width="10%"><?= $row->user ?></td>
                                    <td align="left" width="10%">
                                        <a href="<?= base_url() ?>index.php/room/editroom/<?= $row->room_id ?>">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>&nbsp; | &nbsp;
                                        <a href="javascript:deleteconform('room/filter/<?= $flag ?>','<?= $row->room_id ?>','')">
                                            <span class="glyphicon glyphicon-remove-sign"></span> Delete
                                        </a>&nbsp;
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="12">No Data Found</td>
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