<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>

        <td align="right" valign="middle"><div class="buttons" style="float:right; margin-top:0px;">
                <a href="<?= base_url() ?>index.php/radio/addradio" class="btn btn-success" role="button">
                    <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD RADIO CHANNELS</a>
            </div></td>
    </tr>
</table>
<?php
//echo $this->uri->segment(3, 0);
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
<div class="table_glob">
<table border='0' cellspacing='0' cellpadding='3' width='99%' class="table table-bordered table-hover">
    <thead>
        <tr class="success">
            <th width="30%">Channel Name</th>
            <th width="20%">Channel Number</th>
            <th width="20%">Path</th>
            <th >Icon</th>
            <th width="15%">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (count($tv) > 0) {
        foreach ($tv as $key => $value) {
            ?>
        <tr class="active">
                <td valign="middle" align="center" width="30%">
            <?= $value->name ?>
                </td>
                <td valign="middle" align="center" width="20%"><?= $value->number ?></td>
                <td valign="middle" align="center" width="20%"><?= $value->mrl ?></td>
                <?
                $file = basename($value->logo);
                /**
                if($value['logo']!="")
                {
                //print $value['logo'];
                $icon_split=explode("\\",$value['logo']);
                //print_r($icon_split);


                }
                **/
                ?>
                <td valign="middle" align="center"><img src="<?= $this->config->item('radio_icon_url') ?><? if($file){ print $file;}?>"/></td>
                <td valign="middle" align="center" width="25%">
                    <a href="<?= base_url() ?>index.php/radio/radio_edit/<?= $value->id ?>">
                        <span class="glyphicon glyphicon-edit"></span>Edit
                    </a>&nbsp;|&nbsp;
                    <a href="javascript:deleteconform('radio/deleteradio','<?= $value->id ?>')">
                        <span class="glyphicon glyphicon-remove-sign"></span>Delete 
                    </a>&nbsp;|&nbsp;
                    <a href="<?= base_url() ?>index.php/radio/addradiofavourites/<?= $value->id ?>">
                        <span class="glyphicon glyphicon-star"></span>Add To Favourites
                    </a>
                </td>	
            </tr>
            <? }
            }else{ ?>
            <tr>
                <td align="center" colspan="5" width="99%">No Data Found</td>
            </tr>
            <?
            }
            ?>
    </tbody>
</div>
<div id="page" align="center"><?php echo $pagination; ?></div>