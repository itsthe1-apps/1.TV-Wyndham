<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle">
                    <div class="main_control_btns" class="buttons" style="float:right; margin-top:0px;" >  
                        <a href="<?= base_url() ?>index.php/backend/addroomtypes" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Room Type</a>
                    </div>
                </td>

            </tr>
        </table>
        <hr/>
        <div class="table_glob">
            <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='3' width='99%'>
                <thead>
                    <tr class="success">
                        <th width="40%" style="border-right:1px #FFF solid;">Description</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    if(count($roomtypes)>0){
                    foreach($roomtypes as $row){
                    ?>
                    <tr class="active">
                        <td><?= $row->rt_type ?>&nbsp;</td>
                        <td>
                            <a href="<?= base_url() ?>index.php/backend/editroomtypes/<?= $row->rt_id ?>">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>&nbsp;|&nbsp;
                            <a href="javascript:deleteconform('backend/deleteroomtypes','<?= $row->rt_id ?>','')">
                                <span class="glyphicon glyphicon-remove-sign"></span> Delete
                            </a>&nbsp;
                        </td>
                    </tr>
                    <? }}else{?>
                    <tr>
                        <td align="center" colspan="3">No Data Found</td>
                    </tr>
                    <? }?>
                </tbody>
            </table>
        </div>
        <p align="center"><?= $pagination ?></p>
    </body>
</html>