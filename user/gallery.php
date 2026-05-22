<?php
session_start();
include 'db.php';

// ✅ Fetch all gallery images
$sql = "SELECT * FROM gallery ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Our Gallery</h2>
        <div class="row g-4">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-sm h-100">
                            <img src="../admin/uploads/gallery/<?php echo htmlspecialchars($row['image']); ?>" 
                                 class="card-img-top glryimg" alt="Gallery Image" style="height:250px; object-fit:cover;">
                            <div class="card-body text-center">
                                <?php if (!empty($row['caption'])): ?>
                                    <p class="card-text"><?php echo htmlspecialchars($row['caption']); ?></p>
                                <?php else: ?>
                                    <p class="card-text text-muted">No caption</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">No images available in the gallery.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
