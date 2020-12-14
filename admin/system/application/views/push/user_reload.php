<?php
//$data = array("data" => $data, "listen_type" => $listen_type);                                                                    
//$data_string = json_encode($data);
//echo "data:". $data_string."\n\n";
echo "data:". $data."\n\n";
ob_flush();
flush();
sleep(HTML_PUSH_SLEEP_USERRELOAD);
?>