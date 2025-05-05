<?php
include('mysession.php');
if(!session_id())
{
    session_start();
}

if(($_SESSION['u_type']) != 1)
{
    header('Location: login.php');
    exit();
}

include('dbconnect.php');

$fbid = $_GET['id'];
$fstatus = $_POST['fstatus'];

$sql = "UPDATE tb_booking SET b_status = ? WHERE b_id = ?";
    
$stmt = $con->prepare($sql);

$stmt->bind_param('is', $fstatus, $fbid);

$stmt->execute();

$stmt->close();
$con->close();

header('location: staffmanage.php');
?>
