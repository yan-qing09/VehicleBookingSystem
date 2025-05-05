<?php 
include('mysession.php'); //protect this page, cannot enter url to go this page
if(!session_id())
{
  session_start();
}

if(($_SESSION['u_type']) != 1)
{
    header('Location: login.php');
    exit();
}

include 'headerstaff.php';
include 'dbconnect.php';

$sqlCount = "SELECT COUNT(*) AS total 
             FROM tb_vehicle 
             WHERE v_status = '1'";
$stmtCount = $con->prepare($sqlCount);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$rowCount = $resultCount->fetch_assoc();
$totalRecords = $rowCount['total'];

$recordsPerPage = 9;

$totalPages = ceil($totalRecords / $recordsPerPage);

$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($currentpage - 1) * $recordsPerPage;

$sql = "SELECT * 
        FROM tb_vehicle 
        WHERE v_status = '1' 
        LIMIT $recordsPerPage OFFSET $offset";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">MANAGE VEHICLES</h1>
          </div>
        </div>
      </div>
    </section>

    <?php
      if (isset($_GET['message'])) {
      $message = $_GET['message'];
      echo '<br>';
      echo '<div class="alert ' . (strpos($message, 'Error') !== false ? 'alert-danger' : 'alert-success') . '">' . $message . '</div>';
      }
    ?>
		
    <section class="ftco-section bg-light">
    <div class="container">
      <div class="row">
          <div class="col-md-12 text-right">
              <a href="staffaddvehicle.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Vehicle</a>
          </div>
      </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <?php
            while ($row = $result->fetch_array()) {
                echo '<div class="col-md-4">';
                echo '<div class="car-wrap rounded ftco-animate">';
                echo '<div class="img rounded d-flex align-items-end" style="background-image: url(' . $row['v_pic'] . ');"></div>';
                echo '<div class="text">';
                echo '<h2 class="mb-0"><a href="car-single.html">' . $row['v_model'] . '</a></h2>';
                echo '<div class="d-flex mb-3">';
                echo '<span class="cat">' . $row['v_type'] . '</span>';
                echo '<p class="price ml-auto">RM' . $row['v_price'] . ' <span>/day</span></p>';
                echo '</div>';
                echo '<p class="d-flex justify-content-center mb-0 d-block"><a href="staffcardetails.php?id='.$row['v_reg'].'" class="btn btn-secondary py-2 ml-1">Details</a></p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <?php
                  if ($currentpage > 1) {
                      echo '<li><a href="?page=' . ($currentpage - 1) . '">&lt;</a></li>';
                  }

                  for ($i = 1; $i <= $totalPages; $i++) {
                      echo '<li' . ($currentpage == $i ? ' class="active"' : '') . '><a href="?page=' . $i . '">' . $i . '</a></li>';
                  }

                  if ($currentpage < $totalPages) {
                      echo '<li><a href="?page=' . ($currentpage + 1) . '">&gt;</a></li>';
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php 
include "footer.php";
$stmt->close();
$con->close();
?>