<?php

$ip = "00:02:02:32:32:6a";
$rest = substr($ip, 0, 11);  // returns "cde"

define("STB_RANGE", serialize(array("00:02:02:32")));
//$test= array("00:02:02:32");

if (in_array($rest, unserialize(STB_RANGE))) {
    echo "Got Irix";
}