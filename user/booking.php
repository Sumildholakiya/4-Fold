<?php
session_start();
include 'db.php';

// ✅ Session check
if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit();
}

// User info from session
$user_name = $_SESSION['user']['name'];
$user_email = $_SESSION['user']['email'];
$user_phone = $_SESSION['user']['contact'];

// ✅ Check if room_id provided
if (!isset($_GET['room_id'])) {
    header("Location: room.php");
    exit();
}

$room_id = intval($_GET['room_id']);

// ✅ Fetch room details
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();

if (!$room) {
    header("Location: room.php");
    exit();
}

// ✅ Handle booking form
if (isset($_POST['book_room'])) {
    $guests = $_POST['guests'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $stmt = $conn->prepare("
        INSERT INTO bookings 
        (room_id, room_number, customer_name, phone, guests, checkin_date, checkout_date, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param(
        "iississ",
        $room_id,
        $room['room_number'],
        $user_name,
        $user_phone,
        $guests,
        $check_in,
        $check_out
    );

    if ($stmt->execute()) {
        // ✅ Booking successful → Update room status
        $update = $conn->prepare("UPDATE rooms SET status = 'Booked' WHERE id = ?");
        $update->bind_param("i", $room_id);
        $update->execute();

        $_SESSION['success_message'] = "Room booked successfully!";
        header("Location: room.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <!-- Room Details -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <img src="../admin/uploads/<?php echo htmlspecialchars($room['image']); ?>" class="card-img-top"
                        alt="Room Image">
                    <div class="card-body">
                        <h4 class="card-title">Room <?php echo htmlspecialchars($room['room_number']); ?></h4>
                        <p class="card-text">
                            <strong>Price:</strong> ₹<?php echo htmlspecialchars($room['rent']); ?> / night<br>
                            <strong>Description:</strong> <?php echo htmlspecialchars($room['description']); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-3">Book This Room</h4>

                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>

                    <form method="POST">
                        <!-- User Info -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_name); ?>"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control"
                                value="<?php echo htmlspecialchars($user_email); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_phone); ?>"
                                readonly>
                        </div>

                        <!-- Booking Info -->
                        <div class="mb-3">
                            <label class="form-label">Guests</label>
                            <input type="number" name="guests" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Check-In Date</label>
                            <input type="date" name="check_in" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Check-Out Date</label>
                            <input type="date" name="check_out" class="form-control" required>
                        </div>

                        <button type="submit" name="book_room" class="btn btn-primary w-100">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>