<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle">
                    <div class="buttons" style="float:right; margin-top:0px;">
                        <a href="<?= base_url() ?>index.php/backend/adddevtypes" class="btn btn-success main_control_btns" role="button"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD DEVICE TYPE</a>
                    </div>
                </td>
            </tr>
        </table>
        <div class="table_glob">
            <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
                <thead>
                    <tr class="success">
                        <th width="20%">Description</th>
                        <th width="40%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    if(count($devicetypes)>0){
                    foreach($devicetypes as $row){
                    ?>
                    <tr class="active">
                        <td><?php echo "(". $count.")   ".$row->device_type ?>&nbsp;</td>
                        <td>
                            <a class="btn btn-success" role="button" href="<?= base_url() ?>index.php/backend/editdevtypes/<?= $row->id ?>">
                                Edit Device Type
                            </a>&nbsp;
                            <a class="btn btn-danger" href="javascript:deleteconform('backend/deletedevtypes','<?= $row->id ?>','')">
                                Delete Device Type
                            </a>&nbsp;
                        </td>
                    </tr>
                    <?php 
                    $count++;
                    }}else{?>
                    <tr>
                        <td align="center" colspan="3">No Data Found</td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <p align="center"><?= $pagination ?></p>
    </body>
</html>