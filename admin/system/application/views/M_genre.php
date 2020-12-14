<h1><?php echo $title; ?></h1>
<?
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
<table border='1' cellspacing='0' cellpadding='3' width='100%'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach ($gen as $key => $value) {
        ?>
        <tr>
            <td valign="top" align="center"><?= $value['Id'] ?></td>
            <td valign="top" align="center"><?= $value['Category'] ?></td>
            <td valign="top" align="center"><?= anchor('welcome/editMovieGenre/' . $value['Id'], 'edit') ?> / <?= anchor('welcome/deleteMovieGenre/' . $value['Id'], 'delete') ?></td>	
        </tr>
        <?
    }
    ?>
    <tr>
        <td colspan="9"><?= anchor("welcome/addMovieGenre", "Add Genre") ?></td>
    </tr>
</table>
