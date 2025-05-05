<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

if (($_SESSION['u_type']) != 1) {
    header('Location: login.php');
    exit();
}

include('dbconnect.php');

$suic = $_SESSION['u_ic'];

$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['confirmPassword'];
$fname = $_POST['fname'];
$fphone = $_POST['fphone'];
$femail = $_POST['femail'];
$flic = $_POST['flic'];
$fstreet = $_POST['fstreet'];
$fcity = $_POST['fcity'];
$fpostcode = $_POST['fpostcode'];
$fstate = $_POST['fstate'];

$sql = "SELECT u_pwd FROM tb_user WHERE u_ic = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $suic);

$response = array();

if ($stmt->execute()) {
    $stmt->bind_result($actualPassword);
    $stmt->fetch();
    $stmt->close();

    if ($actualPassword !== null && password_verify($currentPassword, $actualPassword)) {
        $updates = array();
        $parameters = array();

        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updates[] = "u_pwd = ?";
            $parameters[] = $hashedPassword;
        }

        if (!empty($fname)) {
            $updates[] = "u_name = ?";
            $parameters[] = $fname;
        }

        if (!empty($fphone)) {
            $updates[] = "u_phone = ?";
            $parameters[] = $fphone;
        }

        if (!empty($femail)) {
            $updates[] = "u_email = ?";
            $parameters[] = $femail;
        }

        if (!empty($flic)) {
            $updates[] = "u_lic = ?";
            $parameters[] = $flic;
        }

        if (!empty($fstreet)) {
            $updates[] = "u_street = ?";
            $parameters[] = $fstreet;
        }

        if (!empty($fcity)) {
            $updates[] = "u_city = ?";
            $parameters[] = $fcity;
        }

        if (!empty($fpostcode)) {
            $updates[] = "u_postcode = ?";
            $parameters[] = $fpostcode;
        }

        if (!empty($fstate)) {
            $updates[] = "u_state = ?";
            $parameters[] = $fstate;
        }

        if (!empty($updates)) {
            $updatesString = implode(', ', $updates);
            $sql = "UPDATE tb_user SET $updatesString WHERE u_ic = ?";

            $parameters[] = $suic;

            $stmt = $con->prepare($sql);

            $types = str_repeat('s', count($parameters));
            $stmt->bind_param($types, ...$parameters);

            $stmt->execute();
            $stmt->close();

            $message = "Profile updated successfully.";
            $messageType = "success";
        }
    } 
    else {
        $message = "Incorrect current password.";
        $messageType = "error";
    }
} 

$con->close();
header("Location: staffprofile.php?message=" . urlencode($message) . "&type=" . urlencode($messageType));
exit();
?>



