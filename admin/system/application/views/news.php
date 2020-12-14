<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="top"><?= $this->TVclass->language_dp('language', $this->session->userdata($session_keyword), "onChange='language_change(this.value,\"$session_keyword\")'") ?><div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/newsmenu/addnews" class="positive"><img src="<?= base_url() ?>images/apply2.png" alt=""/>ADD NEWS</a></div></td>
    </tr>
</table>
<?php
$popup = array(
    'width' => '600',
    'height' => '500',
    'right' => '0',
    'top' => '0'
);

if ($this->session->flashdata('tv_c')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('tv_c') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('tv_u')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('tv_u') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('tv_d')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('tv_d') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('tv_img')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('tv_img') . "</p>";
    print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
    <div class="roundedcornr_top_main_tv"><div></div></div>
    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
        <table border='0' cellspacing='0' cellpadding='0' width='99%'>
            <tr>
                <th width="20%" style="border-right:1px #FFF solid;">Title</th>
                <th width="50%" style="border-right:1px #FFF solid;">Summary</th>
                <!--<th width="35%" style="border-right:1px #FFF solid;">&nbsp;</th>-->
                <th width="20%" style="border-right:1px #FFF solid;">Date</th>
                <th width="10%">Actions</th>
            </tr>
        </table>
    </div>
    <div class="roundedcornr_bottom_main_tv"><div></div></div>
</div><br/>
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
    <?php

    function substr_words($paragraph, $num_words) {
        $paragraph = explode(' ', $paragraph);
        $paragraph = array_slice($paragraph, 0, $num_words);
        return implode(' ', $paragraph);
    }

    foreach ($tv as $key => $value) {
        ?>
        <tr>
            <td valign="top" align="left" width="20%"><?= $value['title'] ?></td>
            <td valign="top" align="left" width="50%"><?= $value['summary'] ?></td>
            <!--<td valign="top" align="left" width="35%">&nbsp;
                            <?	
                                    /**
                                    $words = explode(" ",$value['fullnews']);
                                    $num = count($words);
                                    if($num>20){
                                            print substr_words($value['fullnews'], 20).".. </br>".anchor_popup('welcome/full_view/'.$value['id'],'More',$popup)."";
                                    }else{
                                            print $value['fullnews'];
                                    }
                                    */
                            ?></td>-->
            <td valign="top" align="center" width="20%"><?php print $this->TVclass->UnixConvert(str_replace(substr($value['add_date'], -3, 3), "", $value['add_date'])); ?></td>
            <td valign="middle" align="center" width="10%">
                <a href="<?= base_url() ?>index.php/newsmenu/editnews/<?= $value['id'] ?>"><img src="<?= base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('newsmenu/deletenews','<?= $value['id'] ?>','')"><img src="<?= base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
            </td>	
        </tr>
    <?php } ?>
</table>
<div id="page" align="center"><?= $pageination; ?></div>