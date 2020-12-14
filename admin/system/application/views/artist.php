<?
if ($this->session->flashdata('art_c')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('art_c') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('art_u')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('art_u') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('art_d')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('art_d') . "</p>";
    print "</div>";
}
?>
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach ($art as $key => $value) {
        ?>
        <tr>
            <td valign="top" align="center"><?= $value['a_id'] ?></td>
            <td valign="top" align="center"><?= $value['a_name'] ?></td>
            <td valign="top" align="center"><?= $value['a_description'] ?></td>
            <td valign="top" align="center"><?= anchor('welcome/art_edit/' . $value['a_id'], 'edit') ?> / <?= anchor('welcome/art_delete/' . $value['a_id'], 'delete') ?></td>	
        </tr>
        <?
    }
    ?>
    <tr>
        <td colspan="9"><?= anchor("welcome/addartist", "Add Artist") ?></td>
    </tr>
</table>
<div id="page"><?= $pageination; ?></div>