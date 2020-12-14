<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1></td>
        <td align="right" valign="middle">
            <div class="buttons" style="float:right; margin-top:0px;">
                <a href="<?= base_url() ?>index.php/welcome/addradiogenre" class="btn btn-success" role="button">
                     <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD RADIO GENRE</a>
            </div>
        </td>
    </tr>
</table>
<?php
if ($this->session->flashdata('gen_c')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('gen_c') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('gen_u')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('gen_u') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('gen_d')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('gen_d') . "</p>";
    print "</div>";
}
?>
<div class="table_glob">
    <table class="table table-bordered table-hover" border='0' cellspacing='0' cellpadding='3' width='99%'>
        <thead>
            <tr class="success">
                <th width="40%" >Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($gen as $key => $value) {
                ?>
                <tr class="active">
                    <td width="40%"><?= $value->name ?></td>
                    <td>
                        <a href="<?= base_url() ?>index.php/welcome/gen_radio_edit/<?= $value->id ?>">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </a>&nbsp;|&nbsp;
                        <a href="javascript:deleteconform('welcome/gen_radio_delete','<?= $value->id ?>','')">
                            <span class="glyphicon glyphicon-remove-sign"></span> Delete
                        </a>
                    </td>	
                </tr>
                <?
                } 
                ?>
            </tbody>
        </table>
    </div>
    <div id="page" align="center"><?= $pagination; ?></div>
