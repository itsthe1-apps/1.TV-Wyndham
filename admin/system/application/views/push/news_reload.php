<?php
echo "data:". $data."\n\n";
ob_flush();
flush();
sleep(HTML_PUSH_SLEEP_NEWS);
?>