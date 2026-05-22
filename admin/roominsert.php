<?php
ob_start(); // Output buffer start - prevents "headers already sent" error
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_name  = mysqli_real_escape_string($conn, $_POST['room_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $rent       = (float) $_POST['rent'];
    $status     = mysqli_real_escape_string($conn, $_POST['status']);
    $facilities = mysqli_real_escape_string($conn, $_POST['facilities']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO rooms (room_name, description, rent, status, facilities, image) 
                    VALUES ('$room_name', '$description', '$rent', '$status', '$facilities', '$image_name')";

            if (mysqli_query($conn, $sql)) {
                header("Location: roominsert.php?success=1");
                exit;
            } else {
                header("Location: roominsert.php?error=" . urlencode(mysqli_error($conn)));
                exit;
            }
        } else {
            header("Location: roominsert.php?error=" . urlencode("Image upload failed"));
            exit;
        }
    } else {
        header("Location: roominsert.php?error=" . urlencode("No image uploaded"));
        exit;
    }
}
ob_end_flush(); // Output buffer end
?>

<?php include 'header.php'; ?>

<div class="container py-5 bg-dark text-light min-vh-100">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-secondary text-light shadow-lg border-0 rounded-4">
                <div class="card-header text-center fw-bold fs-4 border-0">
                    Add New Room
                </div>
                <div class="card-body">

                    <?php if (isset($_GET['success'])): ?>
                        <div id="alert-message" class="alert alert-success">Room added successfully! Redirecting...</div>
                        <script>
                            setTimeout(() => {
                                window.location.href = "roominsert.php";
                            }, 3000);
                        </script>
                    <?php elseif (isset($_GET['error'])): ?>
                        <div id="alert-message" class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                        <script>
                            setTimeout(() => {
                                document.getElementById('alert-message').style.display = 'none';
                            }, 3000);
                        </script>
                    <?php endif; ?>

                    <form action="roominsert.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Room Image</label>
                            <input type="file" class="form-control bg-dark text-light border-0" name="image" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Room Name</label>
                            <input type="text" class="form-control bg-dark text-light border-0" name="room_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control bg-dark text-light border-0" name="description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rent (₹)</label>
                            <input type="number" step="0.01" class="form-control bg-dark text-light border-0" name="rent" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select bg-dark text-light border-0" name="status">
                                <option value="Available">Available</option>
                                <option value="Booked">Booked</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Facilities</label>
                            <input type="text" class="form-control bg-dark text-light border-0" name="facilities">
                        </div>

                        <button type="submit" class="btn text-dark py-2 w-100" style="background-color:#BC1212;">Add Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
