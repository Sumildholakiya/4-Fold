<?php 
include 'header.php';

// Check if user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

// Store session values into variables
$userName  = $_SESSION['user']['name'] ?? '';
$userEmail = $_SESSION['user']['email'] ?? '';
$userPhone = $_SESSION['user']['contact'] ?? '';
?>

<div class="back_re">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="title">
               <h2>Contact Us</h2>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include 'contactform.php'; ?>
<?php include 'footer.php'; ?>
