<html>
    <head>
        <style type="text/css">
            body{font-family: Verdana, Geneva, sans-serif;margin:0;padding:0; font-size:10pt;}
            div{padding:10px;}
            h3{margin:0px; border-bottom:1px solid #900; padding-bottom:10px;}
        </style>
    </head>
    <div>
        <?php
        print "<h3>" . $result['title'] . "</h3><br>";
        print utf8_decode($result['fullnews']);
        ?>
    </div>
</html>