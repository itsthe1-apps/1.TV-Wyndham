<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<?php
$data_language = $this->config->item('languages');
$attributes = array('name' => 'myform', 'autocomplete' => 'off');
$url = base_url() . "index.php/backend/update_config_middleware/" . $settings[0]->se_id;
echo form_open_multipart($url, $attributes);
?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle">
            <?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?>
            <div class="buttons" style="float:right; margin-top:0px;">
                <button name="submit" class="btn btn-success" type="submit">
                    <span class="glyphicon glyphicon glyphicon-ok" style="padding-right:10px;"></span>UPDATE CONFIG
                </button>
            </div>
        </td>
    </tr>
</table>
<?php
if ($this->session->flashdata('localinfo_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('weather_message') . "</p>";
    print "</div>";
}
?>

<div class="table_glob">
    <table border='0' cellspacing='0' cellpadding='3' width='99%' class="table table-bordered table-hover">
        <thead>
            <tr class="success">
                <th width="30%">Information</th>
                <th width="70%">Value</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($settings) > 0) {
                ?>
            <tr class="active">
                    <td valign="middle"><?= 'ID'; ?></td>
                    <td valign="middle"><?= $settings[0]->se_id ?></td>
                </tr>
                <tr class="active">
                    <td valign="middle"><?= 'View Type'; ?></td>
                    <td valign="middle">
                        <?php
                        $se_view_type = $settings[0]->se_view_type == 'ListView' ? "ListView" : "ThumbView";
                        echo form_dropdown('se_view_type', $enumval, $se_view_type);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Logo'; ?></td>
                    <td valign="middle" >
                        <br><br>
                        <?php
                        $st_img = isset($settings[0]->se_logo) ? "<img src='" . $this->config->item('logo_icon_url') . '/' . $settings[0]->se_logo . "'>" : "";
                        $attrs = array("name"=>"se_logo","class"=>"btn btn-primary upload_glob");
                        echo form_upload($attrs)
                        ?>
                        <div class="preview_img"><?php echo  $st_img;?></div>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Current Theme'; ?></td>
                    <td valign="middle" ><?= $settings[0]->se_current_theme ?></td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Weather RSS'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_weather_rss = array('name' => 'se_weather_rss', 'value' => $settings[0]->se_weather_rss, 'style' => 'width:90%');
                        echo isset($settings[0]->se_weather_rss) ? form_input($se_weather_rss) : form_input('se_weather_rss');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'News RSS'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_news_rss = array('name' => 'se_news_rss', 'value' => $settings[0]->se_news_rss, 'style' => 'width:90%');
                        echo isset($settings[0]->se_news_rss) ? form_input($se_news_rss) : form_input('se_news_rss');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'PIN Number'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_pin_number = array('name' => 'se_pin_number', 'value' => $settings[0]->se_pin_number, 'style' => 'width:90%');
                        echo isset($settings[0]->se_pin_number) ? form_input($se_pin_number) : form_input('se_pin_number');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'VOD Cost'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_vod_cost = array('1' => 'enable', '0' => 'disable');
                        $se_vod_cost = $settings[0]->se_vod_cost == '0' ? "0" : "1";
                        echo form_dropdown('se_vod_cost', $opt_se_vod_cost, $se_vod_cost);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Table Booking'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_table_booking = array('name' => 'se_table_booking', 'value' => $settings[0]->se_table_booking, 'style' => 'width:90%');
                        echo isset($settings[0]->se_table_booking) ? form_input($se_table_booking) : form_input('se_table_booking');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Wakeup Call'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_wakeup_call = array('name' => 'se_wakeup_call', 'value' => $settings[0]->se_wakeup_call, 'style' => 'width:90%');
                        echo isset($settings[0]->se_wakeup_call) ? form_input($se_wakeup_call) : form_input('se_wakeup_call');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Restaurant Booking'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_restaurant_booking = array('name' => 'se_restaurant_booking', 'value' => $settings[0]->se_restaurant_booking, 'style' => 'width:90%');
                        echo isset($settings[0]->se_restaurant_booking) ? form_input($se_restaurant_booking) : form_input('se_restaurant_booking');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Order Taxi'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_order_taxi = array('name' => 'se_order_taxi', 'value' => $settings[0]->se_order_taxi, 'style' => 'width:90%');
                        echo isset($settings[0]->se_order_taxi) ? form_input($se_order_taxi) : form_input('se_order_taxi');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Room Service'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_room_service = array('name' => 'se_room_service', 'value' => $settings[0]->se_room_service, 'style' => 'width:90%');
                        echo isset($settings[0]->se_room_service) ? form_input($se_room_service) : form_input('se_room_service');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Laundery Request'; ?></td>
                    <td valign="middle" >
                        <?php
                        $se_laundery_request = array('name' => 'se_laundery_request', 'value' => $settings[0]->se_laundery_request, 'style' => 'width:90%');
                        echo isset($settings[0]->se_laundery_request) ? form_input($se_laundery_request) : form_input('se_laundery_request');
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Socket Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_socket_enabled = array('1' => 'enable', '0' => 'disable');
                        $se_socket_enabled = $settings[0]->se_socket_enabled == '0' ? "0" : "1";
                        echo form_dropdown('se_socket_enabled', $opt_se_socket_enabled, $se_socket_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Tape Marquee Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_tapemarquee_enabled = array('1' => 'enable', '0' => 'disable');
                        $se_tapemarquee_enabled = $settings[0]->se_tapemarquee_enabled == '0' ? "0" : "1";
                        echo form_dropdown('se_tapemarquee_enabled', $opt_se_tapemarquee_enabled, $se_tapemarquee_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Fake Data Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_fakedata_enabled = array('1' => 'enable', '0' => 'disable');
                        $se_fakedata_enabled = $settings[0]->se_fakedata_enabled == '0' ? "0" : "1";
                        echo form_dropdown('se_fakedata_enabled', $opt_se_fakedata_enabled, $se_fakedata_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Internet Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_internet_enabled = array('1' => 'enable', '0' => 'disable');
                        $se_internet_enabled = $settings[0]->se_internet_enabled == '0' ? "0" : "1";
                        echo form_dropdown('se_internet_enabled', $opt_se_internet_enabled, $se_internet_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Ajax Pull Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_ajaxpull_enabled = array('1' => 'enable', '0' => 'disable');
                        $se_ajaxpull_enabled = $settings[0]->se_ajaxpull_enabled == '0' ? "0" : "1";
                        echo form_dropdown('se_ajaxpull_enabled', $opt_se_ajaxpull_enabled, $se_ajaxpull_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Exit Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_exit_enabled = array('1' => 'enable', '0' => 'disable');
                        $se_exit_enabled = $settings[0]->se_exit_enabled == '0' ? "0" : "1";
                        echo form_dropdown('se_exit_enabled', $opt_se_exit_enabled, $se_exit_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Alarm Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_alarm_enabled = array('1' => 'enable', '0' => 'disable');
                        $se_alarm_enabled = $settings[0]->se_alarm_enabled == '0' ? "0" : "1";
                        echo form_dropdown('se_alarm_enabled', $opt_se_alarm_enabled, $se_alarm_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Ticker Tape Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_tickertape_enabled = array('1' => 'enable', '0' => 'disable');
                        $tickertape_enabled = $settings[0]->tickertape_enabled == '0' ? "0" : "1";
                        echo form_dropdown('tickertape_enabled', $opt_tickertape_enabled, $tickertape_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Channel Favourite Enabled'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_chfavourite_enabled = array('1' => 'enable', '0' => 'disable');
                        $chfavourite_enabled = $settings[0]->chfavourite_enabled == '0' ? "0" : "1";
                        echo form_dropdown('chfavourite_enabled', $opt_chfavourite_enabled, $chfavourite_enabled);
                        ?>
                    </td>
                </tr>
                <tr class="active">
                    <td valign="middle" ><?= 'Guest Title'; ?></td>
                    <td valign="middle" >
                        <?php
                        $opt_se_guest_title = array('1' => 'enable', '0' => 'disable');
                        $se_guest_title = $settings[0]->se_guest_title == '0' ? "0" : "1";
                        echo form_dropdown('se_guest_title', $opt_se_guest_title, $se_guest_title);
                        ?>
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <tr class="active">
                    <td colspan="2" align="center">No Data Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<? print form_close(); ?>
<div id="page" align="center"><?= $pagination; ?></div>