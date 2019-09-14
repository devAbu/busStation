<?php
session_start();
echo 'Logged out <br>';
$url = "index.html";
session_destroy();
header("location:" . $url);
