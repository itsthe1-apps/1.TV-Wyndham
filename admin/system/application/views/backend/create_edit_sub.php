<script type="text/javascript">
    $(document).ready(function () {
<?php if (!empty($message['room_id'])) { ?>
            $('.greeting_dp').show();
            $('.themes_dp').show();
            $('.language_dp').show();
<?php } else { ?>
            $('.greeting_dp').hide();
            $('.themes_dp').hide();
            $('.language_dp').hide();
<?php } ?>
        $('#room_number').live('change', function () {
            $('.greeting_dp').show();
            $('.themes_dp').show();
            $('.language_dp').show();
            //$('#is_updated_field').val(1);
        });
        /*
         $('#greeting').live('change', function(){
         $('#is_updated_field').val(1);
         });
         */
        $('#name_title').live('change', function () {
            $('#is_updated_field').val(1);
        });
        $('#name').live('change', function () {
            $('#is_updated_field').val(1);
        });
        $('#surname').live('change', function () {
            $('#is_updated_field').val(1);
        });
        $('#themes').live('change', function () {
            $('#is_updated_field').val(1);
        });
        $('#language').live('change', function () {
            $('#is_updated_field').val(1);
        });
    });</script>
<?php $attributes = array('autocomplete' => 'off') ?>
<?php
print form_open($this->uri->uri_string(), $attributes);
$update_field = array('name' => 'is_updated_field', 'id' => 'is_updated_field', 'type' => 'hidden');
print form_input($update_field);
?>
<h1><? print $title;?></h1>
<table width="100%" cellpadding="0" cellspacing="5" class="table">
    <tr>
        <td width='20%'>Salutation <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?php
            $name_title = $this->config->item('name_title');
            print form_dropdown('name_title', $name_title, !empty($message['title']) ? $message['title'] : $this->input->post('name_title'),'class="form-control" style="width:auto;"');
            ?>
            <td width="29%"><span id="error"><?= form_error('name') ?></span></td>
    </tr>
    <tr>
        <td width='20%'>Name <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?= form_input('name', !empty($message['name']) ? $message['name'] : $this->input->post('name'), 'size=25 maxlength=100 class="form-control"') ?></td>
        <td width="29%"><span id="error"><?= form_error('name') ?></span></td>
    </tr>
    <tr>
        <td width='20%'>Surname</td>
        <td width='5%'>:</td>
        <td width='46%'><?= form_input('surname', !empty($message['surname']) ? $message['surname'] : $this->input->post('surname'), 'size=25 maxlength=100 class="form-control"') ?><br/> <?= isset($message['guest_id']) ? '<a href="' . base_url() . 'index.php/guest/name_language/' . $message['guest_id'] . '">Name in other languages</a>' : '' ?></td>
        <td><span id="error"><?= form_error('surname') ?></span></td>
    </tr>
    <tr>
        <td width='20%'>Skin</td>
        <td width='5%'>:</td>
        <td width='46%'><?php
            foreach ($skin as $row) {
                $opt_sub1[$row->sk_css] = $row->sk_name;
            }
            print form_dropdown('skin', $opt_sub1, !empty($message['skin']) ? $message['skin'] : $this->input->post('skin'),'class="form-control" style="width:200px;"');
            ?></td>
        <td><span id="error"><?= form_error('surname') ?></span></td>
    </tr>
    <tr>
        <td width='20%'>Accessibility</td>
        <td width='5%'>:</td>
        <td width='46%'><?= form_checkbox('accessibility', 1, !empty($message['accessibility']) || $this->input->post('accessibility') == 1 ? TRUE : FALSE, 'size=25 ') ?></td>
        <td><span id="error"><?= form_error('accessibility') ?></span></td>
    </tr>
    <tr>
        <td width='20%'>Status</td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?php
            //$status_opt['1']	= "Active";
            //$status_opt['2']	= "Inactive";
            //$status_opt['3']	= "Prospective";
            $status_opt = array();
            if (count($status_text) > 0) {
                foreach ($status_text as $row) {
                    $status_opt[$row->st_id] = $row->st_name;
                }
            }
            print form_dropdown('status', $status_opt, !empty($message['status']) ? $message['status'] : $this->input->post('status'),'class="form-control" style="width:200px;"');
            ?></td>
        <td><span id="error"><?= form_error('status') ?></span></td>
    </tr>
    <tr>
        <td width='20%'>Room Number <? if(!isset($message['id'])){?><span class='star'> * </span><? } ?></td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?php
            $rooms_dp[''] = 'Select Room Number';
            if (count($rooms) > 0) {
                foreach ($rooms as $row) {
                    $rooms_dp[$row->id] = $row->room_number;
                }
            }
            print form_dropdown('room_number', $rooms_dp, !empty($message['room_id']) ? $message['room_id'] : '', 'id="room_number" class="form-control" style="width:200px;"');
            print form_hidden('edit_room_number', !empty($message['room_id']) ? $message['room_id'] : '', 'id="edit_room_number"');

            if (!empty($message['room_id'])) {
                $r = $message['room_number'];
                print '(<strong>Current Room Number :</strong> ' . $message['room_number'] . ') <a href=# onclick=restart("' . $r . '") class=restart>Restart STB</a>';
            }
            ?>
        </td>
        <td><span id="error"><?= form_error('room_number') ?></span></td>
    </tr>
    <tr class="greeting_dp">
        <td width='20%'>Greeting </td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?php
            $greeting_dp = array();
            if (count($greeting) > 0) {
                foreach ($greeting as $row) {
                    $greeting_dp[$row->id] = $row->title;
                }
            }
            print form_dropdown('greeting', $greeting_dp, !empty($message['greeting_id']) ? $message['greeting_id'] : '', 'id="greeting" class="form-control" style="width:200px;"');
            ?>
        </td>
        <td><span id="error"><?= form_error('greeting') ?></span></td>
    </tr>
    <tr class="themes_dp">
        <td width='20%'>Themes </td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?php
            $themes_dp = array();
            if (count($themes) > 0) {
                foreach ($themes as $row) {
                    $themes_dp[$row->th_id] = $row->th_name;
                }
            }
            print form_dropdown('themes', $themes_dp, !empty($message['theme_id']) ? $message['theme_id'] : 1, 'id="themes" class="form-control" style="width:200px;"');
            ?>
        </td>
        <td><span id="error"></span></td>
    </tr>
    <tr class="language_dp">
        <td width='20%'>Language </td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?php
            $language_dp = array();
            if (count($language) > 0) {
                foreach ($language as $row) {
                    $language_dp[$row->id] = $row->short_label;
                }
            }
            print form_dropdown('language', $language_dp, !empty($message['language_id']) ? $message['language_id'] : 1, 'id="language" class="form-control" style="width:80px;"');
            ?>
        </td>
        <td><span id="error"></span></td>
    </tr>

