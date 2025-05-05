<?php

function getCountPendingApprovals($con) {
	$sql = "SELECT * 
	        FROM tb_booking
	        LEFT JOIN tb_vehicle ON tb_booking.b_reg = tb_vehicle.v_reg
	        WHERE b_status = '1'";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();

	return ($result->num_rows > 0) ? mysqli_num_rows($result) : 0;
}

function getCountCompleteOrders($con) {
	$sql = "SELECT * 
            FROM tb_booking
            LEFT JOIN tb_vehicle ON tb_booking.b_reg = tb_vehicle.v_reg
            WHERE b_status = '5'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    return ($result->num_rows > 0) ? mysqli_num_rows($result) : 0;
}

function getCountCancelOrders($con) {
	$sql = "SELECT * 
            FROM tb_booking
            LEFT JOIN tb_vehicle ON tb_booking.b_reg = tb_vehicle.v_reg
            WHERE b_status = '4'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    return ($result->num_rows > 0) ? mysqli_num_rows($result) : 0;
}

function getCountAvailableVehicles($con) {
	$currentDate = date("Y-m-d");
	$totalVehicles = 0;

	$sqlv = "SELECT COUNT(*) AS total 
	         FROM tb_vehicle
	         WHERE v_status = '1'";
	$stmtv = $con->prepare($sqlv);
	$stmtv->execute();
	$resultv = $stmtv->get_result();

	if ($rowv = $resultv->fetch_assoc()) {
	    $totalVehicles = $rowv['total'];
	}

	$sqlb = "SELECT COUNT(*) AS booked 
	         FROM tb_booking
	         WHERE b_status = '2' AND ('$currentDate' BETWEEN b_pdate AND b_rdate)";
	$stmtb = $con->prepare($sqlb);
	$stmtb->execute();
	$resultb = $stmtb->get_result();

	if ($rowb = $resultb->fetch_assoc()) {
	    $countBookedVehicles = $rowb['booked'];
	}

	return $totalVehicles - $countBookedVehicles;
}

?>