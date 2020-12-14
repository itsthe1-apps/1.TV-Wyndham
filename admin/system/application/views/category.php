<html>
    <body>
        <div style="float:left;"><h1><?= $title ?></h1></div>
        <div style="float:right;"><h1><a href="<?= base_url() ?>index.php/backend/adddevgroups" style="font-weight:normal; color:#000; font-size:14px;">Add Group</a></h1></div>
        <table border='1' cellspacing='0' cellpadding='3' width='100%'>
            <tr>
                <th>VOD Category Name</th>
                <th>VOD Category Desc</th>
                <th>VOD Category Rating</th>
                <th>UID</th>
                <th>&nbsp;</th>
            </tr>
            <?
            if (count($category) > 0) {
                foreach ($category as $row) {
                    ?>
                    <tr>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><a href="<?= base_url() ?>index.php/backend/editdevgroups/<?= $row->id ?>">Edit</a> / <a href="<?= base_url() ?>index.php/backend/deletedevgroups/<?= $row->id ?>">Delete</a>&nbsp;</td>
                    </tr>
                <? }
            } else { ?>
                <tr>
                    <td align="center" colspan="5">No Data Found</td>
                </tr>
<? } ?>
        </table>
        <p align="center"><?= $pagination ?></p>
    </body>
</html>