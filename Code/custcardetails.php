<?php 
include('mysession.php'); //protect this page, cannot enter url to go this page
if(!session_id())
{
  session_start();
}

if(($_SESSION['u_type']) != 2)
{
    header('Location: login.php');
    exit();
}

include 'headercust.php';
include 'dbconnect.php';

if(isset($_GET['id']))
{
  $vid = $_GET['id'];
}

$sql = "SELECT * 
        FROM tb_vehicle
        WHERE v_reg = ? ";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $vid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();

?>
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">VEHICLE DETAILS</h1>
          </div>
        </div>
      </div>
    </section>
		

		<section class="ftco-section ftco-car-details">
    <div class="container">
      	<div class="row justify-content-center">
      		<div class="col-md-12">
      			<div class="car-details">
      				<div class="img rounded" style="background-image: url(<?php echo $row['v_pic']; ?>);"></div>
      				<div class="text text-center">
      					<span class="subheading"><?php echo $row['v_type']; ?></span>
      					<h2><?php echo $row['v_model']; ?></h2>
                <h4>RM <?php echo $row['v_price']; ?> /Day</h4>
      				</div>
      			</div>
      		</div>
      	</div>

      	<div class="row">
      		<div class="col-md-1 d-flex align-self-stretch ftco-animate"></div>
      		<div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Mileage
		                	<span><?php echo $row['v_mileage']; ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Transmission
		                	<span><?php echo $row['v_transmission']; ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Seats
		                	<span><?php echo $row['v_seat']; ?> Adults</span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
      	</div>

      	<div class="row">
      		<div class="col-md-12 pills">
						<div class="bd-example bd-example-tabs">
							<div class="d-flex justify-content-center">
							  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							    <li class="nav-item">
							      <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
							    </li>
							  </ul>
							</div>

						  <div class="tab-content" id="pills-tabContent">
							    <div class="tab-pane fade show active" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
							        <p style="text-align: center;"><?php echo $row['v_desc']; ?></p>
							    </div>
							</div>
						</div>
		      </div>
				</div>
      </div>
    <div class="container">
      <div class="row">
          <div class="col-md-12 text-center">
              <a href="custbookcar.php?id=<?php echo $vid; ?>" class="btn btn-warning"> Book Now !</a>
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