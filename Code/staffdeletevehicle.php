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

include 'dbconnect.php';

$vehicle_id = $_GET['id'];

$sql = "UPDATE tb_vehicle 
        SET v_status = '0'
        WHERE v_reg = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $vehicle_id);

if ($stmt->execute()) {
    header('Location: staffcar.php?message=Vehicle deleted successfully');
    exit();
} 
else {
    header('Location: staffcar.php?message=Error deleting vehicle');
    exit();
}
 

?>