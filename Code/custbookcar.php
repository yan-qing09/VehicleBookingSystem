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
            <h1 class="mb-3 bread">BOOK THIS VEHICLE</h1>
          </div>
        </div>
      </div>
    </section>
		

		<section class="section ftco-car-details">
    <div class="container mt-5">
      	<div class="row justify-content-center">
      		<div class="col-md-12">
      			<div class="car-details">
      				<div class="img rounded" style="background-image: url(<?php echo $row['v_pic']; ?>); background-size: cover; background-position: center; height: 250px; width: 50%; margin: 0 auto;"></div>
      				<div class="text text-center">
      					<span class="subheading"><?php echo $row['v_type']; ?></span>
      					<h2><?php echo $row['v_model']; ?></h2>
                <h4>RM <?php echo $row['v_price']; ?> /Day</h4>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
    </section>

     <section class="section ftco-no-pt">
    <div class="container mt-4">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-8 block-9 mb-md-4 mx-auto">
                <form method="post" action="custbookcarprocess.php?id=<?php echo $vid; ?>"
                    class="bg-light p-5 contact-form" id="bookForm">
                    <div class="d-flex justify-content-center">
                        <div class="form-group mr-5">
                            <label for="" class="label">Select Pick-up date</label>
                            <input type="date" name="book_pdate" class="form-control" id="book_pdate" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group ml-5">
                            <label for="" class="label">Select Return date</label>
                            <input type="date" name="book_rdate" class="form-control" id="book_rdate" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-block py-3 mx-auto" style="width: 80%;">BOOK
                        </button>
                    </div>
                    <div class="form-group text-center">
                        <button type="reset" class="btn btn-light btn-block py-3 w-40 mx-auto"
                            style="width: 80%;">RESET</button>
                    </div>
                    <div class="text-center">
                        <p class="mt-3 mb-0"><a href="custbook.php" style="color:#dc3545;">Need Other?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script>
document.getElementById('bookForm').addEventListener('change', function (event) {
    var pickupDate = new Date(document.getElementById('book_pdate').value);
    var returnDateField = document.getElementById('book_rdate');
    var returnDate = new Date(returnDateField.value);

    returnDateField.min = pickupDate.toISOString().split('T')[0];

    if (returnDate < pickupDate) {
        returnDateField.value = pickupDate.toISOString().split('T')[0];
    }
});
</script>

<?php 
include "footer.php";
$stmt->close();
$con->close();
?>