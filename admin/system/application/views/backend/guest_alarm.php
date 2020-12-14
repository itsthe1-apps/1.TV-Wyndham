<html>
    <body>
    <?php
    $attributes = array('name'=>'guest_alarm');
    print form_open(base_url().'index.php/guest/guestalarm',$attributes);
    if($this->session->flashdata('guest_alarm')!=""){
    print "<div id='msg'>";
        echo "<p id='ms' align='justify'>".$this->session->flashdata('guest_alarm')."</p>";
    print "</div>";
    }
    ?>
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
                            <th width="10%" style="border-right:1px #FFF solid;">Guest Name</th>
                            <th width="10%" style="border-right:1px #FFF solid;">Alarm Time</th>
                            <th width="10%" style="border-right:1px #FFF solid;">Type</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(count($alerts)>0){
                            foreach($alerts as $row){
                                $bg_color = '';
                                if($row->alarm_status==1){
                                    $bg_color = "#FBFDB9";
                                }else if($row->alarm_status==2){
                                    $bg_color = "#ABFD97";
                                }
                        ?>
                        <tr bgcolor="<?=$bg_color?>">
                            <td align="center" width="10%"><?=$row->title.'. '.$row->name?></td>
                            <td align="center" width="10%">
                            <?php
                                $originalDate = $row->alarm_time;
                                $newDate = date("l jS \of F Y h:i:s A", strtotime($originalDate));
                                print $newDate;
                            ?>
                            </td>
                            <td align="center" width="10%"><?=$row->type?></td>
                            <td align="center" width="10%">
                                <?php
                                if($row->alarm_status==0){?>
                                <a href="#" class="confirm" onClick="return is_confirm(<?=$row->guest_alarm_id?>);">Confirm</a>
                                <?php
                                }else if($row->alarm_status==2){ ?>
                                <img src="<?=base_url()?>/images/right_mark.png"/>
                                <?php } ?>
                                &nbsp;
                                <a href="javascript:deleteconform('guest/delete_alarm_request','<?=$row->guest_alarm_id?>','')"><img src="<?=base_url()?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>&nbsp;</td>
                        </tr>
                        <? }
                        }else{?>
                        <tr>
                            <td align="center" colspan="4">No Data Found</td>
                        </tr>
                        <? }?>
                    </tbody>
                </table>
            </div>
        <!--<div class="roundedcornr_bottom_main_tv"><div></div></div> comented by Lakshan--> 
        </div><br />
        <table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form"></table>
        <p align="center"><?= $pagination ?></p>
        <?php 
        print form_hidden('request_id','');
        print form_close() ?>
    </body>
    <script type="text/javascript">
    function is_confirm(request_id){
        var con = confirm('Are you sure you want to confirm this request?');
        if(con==true){
            var frm = document.guest_alarm;
            frm.request_id.value = request_id;
            frm.submit();
        }else{
            return false;
        }
    }
    </script>
</html>