<?php
if($need_restart=="yes"){
echo "data:". $need_restart."\n\n";
ob_flush();
flush();
sleep(HTML_PUSH_SLEEP);
}
?>
