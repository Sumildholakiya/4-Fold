<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'settler') {
    $email = trim($_POST['email']);

    if (!empty($email)) {
        $sql = "INSERT INTO tbl_newsettler (settler_email) VALUES ('$email')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Subscribed successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please enter a valid email');</script>";
    }
}
?>
<footer>
   <div class="footer">
      <div class="container">
         <div class="row">
            <div class=" col-md-4">
               <h3>Contact US</h3>
               <ul class="conta">
                  <li><i class="fa fa-map-marker" aria-hidden="true"></i>Hotel Casa Riva, Surat, Gujarat</li>
                  <li><i class="fa fa-mobile" aria-hidden="true"></i> +91 6355653553</li>
                  <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> fourfold@gmail.com</a></li>
               </ul>
            </div>
            <div class="col-md-4">
               <h3>Menu Link</h3>
               <ul class="link_menu">
                  <li class="active"><a href="index.php">Home</a></li>
                  <li><a href="about.php"> about</a></li>
                  <li><a href="room.php">Our Room</a></li>
                  <li><a href="gallery.php">Gallery</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
               </ul>
            </div>
            <div class="col-md-4">
               <h3>New settler</h3>
               <form class="bottom_form" method="POST">
                  <input type="hidden" name="form_type" value="settler">
                  <input class="enter text-black-50" placeholder="Enter your email" type="text" name="email">
                  <button class="sub_btn" type="submit">subscribe</button>
               </form>
              
            </div>
         </div>
      </div>
      <div class="copyright">
         <div class="container">
            <div class="row">
               <div class="col-md-10 offset-md-1">

                  <p>

                     © 2025 All Rights Reserved. Design by SDJ's Student
                     <br />
                  </p>

               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- end footer -->
<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<script>
   const path = window.location.pathname.split("/").pop() || "index.php";

   // Get all navigation links inside link_menu
   document.querySelectorAll(".link_menu li").forEach(li => {
      const link = li.querySelector("a");
      if (link.getAttribute("href") === path) {
         li.classList.add("active");
      } else {
         li.classList.remove("active");
      }
   });
   function toggleDropdown() {
      const dropdown = document.getElementById("profileDropdown");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
   }

   // Agar user profile ke bahar click kare → dropdown close ho jaye
   window.addEventListener("click", function (e) {
      if (!e.target.closest(".profile-wrapper")) {
         document.getElementById("profileDropdown").style.display = "none";
      }
   });
</script>

</body>

</html>