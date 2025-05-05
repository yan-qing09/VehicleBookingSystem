<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

if(($_SESSION['u_type']) != 1)
{
    header('Location: login.php');
    exit();
}

include 'dbconnect.php';

$vid = $_GET['id'];
$model = $_POST['fmodel'];
$type = $_POST['ftype'];
$mileage = $_POST['fmileage'];
$seat = $_POST['fseat'];
$transmission = $_POST['ftrans'];
$color = $_POST['fcolor'];
$price = floatval($_POST['fprice']);
$desc = $_POST['fdesc'];

if ($_FILES['fimage']['size'] > 0) {
    $targetDirectory = "Cars/";
    $originalFileName = basename($_FILES["fimage"]["name"]);
    $uniqueFileName = $freg . ".jpg";
    $targetFile = $targetDirectory . $uniqueFileName;

    move_uploaded_file($_FILES["fimage"]["tmp_name"], $targetFile);

    $updateSql = "UPDATE tb_vehicle 
                  SET 
                  v_model = ?, v_type = ?, v_mileage = ?, v_seat = ?, v_transmission = ?, 
                  v_colour = ?, v_price = ?, v_desc = ?, v_pic = ? WHERE v_reg = ?";

    $updateStmt = $con->prepare($updateSql);
    $updateStmt->bind_param('ssssssdsss', $model, $type, $mileage, $seat, $transmission, $color, $price, $desc, $targetFile, $vid);
} 
else {
    $updateSql = "UPDATE tb_vehicle 
                  SET 
                  v_model = ?, v_type = ?, v_mileage = ?, v_seat = ?, v_transmission = ?, 
                  v_colour = ?, v_price = ?, v_desc = ? WHERE v_reg = ?";

    $updateStmt = $con->prepare($updateSql);
    $updateStmt->bind_param('ssssssdss', $model, $type, $mileage, $seat, $transmission, $color, $price, $desc, $vid);
}

if ($updateStmt->execute()) {
    header("Location: staffcardetails.php?id=$vid");
    exit();
} 
else {
    echo "Error updating record: " . $updateStmt->error;
}


$updateStmt->close();
$con->close();
?>
