<?php 
include 'header.php';

// Check if user is logged in
// Store session values into variables
$userName  = $_SESSION['user']['name'] ?? '';
$userEmail = $_SESSION['user']['email'] ?? '';
$userPhone = $_SESSION['user']['contact'] ?? '';
?>
<!-- banner -->
<section class="banner_main">
   <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
      <ol class="carousel-indicators">
         <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
         <li data-target="#myCarousel" data-slide-to="1"></li>
         <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <img class="first-slide" src="images/banner1.jpg" alt="First slide">
            <div class="container">
            </div>
         </div>
         <div class="carousel-item">
            <img class="second-slide" src="images/banner2.jpg" alt="Second slide">
         </div>
         <div class="carousel-item">
            <img class="third-slide" src="images/banner3.jpg" alt="Third slide">
         </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
      </a>
   </div>

</section>
<!-- end banner -->
<!-- about -->
<div class="about">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-5">
            <div class="titlepage">
               <h2>About Us</h2>
               <p>4Fold is a modern and peaceful stay destination, offering comfort, cleanliness, and quality service. Whether you're traveling for business or leisure, we ensure a relaxing and hassle-free experience with well-equipped rooms and warm hospitality.</p>

               <a class="read_more" href="about.php"> Read More</a>
            </div>
         </div>
         <div class="col-md-7">
            <div class="about_img">
               <figure><img src="images/about.png" alt="#" /></figure>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end about -->
<!-- our_room -->
<div class="our_room">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Our Room</h2>
               <p>Find comfort and ease — reserve your room at 4Fold</p>
            </div>
         </div>
      </div>
      <div class="row">
         <?php
         include 'db.php';
         $sql = "SELECT * FROM rooms LIMIT 3";
         $result = mysqli_query($conn, $sql);

         if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
         ?>
               <div class="col-md-4 col-sm-6">
                  <div id="serv_hover" class="room">
                     <div class="room_img">
                        <figure>
                           <img src="../admin/uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                alt="<?php echo htmlspecialchars($row['room_name']); ?>"
                                style="height:220px; object-fit:cover; width:100%;">
                        </figure>
                     </div>
                     <div class="bed_room">
                        <h3><?php echo htmlspecialchars($row['room_name']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p><strong>Rent:</strong> ₹<?php echo htmlspecialchars($row['rent']); ?> / night</p>
                     </div>
                  </div>
               </div>
         <?php
            }
         } else {
            echo "<p class='text-center'>No rooms found.</p>";
         }
         ?>
      </div>
   </div>
</div>

<!-- end our_room -->
<!-- gallery -->
<div class="gallery">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>gallery</h2>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery1.jpg" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery2.jpg" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery3.jpg" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery4.jpg" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery5.jpg" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery6.jpg" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery7.jpg" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="gallery_img">
               <figure><img src="images/gallery8.jpg" alt="#" /></figure>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end gallery -->
<!-- blog -->
<div class="blog">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Blog</h2>
               <p>Stories, highlights, and moments from our property.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4">
            <div class="blog_box">
               <div class="blog_img">
                  <figure><img src="images/blog1.jpg" alt="#" /></figure>
               </div>
               <div class="blog_room">
                  <h3>Poolside Lounge</h3>
                  <span>Relax • Refresh • Recharge </span>
                  <p>Enjoy a calm atmosphere beside our crystal-clear pool. A perfect place to relax, read a book, or enjoy a quiet evening. This is simple placeholder text used for design demos and layout previews. </p>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="blog_box">
               <div class="blog_img">
                  <figure><img src="images/blog2.jpg" alt="#" /></figure>
               </div>
               <div class="blog_room">
                  <h3>Modern Lobby</h3>
                  <span>Comfort Meets Style</span>
                  <p>Our lobby area features modern interiors, comfortable seating, and a warm ambience. This dummy content is here to show how text will look in your project when real data is added later. </p>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="blog_box">
               <div class="blog_img">
                  <figure><img src="images/blog3.jpg" alt="#" /></figure>
               </div>
               <div class="blog_room">
                  <h3>Deluxe Bedroom</h3>
                  <span>Stay Comfortably</span>
                  <p>Experience a cozy and peaceful stay in our deluxe rooms. This placeholder paragraph demonstrates how the description section will appear on the final website when actual hotel details are included.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end blog -->
<!--  contact -->
<?php include 'contactform.php'; ?>
<!-- end contact -->
<?php include 'footer.php'; ?>