<!--    <tr>
    <td width='20%'>Address</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('address',!empty($message['address']) ? $message['address'] : $this->input->post('address'),'size=25 maxlength=100')?></td>
    <td><span id="error"><?//=form_error('address')?></span></td>
</tr>
<tr>
    <td width='20%'>Postal Code</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('postal_code',!empty($message['postal_code']) ? $message['postal_code'] : $this->input->post('postal_code'),'size=25 maxlength=10')?></td>
    <td><span id="error"><?//=form_error('postal_code')?></span></td>
</tr>
<tr>
    <td width='20%'>Post</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('post',!empty($message['post']) ? $message['post'] : $this->input->post('post'),'size=25 maxlength=10')?></td>
    <td><span id="error"><?//=form_error('post')?></span></td>
</tr>
 <tr>
    <td width='20%'>Country</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('country',!empty($message['country']) ? $message['country'] : $this->input->post('country'),'size=25 maxlength=50')?></td>
    <td><span id="error"><?//=form_error('country')?></span></td>
</tr>
<tr>
    <td width='20%'>Fixed phone</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('fixed_phone',!empty($message['fixed_phone']) ? $message['fixed_phone'] : $this->input->post('fixed_phone'),'size=25 maxlength=50')?></td>
    <td><span id="error"><?//=form_error('fixed_phone')?></span></td>
