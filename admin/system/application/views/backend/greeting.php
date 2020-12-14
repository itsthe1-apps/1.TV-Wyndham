<html>
    <body>
        <table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
            <tr>
                <td align="left" valign="middle"><h1 class="page_title"><?php echo $title; ?></h1></td>
                <td align="right" valign="middle">
                    <div class="main_control_btns" class="buttons" style="float:right; margin-top:0px;" > 
                        <a href="<?= base_url() ?>index.php/guest/addgreeting" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add GREETING</a>
                    </div>
                </td>
            </tr>
        </table>
        <div class="roundedcornr_box_main_tv" style="width:99%;">
            <div class="roundedcornr_content_main_tv">
                <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='0' width='99%'>
                    <thead>
                        <tr class="success">
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(count($greeting)>0){
                            foreach($greeting as $row){
                        ?>
                        <tr>
                            <td align="left" width="50%"><?=$row->title?> (<a href="<?=base_url()?>index.php/guest/otherlanguage/<?=$row->id?>">Other Languages</a>)</td>
                            <td align="left" width="50%">
                                <a href="<?= base_url() ?>index.php/guest/editgreeting/<?= $row->id ?>">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </a>&nbsp; | &nbsp;
                                <a href="javascript:deleteconform('guest/deletegreeting','<?=$row->id?>','')">
                                    <span class="glyphicon glyphicon-remove-sign"></span> Delete
                                </a>&nbsp;
                        </tr>
                        <? }}else{
                            $this->greeting->alter_table_greeting();
                            ?>
                        <tr>
                            <td align="left" colspan="12">No Data Found</td>
                        </tr>
                        <? }?>
                    </tbody>
                </table>
            </div>
        <!--<div class="roundedcornr_bottom_main_tv"><div></div></div> comented by Lakshan--> 
        </div><br />
        <table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form"></table>
        <p align="center"><?= $pagination ?></p>
    </body>
</html>