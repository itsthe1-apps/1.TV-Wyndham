<h1><?php echo $title; ?></h1>
<?
if ($this->session->flashdata('Pro_c')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('Pro_c') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('Pro_u')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('Pro_u') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('Pro_d')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('Pro_d') . "</p>";
    print "</div>";
}
?>
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
    <tr>
        <th>Name</th>
        <th>StartTime</th>
        <th>EndTime</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach ($program as $key => $value) {
        ?>
        <tr>
            <td valign="top" align="center"><?= $value['name'] ?></td>
            <td valign="top" align="center"><?= $value['startTime'] ?></td>
            <td valign="top" align="center"><?= $value['endTime'] ?></td>
            <td valign="top" align="center"><?= $value['description'] ?></td>
            <td valign="top" align="center"><?= anchor('welcome/editprogram/' . $value['id'] . '/' . $value['genreId'], 'edit') ?> / <?= anchor('welcome/deleteprogram/' . $value['id'], 'delete') ?></td>	
        </tr>
        <?
    }
    ?>
    <tr>
        <td colspan="9"><?= anchor("welcome/addprogram", "Add Program") ?></td>
    </tr>
</table>
<div id="page"><?= $pageination; ?></div>
