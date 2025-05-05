<?php
// Connect to DB
include('dbconnect.php');

// Retrieve data from registration form (left side use in this file, right side must be the same name as in register.php)
$fic = $_POST['fic'];
$fname = $_POST['fname'];
$fpwd = $_POST['fpwd'];
$fphone = $_POST['fphone'];
$femail = $_POST['femail'];
$flic = $_POST['flic'];
$fstreet = $_POST['fstreet'];
$fcity = $_POST['fcity'];
$fpostcode = $_POST['fpostcode'];
$fstate = $_POST['fstate'];

$hashedPassword = password_hash($fpwd, PASSWORD_DEFAULT);

$sql = "INSERT INTO tb_user (u_ic, u_pwd, u_name, u_phone, u_email, u_street, u_city, u_postcode, u_state, u_lic, u_type)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '2')";

$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param('ssssssssss', $fic, $hashedPassword, $fname, $fphone, $femail, $fstreet, $fcity, $fpostcode, $fstate, $flic);

    $stmt->execute();

    $stmt->close();
}

$con->close();

header('Location: login.php');
?>

