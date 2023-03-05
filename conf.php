<?php

require 'config/const.php';

$conns = new mysqli(host, user, pass, db);
if($conns->connect_error){
    die('Database error' . $conns->connect_error);
}
?>