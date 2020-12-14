<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <!--<meta http-equiv="ontent-type" content="text/html; charset=utf-8"/>-->
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
        <meta content="utf-8" http-equiv="encoding" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
        <title> <?php echo "1.TV Admin Panel"; ?> </title >
        <link href="<?= base_url(); ?>css/admin.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>css/style_round.css" rel="stylesheet" type="text/css"/>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/> -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
            <script type="text/javascript">
                // < ![CDATA[
                base_url = "<?= base_url(); ?>";
                //]] >
                function goURL(string) {
                    string != "" ? window.location = "<?= base_url() ?>index.php/" + string : "";
                }
            </script>
            <link href="<?= base_url(); ?>css/left_menu.css" rel="stylesheet" type="text/css"/>
            <script type="text/javascript" src="<?= base_url(); ?>js/leftmenu/jquery.min.js"></script>
            <script type="text/javascript" src="<?= base_url(); ?>js/leftmenu/jquery.easing.1.3.js"></script>
            <script type="text/javascript" src="<?= base_url(); ?>js/leftmenu/script.js"></script>
            <script type="text/javascript" src="<?= base_url(); ?>js/general.js"></script>
            <script type="text/javascript">
                <!--
                function MM_swapImgRestore() { //v3.0
                    var i, x, a = document.MM_sr;
                    for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++)
                        x.src = x.oSrc;
                }
                function MM_preloadImages() { //v3.0
                    var d = document;
                    if (d.images) {
                        if (!d.MM_p)
                            d.MM_p = new Array();
                        var i, j = d.MM_p.length, a = MM_preloadImages.arguments;
                        for (i = 0; i < a.length; i++)
                            if (a[i].indexOf("#") != 0) {
                                d.MM_p[j] = new Image;
                                d.MM_p[j++].src = a[i];
                            }
                    }
                }
                function MM_findObj(n, d) { //v4.01
                    var p, i, x;
                    if (!d)
                        d = document;
                    if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
                        d = parent.frames[n.substring(p + 1)].document;
                        n = n.substring(0, p);
                    }
                    if (!(x = d[n]) && d.all)
                        x = d.all[n];
                    for (i = 0; !x && i < d.forms.length; i++)
                        x = d.forms[i][n];
                    for (i = 0; !x && d.layers && i < d.layers.length; i++)
                        x = MM_findObj(n, d.layers[i].document);
                    if (!x && d.getElementById)
                        x = d.getElementById(n);
                    return x;
                }
                function MM_swapImage() { //v3.0
                    var i, j = 0, x, a = MM_swapImage.arguments;
                    document.MM_sr = new Array;
                    for (i = 0; i < (a.length - 2); i += 3)
                        if ((x = MM_findObj(a[i])) != null) {
                            document.MM_sr[j++] = x;
                            if (!x.oSrc)
                                x.oSrc = x.src;
                            x.src = a[i + 2];
                        }
                }
                //-->
            </script>
            <!-- <script type="text/javascript" src="<?//= base_url(); ?>assets/js/bootstrap.min.js"></script> -->
    </head>
    <body onload="MM_preloadImages('<?= base_url() ?>images/icons/TV_on.png', '<?= base_url() ?>images/icons/vod_on.png', '<?= base_url() ?>images/icons/news_on.png', '<?= base_url() ?>images/icons/system_on.png')">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" id="wrapper">
            <tr>
                <td><?php $this->load->view('header'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php if ($this->dx_auth->is_logged_in()) { ?>
                        <div id="left_main">
                            <ul class="container">
                                <?php
                                if ($this->session->userdata('menu_area') == 'tv') {
                                    $p_menu_all = array('ALL', 'FAVOURITES');
                                    $p_menu_url = array('welcome/Tv/all/0', 'welcome/favourites');
                                    $parentmenu = array_merge_recursive($p_menu_all, $this->Leftmenu->get_tv_menu());
                                    $parentmenu_url = array_merge_recursive($p_menu_url, $this->Leftmenu->get_tv_url());
                                } else if ($this->session->userdata('menu_area') == 'radio') {
                                    $p_menu_all = array('ALL', 'FAVOURITES');
                                    $p_menu_url = array('radio/index/all/0', 'radio/radiofavourites');
                                    $parentmenu = array_merge_recursive($p_menu_all, $this->Leftmenu_radio->get_tv_menu());
                                    $parentmenu_url = array_merge_recursive($p_menu_url, $this->Leftmenu_radio->get_tv_url());
                                } else if ($this->session->userdata('menu_area') == 'restaurants') {
                                    $parentmenu = $this->lang->line('RESTAURANTS');
                                    $parentmenu_url = $this->lang->line('RESTAURANTS_URL');
                                } else if ($this->session->userdata('menu_area') == 'guest') {
                                    $parentmenu = $this->lang->line('GUEST');
                                    $parentmenu_url = $this->lang->line('GUEST_URL');
                                } else if ($this->session->userdata('menu_area') == 'room') {
                                    $parentmenu = $this->lang->line('ROOMS');
                                    $parentmenu_url = $this->lang->line('ROOMS_URL');
                                } else if ($this->session->userdata('menu_area') == 'vod') {
                                    $p_vod_menu_all = array('ALL');
                                    $p_vod_menu_url = array('welcome/product/all/0');
                                    $parentmenu = array_merge_recursive($p_vod_menu_all, $this->Leftmenu->get_vod_menu());
                                    $parentmenu_url = array_merge_recursive($p_vod_menu_url, $this->Leftmenu->get_vod_url());
                                } else if ($this->session->userdata('menu_area') == 'news') {
                                    $parentmenu = $this->lang->line('NEWS');
                                    $parentmenu_url = $this->lang->line('NEWS_URL');
                                } else if ($this->session->userdata('menu_area') == 'myauth') {
                                    $parentmenu = $this->lang->line('MYAUTH');
                                    $parentmenu_url = $this->lang->line('MYAUTH_URL');
                                } else if ($this->session->userdata('menu_area') == 'system') {
                                    $parentmenu = $this->lang->line('ADMIN');
                                    $parentmenu_url = $this->lang->line('ADMIN_URL');
                                    $childmenu = $this->lang->line('ADMIN_CHILD');
                                    $childmenu_url = $this->lang->line('ADMIN_CHILD_URL');
                                } else if ($this->session->userdata('menu_area') == 'localinfo') {
                                    $parentmenu = $this->lang->line('LOCALINFO');
                                    $parentmenu_url = $this->lang->line('LOCALINFO_URL');
                                } else {
                                    $parentmenu = array();
                                    $parentmenu_url = array();
                                    $childmenu = array();
                                    $childmenu_url = array();
                                }
                                $current_url = $this->uri->segment(3) == "" ? ($this->uri->segment(2) == "" ? $this->uri->segment(1) : $this->uri->segment(2)) : $this->uri->segment(3);
                                ?>
                                <?php $this->TVclass->menu($parentmenu, $parentmenu_url, isset($childmenu) ? $childmenu : "", isset($childmenu_url) ? $childmenu_url : "", $current_url) ?>
                            </ul>
                        </div>
                    
                    <?php } ?>
                    <?php if ($this->dx_auth->is_logged_in()) { ?>
                    <div id="right_content">
                            <div class="roundedcornr_box_main">
                                <div class="roundedcornr_top_main"><div></div></div>
                                <div class="roundedcornr_content_main" style="padding-left:10px;">
                                    <?php $this->load->view($main); ?>
                                </div>
                                <div class="roundedcornr_bottom_main"><div></div></div>
                            </div>
                        </div>
                        
                        <?php
                    } else {
                        $this->load->view($main);
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <footer>
                        <div class="row">

                        </div>
                    </footer>
                </td>
            </tr>
        </table>
    </body>
</html>