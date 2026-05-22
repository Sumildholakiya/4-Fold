<?php
ob_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = mysqli_real_escape_string($conn, $_POST['caption']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/gallery/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO gallery (image, caption, created_at) 
                    VALUES ('$image_name', '$caption', NOW())";

            if (mysqli_query($conn, $sql)) {
                header("Location: galleryinsert.php?success=1");
                exit;
            } else {
                header("Location: galleryinsert.php?error=" . urlencode(mysqli_error($conn)));
                exit;
            }
        } else {
            header("Location: galleryinsert.php?error=" . urlencode("Image upload failed"));
            exit;
        }
    } else {
        header("Location: galleryinsert.php?error=" . urlencode("No image uploaded"));
        exit;
    }
}
ob_end_flush();
?>

<?php include 'header.php'; ?>

<div class="container py-5 bg-dark text-light min-vh-100">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-secondary text-light shadow-lg border-0 rounded-4">
                <div class="card-header text-center fw-bold fs-4 border-0">
                    Add Gallery Image
                </div>
                <div class="card-body">

                    <?php if (isset($_GET['success'])): ?>
                        <div id="alert-message" class="alert alert-success">Image added successfully! Redirecting...</div>
                    <?php elseif (isset($_GET['error'])): ?>
                        <div id="alert-message" class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                        <script>
                            setTimeout(() => {
                                document.getElementById('alert-message').style.display = 'none';
                            }, 3000);
                        </script>
                    <?php endif; ?>

                    <form action="galleryinsert.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Gallery Image</label>
                            <input type="file" class="form-control bg-dark text-light border-0" name="image" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Caption (Optional)</label>
                            <input type="text" class="form-control bg-dark text-light border-0" name="caption">
                        </div>

                        <button type="submit" class="btn text-dark py-2 w-100" style="background-color:#BC1212;">Add to
                            Gallery</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>