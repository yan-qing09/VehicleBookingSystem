<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

if ($_SESSION['u_type'] != 2) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $fbid = $_GET['id'];
}

include('dbconnect.php');

$sql = "UPDATE tb_booking SET b_status = '4' WHERE b_id = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param('i', $fbid);

    $stmt->execute();

    $stmt->close();
}

$con->close();

header('location: custmanage.php');
?>
