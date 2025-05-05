<?php
if(!session_id()) {
    session_start();
}

if (!isset($_SESSION['u_ic']) || !isset($_SESSION['u_type'])) {
    header('Location: login.php');
    exit();
}

include('dbconnect.php');
?>