</tr>
<tr>
    <td width='20%'>Mobile phone</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('mobile_phone',!empty($message['mobile_phone']) ? $message['mobile_phone'] : $this->input->post('mobile_phone'),'size=25 maxlength=50')?></td>
    <td><span id="error"><?//=form_error('mobile_phone')?></span></td>
</tr>
<tr>
    <td width='20%'>Job phone</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('job_phone',!empty($message['job_phone']) ? $message['job_phone'] : $this->input->post('job_phone'),'size=25 maxlength=50')?></td>
    <td><span id="error"><?//=form_error('job_phone')?></span></td>
</tr>
 <tr>
    <td width='20%'>FAX</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('FAX',!empty($message['FAX']) ? $message['FAX'] : $this->input->post('FAX'),'size=25 maxlength=30')?></td>
    <td><span id="error"><?//=form_error('FAX')?></span></td>
</tr>
<tr>
    <td width='20%'>UID</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('UID',!empty($message['UID']) ? $message['UID'] : $this->input->post('UID'),'size=25 maxlength=10')?></td>
    <td></td>
</tr>
<tr>
    <td width='20%'>Auto sub</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('auto_sub',!empty($message['auto_sub']) ? $message['auto_sub'] : $this->input->post('auto_sub'),'size=25 maxlength=100')?></td>
    <td><span id="error"><?//=form_error('auto_sub')?></span></td>
</tr>
<tr>
    <td width='20%'>Auto audio</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('auto_audio',!empty($message['auto_audio']) ? $message['auto_audio'] : $this->input->post('auto_audio'),'size=25 maxlength=100')?></td>
    <td><span id="error"><?//=form_error('auto_audio')?></span></td>
</tr>
<tr>
    <td width='20%'>Auto reminder time</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('auto_reminder_time',!empty($message['auto_reminder_time']) ? $message['auto_reminder_time'] : $this->input->post('auto_reminder_time'),'size=25 maxlength=100')?></td>
    <td><span id="error"><?//=form_error('auto_reminder_time')?></span></td>
</tr>
<tr>
    <td width='20%'>Parental PIN</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('parental_pin',!empty($message['parental_pin']) ? $message['parental_pin'] : $this->input->post('parental_pin'),'size=25')?></td>
    <td></td>
</tr>
<tr>
    <td width='20%'>User PIN</td>
    <td width='5%'>:</td>
    <td width='46%'><?//=form_input('user_pin',!empty($message['user_pin']) ? $message['user_pin'] : $this->input->post('user_pin'),'size=25')?></td>
    <td></td>
</tr>-->

    <tr>
        <td width='20%'>Package <span class='star'> * </span></td>
        <td width='5%'>:</td>
        <td width='46%'>
            <?php
            foreach ($packages as $row) {
                $opt_sub[$row->id] = $row->name;
            }
            print form_dropdown('package', $opt_sub, !empty($message['package']) ? $message['package'] : $this->input->post('package'),'class="form-control" style="width:200px;"');
            ?></td>
        <td><span id="error"><?= form_error('package') ?></span></td>
    </tr>
    <tr>
        <td colspan="4" align="left"><br/><div class="buttons">
                <button onclick="history.back();return false;" class="btn btn-danger">Back</button>
                    <?php
                    if ($guest_id != "" && intval($guest_id)) {
                        print '<button type="submit" class="btn btn-primary" name="update">Update Guest</button>';
                        //print form_submit('update','Update Skin');
                    } else {
                        print '<button type="submit" class="btn btn-success" name="submit">Create Guest</button>';
                        //print form_submit('submit','Create Skin');
                    }
                    ?>
            </div></td>
    </tr>
</table>
<?php print form_close(); ?>

<script type="text/javascript">
    function restart(id) {
        var c = confirm('Are you sure do you want to restart STB?');
        if (c) {
            $(document).ready(function () {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>index.php/guest/guest_restart",
                    data: {
                        room_id: id,
                    },
                    dataType: 'html',
                    beforeSend: function () {
                        $('.restart').html('Sending Restart Request');
                    },
                    complete: function () {
                        $('.restart').html('Set to Restart.');
                        $('.restart').css('color', '#060');
                        $('.restart').attr('onClick', '');
                    },
                    success: function (data, textStatus) {
                        //alert(data);
                    }
                });
            });
        }
    }
</script>