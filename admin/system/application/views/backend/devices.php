<html>
<body>
<div id="device_status">
            <span class="messages">
                <strong>Added Devices:&nbsp;</strong><?= $total_devices ?>
            </span>
    &nbsp;&nbsp;&nbsp; [&nbsp;&nbsp; <span class="messages"><strong>Allowed Devices:</strong>
        <?= DEVICE_LIMIT ?>
        &nbsp;&nbsp;</span>]
</div>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="middle"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle">
            <? if ($total_devices < DEVICE_LIMIT) { ?>
                <div class="main_control_btns" class="buttons" style="float:right; margin-top:0px;">
                    <button id="submit_checkbox" class="btn btn-primary" type="button"><span
                            class="glyphicon glyphicon-refresh" style="padding-right:10px;"></span>Restart
                    </button>
                    <a href="<?= base_url() ?>index.php/backend/adddevice" class="btn btn-success" role="button">
                        <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Device
                    </a>
                </div>

            <? } ?>
        </td>
    </tr>
</table>
<hr/>
<div class="table_select_all">
    <table width="99%">
        <tr>
            <td align="left" width="10%" class="select_area"><input type="checkbox" id="selecctall"/> Select All Devices
            </td>
            <td align="left" width="10%" class="select_area"></td>
            <td align="left" width="8%" class="select_area"></td>
            <td align="left" width="8%" class="select_area"></td>
        </tr>
    </table>
</div>

<div class="table_glob">
    <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='0' width='99%'>
        <thead>
        <tr class="success">
            <th>Device UID</th>
            <th>Device Type</th>
            <th>Mac Address</th>
            <th>Device Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?
        $i = 0;
        if (count($devices) > 0) {
            foreach ($devices as $row) {
                $i++;
                ?>
                <tr class="active">
                    <td align="left" width="10%"><span
                        <form action="<?= base_url() ?>index.php/guest/guest_restart" method="POST">
                            <input type="checkbox" class="checkbox_1" name="room_id_<? echo $i; ?>"
                                   value="<?= $row->id ?>"/>
                        </form>
                        </span>
                        <span><?= $row->UID ?> &nbsp;</span>
                    </td>
                    <td align="left" width="6%">
                        <?
                        $device_type = $this->Devices->device_type_byid($row->device_type);
                        print $device_type['device_type'];
                        ?>&nbsp;</td>
                    <td align="left" width="6%"><?= $row->mac_address ?>  </td>
                    <td align="left"
                        width="6%"><?= $row->device_status == 1 ? "<span style='background-color:#00a651;display: block;padding: 10px;color: #fff;'>On</span>" : "<span style='background-color:#ed1c24;display: block;padding: 10px;color: #fff;'>Off</span>"; ?></td>
                    <td align="left" width="8%">
                        <a href="<?= base_url() ?>index.php/backend/editdevice/<?= $row->id ?>">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </a>&nbsp; | &nbsp;
                        <a href="javascript:deleteconform('backend/deletedevice','<?= $row->id ?>','')">
                            <span class="glyphicon glyphicon-remove-sign"></span> Delete
                        </a>&nbsp; | &nbsp;
                        <a href="#" onclick="restart(<?= $row->id ?>, this.id)" id="restart_<?php echo $i; ?>"
                           class="restart_<?= $row->id ?>"><span class="glyphicon glyphicon-refresh"></span> Restart STB</a>
                    </td>
                </tr>
                <?
            }
        } else {
            ?>
            <tr>
                <td align="left" colspan="12">No Data Found</td>
            </tr>
        <? } ?>
        </tbody>
    </table>
</div>
<!--            <div class="roundedcornr_bottom_main_tv"><div></div></div> comented by Lakshan-->
<br/>

<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">


</table>
<p align="center"><?= $pagination ?></p>
</body>
<script type="text/javascript">
    function restart(id, elementID) {
        var c = confirm('Are you sure do you want to restart STB?');
        if (c) {
            $(document).ready(function () {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/guest/device_restart",
                    data: {
                        device_id: id,
                    },
                    dataType: 'html',
                    beforeSend: function () {

                        //$('.restart').html('Sending Restart Request');
                    },
                    complete: function () {
                        var classname = elementID;
                        $('#' + elementID).html('Set to Restart.');
                        $('#' + elementID).css('color', '#060');
                        $('#' + elementID).attr('onClick', '');
                    },
                    success: function (data, textStatus) {
                        //alert(data);
                    }
                });
            });
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#submit_checkbox").click(function () {
            var c = confirm('Are you sure do you want to restart STB?');
            if (c) {
                var datastring = '';
                var i = 0;
                $('input:checked').each(function () {
                    datastring += this.value + ',';
                    //alert(this.value);

                    $('.restart_' + this.value).html('Set to Restart.');
                    $('.restart_' + this.value).css('color', '#060');
                    $('.restart_' + this.value).attr('onClick', '');
                });

                updateDevices(datastring);
            }
        });
    });
</script>
<script>
    function updateDevices(data) {
        $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>index.php/guest/checked_devices",
            data: 'dataString=' + data,
            beforeSend: function (xhr) {
                //alert(data);
                $('.restart').html('Sending Restart Request');

            },
            success: function (html) {
                //alert(html);
                var classname = elementID;
                alert(elementID);
                $('#' + elementID).html('Set to Restart.');
                $('#' + elementID).css('color', '#060');
                $('#' + elementID).attr('onClick', '');
            }
        });
    }
</script>
<script>


    $(document).ready(function () {
        $('#selecctall').click(function (event) {  //on click
            if (this.checked) { // check select status
                $('.checkbox_1').each(function () { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"
                });
            } else {
                $('.checkbox_1').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"
                });
            }
        });

        var attempts = "<?=$attempts;?>";
        if (attempts == 1) {
            setInterval(function () {
                window.location.href = window.location.href + "/1";
            }, 30000);
        } else {
            setInterval(function () {
                window.location.reload();
            }, 60000);
        }

    });

</script>


</html>