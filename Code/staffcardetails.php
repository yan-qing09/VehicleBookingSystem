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
      	<div class="row">
          <div class="col-md-12 text-right">
              <button class="btn btn-warning" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit
        			</button>
              <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Delete
        			</button>
          </div>
      </div>
      </div>
    <div class="container mt-4">
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
    </section>

<div class="modal fade" role="dialog" tabindex="-1" id="editModal" style="margin: 0px;margin-top: 0px;text-align: left;">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-lg-down" role="document">
        <div class="modal-content">
            <div class='modal-header'>
                <h5 class='modal-title' id='editModalLabel'>Edit Vehicle Details</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <form id="deleteForm" action="staffeditvehicle.php?id=<?php echo $vid; ?>" method="post">
                <div class='modal-body'>
              <div class="form-group mt-4">
                <label for="exampleInputImage" class="form-label">Vehicle Image</label>
                <div class="image-container">
                  <img src="<?php echo $row['v_pic']; ?>" alt="Vehicle Image" class="img-fluid" id="image">
                </div>
                <input type="file" name="fimage" class="form-control mt-2" id="exampleInputImage" accept="image/*">
                <small class="form-text text-muted">Accepted formats: JPEG, PNG, GIF. Maximum file size: 5MB.</small>
              </div>

              <div class="form-group">
                <label for="exampleInputReg" class="form-label mt-4">Vehicle ID</label>
                <input type="text" name= "freg" class="form-control" id="exampleInputModel" placeholder="exp: ABC123" value="<?php echo $row['v_reg']; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="exampleInputModel" class="form-label mt-4">Vehicle Model</label>
                <input type="text" name= "fmodel" class="form-control" id="exampleInputModel" placeholder="exp: Range Rover Evoque" value="<?php echo $row['v_model']; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputType" class="form-label mt-4">Vehicle Type</label>
                <input type="text" name= "ftype" class="form-control" id="exampleInputType" placeholder="exp: Coupe" value="<?php echo $row['v_type']; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputMileage" class="form-label mt-4">Vehicle Mileage</label>
                <input type="text" name= "fmileage" class="form-control" id="exampleInputMileage" placeholder="exp: 10,000" value="<?php echo $row['v_mileage']; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputSeat" class="form-label mt-4">Vehicle Seat</label>
                <input type="text" name= "fseat" class="form-control" id="exampleInputSeat" placeholder="exp: 4" value="<?php echo $row['v_seat']; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputTrans" class="form-label mt-4">Vehicle Transmission</label>
                <input type="text" name= "ftrans" class="form-control" id="exampleInputTrans" placeholder="exp: Automatic" value="<?php echo $row['v_transmission']; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputColor" class="form-label mt-4">Vehicle Color</label>
                <input type="text" name= "fcolor" class="form-control" id="exampleInputColor" placeholder="exp: White" value="<?php echo $row['v_colour']; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputPrice" class="form-label mt-4">Price Per Day (RM)</label>
                <input type="text" name= "fprice" class="form-control" id="exampleInputPrice" placeholder="exp: 250" value="<?php echo $row['v_price']; ?>">
              </div>

              <div class="form-group">
                <label for="exampleTextareaDesc" class="form-label mt-4">Vehicle Description</label>
                <textarea class="form-control" name= "fdesc" id="exampleTextarea" rows="5" placeholder="exp: The Range Rover Evoque Coupe Prestige SD4 is ..." required><?php echo $row['v_desc']; ?></textarea>
              </div>
                </div>
                <div class='modal-footer'>
                    <button type='submit' class='btn btn-warning'>SAVE</button>
                    <button type='reset' class='btn btn-light'>RESET</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" tabindex="-1" id="deleteModal" style="margin: 0px;margin-top: 0px;text-align: left;">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-lg-down" role="document">
        <div class="modal-content">
            <div class='modal-header'>
                <h5 class='modal-title' id='deleteModalLabel'>Delete Vehicle</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <form id="deleteForm" action="staffdeletevehicle.php?id=<?php echo $vid; ?>" method="post">
                <div class='modal-body'>
                    <p>Are you sure you want to delete this vehicle?</p>
                </div>
                <div class='modal-footer'>
                    <button type='submit' class='btn btn-danger'>Yes</button>
                    <button type='button' class='btn btn-light' data-dismiss='modal'>No</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script>
  document.getElementById("exampleInputImage").onchange = function () {
    var fileImg = this.files[0];

    if (fileImg) {
      document.getElementById("image").src = URL.createObjectURL(fileImg);
    }
  }
</script>

<?php 
include "footer.php";
$stmt->close();
$con->close();
?>