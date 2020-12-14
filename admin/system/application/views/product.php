<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="top"><div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/welcome/addproduct" class="positive"><img src="<?= base_url() ?>images/apply2.png" alt=""/>ADD MOVIE</a></div></td>
    </tr>
</table>
<?
if ($this->session->flashdata('movie_u')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_u') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('movie_c')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_c') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('movie_d')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_d') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('movie_img')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_img') . "</p>";
    print "</div>";
}
?>
<div class="roundedcornr_box_main_tv" style="width:99%; background: #600;">
    <div class="roundedcornr_top_main_tv"><div></div></div>
    <div class="roundedcornr_content_main_tv" style="padding-left:10px;">
        <table border='0' cellspacing='0' cellpadding='0' width='99%'>
            <tr>
                <th width="30%" style="border-right:1px #FFF solid;">Name</th>
                <th width="12%" style="border-right:1px #FFF solid;">Icon</th>
                <th width="31%" style="border-right:1px #FFF solid;">Path</th>
                <th style="border-right:1px #FFF solid;">Duration (Min)</th>
                <th width="14%">Actions</th>
            </tr>
        </table>
    </div>
    <div class="roundedcornr_bottom_main_tv"><div></div></div>
</div><br />
<table border='0' cellspacing='0' cellpadding='3' width='99%' id="table_form">
    <?
    if (count($product) > 0) {
        foreach ($product as $key => $value) {
            ?>
            <tr>
                <td valign="middle" align="center" width="30%"><?= $value->name ?></td>
                <?
                $file = "";
                if (isset($value->logo)) {
                    $file = basename($value->logo);
                }
                ?>
                <td valign="middle" align="center" width="12%"><img  width="50" src="<?=$this->config->item('vod_icon_url') ?>/thumbnail/<?=isset($file) ? $value->thumbnail : ''?>"/></td>
                <td valign="middle" align="center" width="30%"><?= $value->mrl ?></td>
                <td valign="middle" align="center"><?= $value->duration ?></td>
                <td valign="middle" align="center" width="15%">
                    <a href="<?= base_url() ?>index.php/welcome/edit/<?= $value->id ?>/<?= $value->genreId ?>"><img src="<?= base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('welcome/delete','<?= $value->id ?>','<?= $value->genreId ?>')"><img src="<?= base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
                </td>
            </tr>
    <? }
} else { ?>
        <tr>
            <td align="center" valign="middle">No Data Found</td>
        </tr>	
<? } ?>
</table>
<div id="page" align="center"><?= $pagination; ?></div>