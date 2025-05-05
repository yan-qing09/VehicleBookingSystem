<?php
session_start();

include('dbconnect.php');

$fic = $_POST['fic'];
$fpwd = $_POST['fpwd'];

$sql = "SELECT * FROM tb_user WHERE u_ic = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $fic);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$row = $result->fetch_assoc();

if ($row) {
    if (password_verify($fpwd, $row['u_pwd'])) {
        $_SESSION['u_ic'] = $row['u_ic'];
        $_SESSION['u_type'] = $row['u_type'];

        if ($row['u_type'] == '1') {
            header('Location: staffmain.php');
        } else {
            header('Location: custmain.php');
        }
    } else {
        $errorMessage = "Incorrect password!";
        $_SESSION['loginError'] = $errorMessage;
        header('Location: login.php');
    }
} else {
    $errorMessage = "User not found!";
    $_SESSION['loginError'] = $errorMessage;
    header('Location: login.php');
}


$stmt->close();
$con->close();
?>



