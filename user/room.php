<?php
session_start();
include 'db.php';

// Agar user login nahi hai to login page pe bhej do
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

// Cancel booking handle
if (isset($_POST['cancel_booking'])) {
    $room_id = intval($_POST['room_id']);
    $delete = mysqli_query($conn, "DELETE FROM bookings WHERE room_id='$room_id'");
    if ($delete) {
        mysqli_query($conn, "UPDATE rooms SET status='Available' WHERE id='$room_id'");
        $_SESSION['success_message'] = "Booking cancelled successfully!";
    }
    header("Location: room.php");
    exit();
}

// Booking success message
$success_message = "";
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Ab header.php include karo (baad me safe hai)
include 'header.php';
?>

<div class="back_re">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>Our Room</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- our_room -->
<div class="our_room">
    <div class="container">

        <?php if (!empty($success_message)) { ?>
            <div class="alert alert-success text-center">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <p class="margin_0">Book your perfect stay in comfort at 4Fold</p>
                </div>
            </div>
        </div>

        <div class="container my-4">
            <div class="row mb-5 g-4">
                <?php
                $sql = "SELECT * FROM rooms";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $room_id = $row['id'];

                        // Check booking status for this room
                        $booking_q = mysqli_query($conn, "SELECT * FROM bookings WHERE room_id='$room_id' LIMIT 1");
                        $booking = $booking_q ? mysqli_fetch_assoc($booking_q) : null;

                        // Can current user cancel? (match by name if available)
                        $can_cancel = false;
                        if ($booking && isset($_SESSION['user']['name'])) {
                            $can_cancel = (strcasecmp(trim($booking['customer_name']), trim($_SESSION['user']['name'])) === 0);
                        }
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card shadow-lg border-0 rounded-3 h-100">
                                <img src="/php4fold/admin/uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                    class="card-img-top rounded-top" style="height: 220px; object-fit: cover;"
                                    alt="<?php echo htmlspecialchars($row['room_name']); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="fw-bold text-dark"><?php echo htmlspecialchars($row['room_name']); ?></h4>
                                    <p class="text-secondary flex-grow-1 mb-2">
                                        <?php echo htmlspecialchars($row['description']); ?>
                                    </p>
                                    <p class="text-muted mb-1"><strong>Rent:</strong>
                                        ₹<?php echo htmlspecialchars($row['rent']); ?> / night</p>
                                    <p class="mb-1"><strong>Status:</strong>
                                        <span
                                            class="<?php echo ($row['status'] == 'Available' ? 'text-success' : 'text-danger'); ?> fw-bold">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </p>
                                    <p class="mb-2"><strong>Facilities:</strong>
                                        <?php echo htmlspecialchars($row['facilities']); ?></p>
                                    <?php if ($booking) { ?>
                                        <?php if ($can_cancel) { ?>
                                            <!-- Cancel button -->
                                            <form method="POST" class="mt-auto">
                                                <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                                                <button type="submit" name="cancel_booking" class="mybtn mybtn-cancel">
                                                    Cancel Booking
                                                </button>
                                            </form>
                                        <?php } else { ?>
                                            <!-- Already booked by someone else -->
                                            <button class="mybtn mybtn-booked" disabled>
                                                Booked
                                            </button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <!-- Book Now -->
                                        <a href="booking.php?room_id=<?php echo $room_id; ?>" class="mybtn mybtn-booknow">
                                            Book Now
                                        </a>
                                    <?php } ?>


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
</div>
<!-- end our_room -->

<?php include 'footer.php'; ?>