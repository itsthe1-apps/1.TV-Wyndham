<html>
<style type="text/css">
    <!--
    #header #logout a {
        color: #CCC;
    }

    -->
</style>
<body>
<?php
//echo strtolower($this->uri->segment(2));
//die();
if (strtolower($this->uri->segment(2)) == "tv" ||
    strtolower($this->uri->segment(2)) == "addtv" ||
    strtolower($this->uri->segment(2)) == "tv_edit" ||
    strtolower($this->uri->segment(2)) == "addfavourites" ||
    strtolower($this->uri->segment(2)) == "favourites"
) {
    $this->session->set_userdata('menu_area', 'tv');
} else if (strtolower($this->uri->segment(2)) == "product" ||
    strtolower($this->uri->segment(2)) == "addproduct" ||
    (strtolower($this->uri->segment(1)) == "welcome" && strtolower($this->uri->segment(2)) == "edit")
) {
    $this->session->set_userdata('menu_area', 'vod');
} else if (strtolower($this->uri->segment(1)) == "newsmenu" ||
    strtolower($this->uri->segment(2)) == "addnews" ||
    strtolower($this->uri->segment(2)) == "editnews"
) {
    $this->session->set_userdata('menu_area', 'news');
} else if (strtolower($this->uri->segment(1)) == "restaurants" ||
    strtolower($this->uri->segment(2)) == "addrestaurant" ||
    strtolower($this->uri->segment(2)) == "editrestaurant" ||
    strtolower($this->uri->segment(2)) == "restaurantmenutype" ||
    strtolower($this->uri->segment(2)) == "addrestaurantmenutype" ||
    strtolower($this->uri->segment(2)) == "editrestaurantmenutype" ||
    strtolower($this->uri->segment(2)) == "restaurantmenu" ||
    strtolower($this->uri->segment(2)) == "addrestaurantmenu" ||
    strtolower($this->uri->segment(2)) == "editrestaurantmenu"
) {
    $this->session->set_userdata('menu_area', 'restaurants');
} else if (strtolower($this->uri->segment(1)) == "guest" ||
    strtolower($this->uri->segment(2)) == "addguest" ||
    strtolower($this->uri->segment(2)) == "editguest" ||
    strtolower($this->uri->segment(2)) == "guest" ||
    strtolower($this->uri->segment(2)) == "addguest" ||
    strtolower($this->uri->segment(2)) == "editguest" ||
    strtolower($this->uri->segment(2)) == "greeting" ||
    strtolower($this->uri->segment(2)) == "addgreeting" ||
    strtolower($this->uri->segment(2)) == "editgreeting"
) {
    $this->session->set_userdata('menu_area', 'guest');
} else if (strtolower($this->uri->segment(1)) == "room" ||
    strtolower($this->uri->segment(2)) == "editroom" ||
    strtolower($this->uri->segment(2)) == "filter"
) {
    $this->session->set_userdata('menu_area', 'room');
} else if (strtolower($this->uri->segment(1)) == "messages" ||
    strtolower($this->uri->segment(2)) == "addmessage" ||
    strtolower($this->uri->segment(2)) == "editmessage"
) {
    $this->session->set_userdata('menu_area', 'messages');
} else if (strtolower($this->uri->segment(1)) == "localinfo") {
    $this->session->set_userdata('menu_area', 'localinfo');
} else if (strtolower($this->uri->segment(1)) == "radio") {
    $this->session->set_userdata('menu_area', 'radio');
} else if (strtolower($this->uri->segment(2)) == "ticker_promo") {
    $this->session->set_userdata('menu_area', 'ticker_promotions');
} else if (strtolower($this->uri->segment(1)) == "promotions") {
    $this->session->set_userdata('menu_area', 'promotions');
} else if (
    strtolower($this->uri->segment(1)) == "myauth" &&
    (strtolower($this->uri->segment(2)) == "users" ||
        strtolower($this->uri->segment(2)) == "register" ||
        strtolower($this->uri->segment(2)) == "roles" ||
        strtolower($this->uri->segment(2)) == "uri_permissions")
) {
    $this->session->set_userdata('menu_area', 'myauth');
} else if ($this->uri->segment(2) == "" ||
    strtolower($this->uri->segment(2)) == "skins" ||
    strtolower($this->uri->segment(2)) == "addskin" ||
    strtolower($this->uri->segment(2)) == "editskin" ||
    strtolower($this->uri->segment(2)) == "language" ||
    strtolower($this->uri->segment(2)) == "addlanguage" ||
    strtolower($this->uri->segment(2)) == "editlanguage" ||
    strtolower($this->uri->segment(2)) == "rooms" ||
    strtolower($this->uri->segment(2)) == "addrooms" ||
    strtolower($this->uri->segment(2)) == "editrooms" ||
    strtolower($this->uri->segment(2)) == "occation" ||
    strtolower($this->uri->segment(2)) == "addoccation" ||
    strtolower($this->uri->segment(2)) == "editoccation" ||
    strtolower($this->uri->segment(2)) == "devices" ||
    strtolower($this->uri->segment(2)) == "adddevice" ||
    strtolower($this->uri->segment(2)) == "editdevice" ||
    strtolower($this->uri->segment(2)) == "devicetypes" ||
    strtolower($this->uri->segment(2)) == "adddevtypes" ||
    strtolower($this->uri->segment(2)) == "editdevtypes" ||
    strtolower($this->uri->segment(2)) == "channel_permissions" ||
    strtolower($this->uri->segment(2)) == "roles_channelgroups" ||
    strtolower($this->uri->segment(2)) == "tvgenre" ||
    strtolower($this->uri->segment(2)) == "radiogenre" ||
    strtolower($this->uri->segment(2)) == "addgenre" ||
    strtolower($this->uri->segment(2)) == "vodgenre" ||
    strtolower($this->uri->segment(2)) == "gen_radio_edit" ||
    strtolower($this->uri->segment(2)) == "addradiogenre" ||
    strtolower($this->uri->segment(2)) == "gen_edit" ||
    strtolower($this->uri->segment(2)) == "genre_itv" ||
    strtolower($this->uri->segment(2)) == "editgenreitv" ||
    strtolower($this->uri->segment(2)) == "editgenreitv" ||
    strtolower($this->uri->segment(2)) == "prating" ||
    strtolower($this->uri->segment(2)) == "addprating" ||
    strtolower($this->uri->segment(2)) == "editprating" ||
    strtolower($this->uri->segment(2)) == "channelgroup" ||
    //(strtolower($this->uri->segment(1)) == "auth" && strtolower($this->uri->segment(2)) == "edit") ||
    strtolower($this->uri->segment(2)) == "addgenreitv" ||
    strtolower($this->uri->segment(2)) == "themes" ||
    strtolower($this->uri->segment(2)) == "addconfig" ||
    strtolower($this->uri->segment(2)) == "editconfig" ||
    strtolower($this->uri->segment(2)) == "weather" ||
    strtolower($this->uri->segment(2)) == "vod" ||
    strtolower($this->uri->segment(2)) == "addvodsettings" ||
    strtolower($this->uri->segment(2)) == "editvodsettings" ||
    strtolower($this->uri->segment(2)) == "tickertape" ||
    strtolower($this->uri->segment(2)) == "addthemes" ||
    strtolower($this->uri->segment(2)) == "editthemes" ||
    strtolower($this->uri->segment(2)) == "settings" ||
    strtolower($this->uri->segment(2)) == "backgrounds" || //Added by Yesh - 2016-08-10
    strtolower($this->uri->segment(2)) == "addbackground" || //Added by Yesh - 2016-08-10
    strtolower($this->uri->segment(2)) == "editbackground" || //Added by Yesh - 2016-08-10
    strtolower($this->uri->segment(2)) == "addsettings" ||
    strtolower($this->uri->segment(2)) == "editsettings" ||
    strtolower($this->uri->segment(2)) == "roomtypes" ||
    strtolower($this->uri->segment(2)) == "addroomtypes" ||
    strtolower($this->uri->segment(2)) == "editroomtypes" ||
    strtolower($this->uri->segment(2)) == "roomgroups" ||
    strtolower($this->uri->segment(2)) == "addroomgroups" ||
    strtolower($this->uri->segment(2)) == "editroomgroups" ||
    strtolower($this->uri->segment(2)) == "vodgenre" ||
    strtolower($this->uri->segment(2)) == "addvodgenre" ||
    strtolower($this->uri->segment(2)) == "editvodgenre" ||
    strtolower($this->uri->segment(2)) == "exitmsg" || //Added by Yesh
    strtolower($this->uri->segment(2)) == "config_middleware" || //Added by Yesh
    strtolower($this->uri->segment(2)) == "television_brands"
) { //Added by Yesh
    $this->session->set_userdata('menu_area', 'system');
} else {
    $this->session->unset_userdata('menu_area');
}
?>
<div id="header">
    <div id="title">
        <img src="<?= base_url() ?>images/ITSthe1.png" border="0" align="left"/>
        <?php
        $guest_alarm = $this->TVclass->wakeup_message()->num_rows();
        if ($guest_alarm > 0 && $this->dx_auth->is_logged_in()) {
            ?>
            <a href="<?= base_url() ?>/index.php/guest/guestalarm"><img src="<?= base_url() ?>images/alarm_clock.png"
                                                                        border="0" style="margin:10px 0 0 20px;"
                                                                        id="alarm_image"/></a>
        <?php } ?>
    </div>
    <?php if ($this->dx_auth->is_logged_in()) { ?>
        <span id="logout">
            <a href="<?= base_url() ?>index.php/auth/logout">LOGOUT</a>
        </span>
        <div id="icons" align="right">
            <span style="padding:10px;"><a href="<?= base_url() ?>index.php/guest"
                                           onMouseOut="MM_swapImage('Image2', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "guest" ? "guest_on.png" : "guest_off.png" ?>', 1)"
                                           onMouseOver="MM_swapImage('Image2', '', '<?= base_url() ?>images/icons/guest_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "guest" ? "guest_on.png" : "guest_off.png" ?>"
                        border="0" name="Image3"/></a></span>
            <span style="padding:10px;"><a href="<?= base_url() ?>index.php/room/filter/occupancy"
                                           onMouseOut="MM_swapImage('Image3', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "room" ? "rooms_on.png" : "rooms_off.png" ?>', 1)"
                                           onMouseOver="MM_swapImage('Image3', '', '<?= base_url() ?>images/icons/rooms_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "rooms" ? "rooms_on.png" : "rooms_off.png" ?>"
                        border="0" name="Image3"/></a></span>
            <?php
            /**
             * <span style="padding:10px;">
             * <a href="<?= base_url() ?>index.php/spa" onMouseOut="MM_swapImage('Image4', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "spa" ? "spa_on.png" : "spa_off.png" ?>', 1)" onMouseOver="MM_swapImage('Image4', '', '<?= base_url() ?>images/icons/spa_on.png', 1)"><img src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "spa" ? "spa_on.png" : "spa_off.png" ?>" border="0" name="Image4"/>
             * </a>
             * </span>
             * <span style="padding:10px;">
             * <a href="<?= base_url() ?>index.php/experience" onMouseOut="MM_swapImage('Image5', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "experience" ? "experience_on.png" : "experience_off.png" ?>', 1)" onMouseOver="MM_swapImage('Image5', '', '<?= base_url() ?>images/icons/experience_on.png', 1)"><img src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "experience" ? "experience_on.png" : "experience_off.png" ?>" border="0" name="Image5"/>
             * </a>
             * </span>
             */
            ?>
            <img src="<?= base_url() ?>images/icons/line.png" border="0"/>
            <span style="padding:10px;">
                <a href="<?= base_url() ?>index.php/newsnpromo"
                   onMouseOut="MM_swapImage('Image33', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "newsnpromo" ? "newsnpromo_on.png" : "newsnpromo_off.png" ?>', 1)"
                   onMouseOver="MM_swapImage('Image33', '', '<?= base_url() ?>images/icons/newsnpromo_on.png', 1)">
                    <img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "newsnpromo" ? "newsnpromo_on.png" : "newsnpromo_off.png" ?>"
                        border="0" name="Image33"/>
                </a>
            </span>
            <span style="padding:10px;"><a href="<?= base_url() ?>index.php/localinfo"
                                           onMouseOut="MM_swapImage('Image6', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "localinfo" ? "info_on.png" : "info_off.png" ?>', 1)"
                                           onMouseOver="MM_swapImage('Image6', '', '<?= base_url() ?>images/icons/info_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "localinfo" ? "info_on.png" : "info_off.png" ?>"
                        border="0" name="Image6"/></a></span>
            <span style="padding:10px;">
                <a href="<?= base_url() ?>index.php/messages"
                   onMouseOut="MM_swapImage('Image1', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "messages" ? "message_on.png" : "message_off.png" ?>', 1)"
                   onMouseOver="MM_swapImage('Image1', '', '<?= base_url() ?>images/icons/message_on.png', 1)">
                    <img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "messages" ? "message_on.png" : "message_off.png" ?>"
                        border="0" name="Image1"/>
                </a>
            </span>
            <img src="<?= base_url() ?>images/icons/line.png" border="0"/>
            <?php
            /**
             * <span style="padding:10px;"><a href="<?= base_url() ?>index.php/radio/index/all/0"
             * onMouseOut="MM_swapImage('Image7', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "radio" ? "radio_on.png" : "radio_off.png" ?>', 1)"
             * onMouseOver="MM_swapImage('Image7', '', '<?= base_url() ?>images/icons/radio_on.png', 1)"><img
             * src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "radio" ? "radio_on.png" : "radio_off.png" ?>"
             * border="0" name="Image7"/></a></span>
             * <span style="padding:10px;"><a href="<?= base_url() ?>index.php/promotions/ticker_promo"
             * onMouseOut="MM_swapImage('Image8', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "ticker_promotions" ? "ticker_promo_on.png" : "ticker_promo_off.png" ?>', 1)"
             * onMouseOver="MM_swapImage('Image8', '', '<?= base_url() ?>images/icons/ticker_promo_on.png', 1)"><img
             * src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "ticker_promotions" ? "ticker_promo_on.png" : "ticker_promo_off.png" ?>"
             * border="0" name="Image8"/></a></span>
             * <span style="padding:10px;">
             * <a href="<?= base_url() ?>index.php/promotions" onMouseOut="MM_swapImage('Image9', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "promotions" ? "promotion_on.png" : "promotion_off.png" ?>', 1)" onMouseOver="MM_swapImage('Image9', '', '<?= base_url() ?>images/icons/promotion_on.png', 1)">
             * <img src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "promotions" ? "promotion_on.png" : "promotion_off.png" ?>" border="0" name="Image9"/>
             * </a>
             * </span>
             */
            ?>
            <span style="padding:10px;">
                <a href="<?= base_url() ?>index.php/welcome/Tv/all/0"
                   onMouseOut="MM_swapImage('Image10', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "tv" ? "TV_on.png" : "TV_off.png" ?>', 1)"
                   onMouseOver="MM_swapImage('Image10', '', '<?= base_url() ?>images/icons/TV_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "tv" ? "TV_on.png" : "TV_off.png" ?>"
                        border="0" name="Image10"/></a>
            </span>
            <span style="padding:10px;"><a href="<?= base_url() ?>index.php/restaurants"
                                           onMouseOut="MM_swapImage('Image11', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "restaurants" ? "restaurrent_on.png" : "restaurrent_off.png" ?>', 1)"
                                           onMouseOver="MM_swapImage('Image11', '', '<?= base_url() ?>images/icons/restaurrent_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "restaurants" ? "restaurrent_on.png" : "restaurrent_off.png" ?>"
                        border="0" name="Image11"/></a></span>
            <img src="<?= base_url() ?>images/icons/line.png" border="0"/>
            <?php
            /**
             * <span style="padding:10px;">
             * <a href="<?= base_url() ?>index.php/welcome/product/all/0" onMouseOut="MM_swapImage('Image12', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "vod" ? "vod_on.png" : "vod_off.png" ?>', 1)" onMouseOver="MM_swapImage('Image12', '', '<?= base_url() ?>images/icons/vod_on.png', 1)">
             * <img src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "vod" ? "vod_on.png" : "vod_off.png" ?>" border="0" name="Image12"/>
             * </a>
             * </span>
             */
            ?>
            <span style="padding:10px;"><a href="<?= base_url() ?>index.php/newsmenu"
                                           onMouseOut="MM_swapImage('Image13', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "news" ? "news_on.png" : "news_off.png" ?>', 1)"
                                           onMouseOver="MM_swapImage('Image13', '', '<?= base_url() ?>images/icons/news_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "news" ? "news_on.png" : "news_off.png" ?>"
                        border="0" name="Image13"/></a></span>
            <span style="padding:10px;"><a href="<?= base_url() ?>index.php/backend/rooms"
                                           onMouseOut="MM_swapImage('Image14', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "system" ? "system_on.png" : "system_off.png" ?>', 1)"
                                           onMouseOver="MM_swapImage('Image14', '', '<?= base_url() ?>images/icons/system_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "system" ? "system_on.png" : "system_off.png" ?>"
                        border="0" name="Image14"/></a></span>
            <span style="padding:10px;"><a href="<?= base_url() ?>index.php/myauth/users"
                                           onMouseOut="MM_swapImage('Image15', '', '<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "myauth" ? "users_on.png" : "users_off.png" ?>', 1)"
                                           onMouseOver="MM_swapImage('Image15', '', '<?= base_url() ?>images/icons/users_on.png', 1)"><img
                        src="<?= base_url() ?>images/icons/<?= $this->session->userdata('menu_area') == "myauth" ? "users_on.png" : "users_off.png" ?>"
                        border="0" name="Image15"/></a></span>
        </div>
    <?php } ?>
</div>
</body>

<script type="text/javascript">
    function blinkId(id) {
        var i = document.getElementById(id);
        if (i.style.visibility == 'hidden') {
            i.style.visibility = 'visible';
        } else {
            i.style.visibility = 'hidden';
        }
        setTimeout("blinkId('" + id + "')", 800);
        return true;
    }
    <?php if ($guest_alarm > 0 && $this->dx_auth->is_logged_in()) { ?>
    blinkId('alarm_image');
    <?php } ?>
</script>
</html>