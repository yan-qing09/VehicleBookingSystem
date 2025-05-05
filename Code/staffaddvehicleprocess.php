<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

if ($_SESSION['u_type'] != 1) {
    header('Location: login.php');
    exit();
}

include 'dbconnect.php';

$freg = $_POST['freg'];
$fmodel = $_POST['fmodel'];
$ftype = $_POST['ftype'];
$fmileage = $_POST['fmileage'];
$fseat = $_POST['fseat'];
$ftrans = $_POST['ftrans'];
$fcolor = $_POST['fcolor'];
$fprice = $_POST['fprice'];
$fdesc = $_POST['fdesc'];

$targetDirectory = "Cars/";
$originalFileName = basename($_FILES["fimage"]["name"]);
$uniqueFileName = $freg . ".jpg";
$targetFile = $targetDirectory . $uniqueFileName;

move_uploaded_file($_FILES["fimage"]["tmp_name"], $targetFile);

$sql = "INSERT INTO tb_vehicle (v_reg, v_model, v_type, v_mileage, v_seat, v_transmission, v_colour, v_price, v_desc, v_pic, v_status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1')";

$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param('ssssssssss', $freg, $fmodel, $ftype, $fmileage, $fseat, $ftrans, $fcolor, $fprice, $fdesc, $targetFile);

    $stmt->execute();

    $stmt->close();

    $message = "Vehicle inserted successfully.";
} else {
    $message = "Error: Please try again later";
}

$con->close();

header("Location: staffaddvehicle.php?message=" . urlencode($message));
exit();
?>
