<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="top">
                    <h1 class="page_title"><?php echo $title; ?></h1>
                </td>
                <td align="right" valign="middle"><div class="buttons" style="float:right; margin-top:0px;">
                        <a href="<?= base_url() ?>index.php/backend/addroomgroups" class="btn btn-success" role="button">
                            <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD ROOM GROUP
                        </a>
                    </div>
                </td>
            </tr>
        </table>

        <div class="table_glob">
            <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='3' width='99%'>
                <thead>
                    <tr class="success">
                        <th width="50%">Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?
                if(count($roomgroups)>0){
                foreach($roomgroups as $row){
                ?>
                <tr class="active">
                    <td><?= $row->rg_name ?>&nbsp;</td>
                    <td>
                        <a href="<?= base_url() ?>index.php/backend/editroomgroups/<?= $row->rg_id ?>">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </a>&nbsp;|&nbsp;
                        <a href="javascript:deleteconform('backend/deleteroomgroups','<?= $row->rg_id ?>','')">
                            <span class="glyphicon glyphicon-remove-sign"></span> Delete
                        </a>&nbsp;
                    </td>
                </tr>
                <? }}else{?>
                <tr>
                    <td align="center" colspan="2">No Data Found</td>
                </tr>
                <? }?>
            </table>
        </div>
        <p align="center"><?= $pagination ?></p>
    </body>
</html>