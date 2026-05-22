<?php
include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form data
    $name    = trim($_POST['Name']);
    $email   = trim($_POST['Email']);
    $contact = trim($_POST['PhoneNumber']);
    $message = trim($_POST['Message']);

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO tbl_contactus (user_name, user_email, user_contact, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $contact, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error sending message!'); window.location.href='contact.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="contact">
   <div class="container">
      <div class="row">
         <!-- Contact Form -->
         <div class="col-md-6">
            <form id="request" method="POST" class="main_form">
               <div class="row">
                  <div class="col-md-12">
                     <input class="contactus" placeholder="Name" type="text" name="Name" 
                            value="<?php echo htmlspecialchars($userName); ?>"> 
                  </div>
                  <div class="col-md-12">
                     <input class="contactus" placeholder="Email" type="email" name="Email" 
                            value="<?php echo htmlspecialchars($userEmail); ?>"> 
                  </div>
                  <div class="col-md-12">
                     <input class="contactus" placeholder="Phone Number" type="text" name="PhoneNumber" 
                            value="<?php echo htmlspecialchars($userPhone); ?>">                          
                  </div>
                  <div class="col-md-12">
                     <textarea class="textarea" placeholder="Message" name="Message"></textarea>
                  </div>
                  <div class="col-md-12">
                     <button class="send_btn">Send</button>
                  </div>
               </div>
            </form>
         </div>

         <!-- Google Map -->
         <div class="col-md-6">
            <div class="map_main">
               <div class="map-responsive">
                  <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=hotel+casa+riva+gujarat+india" 
                          width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen="">
                  </iframe>
               </div>
            </div>
         </div>
      </div>
   </div> 
</div>