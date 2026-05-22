<?php
include 'header.php';
include 'db.php';

// Delete gallery image
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete = $conn->query("DELETE FROM gallery WHERE id=$id");
    if ($delete) {
        echo "<script>
            let msg = document.createElement('div');
            msg.innerHTML = 'Gallery item deleted successfully!';
            msg.style.position = 'fixed';
            msg.style.top = '20px';
            msg.style.right = '20px';
            msg.style.background = '#EB1616';
            msg.style.color = 'white';
            msg.style.padding = '10px 20px';
            msg.style.borderRadius = '8px';
            msg.style.zIndex = '9999';
            document.body.appendChild(msg);
            setTimeout(()=>msg.remove(),2000);
            setTimeout(()=>window.location.href='galleryupdate.php',1500);
        </script>";
    }
}

// Update gallery
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $caption = $conn->real_escape_string($_POST['caption']);

    $update = $conn->query("UPDATE gallery SET caption='$caption' WHERE id=$id");

    if ($update) {
        echo "<div class='alert alert-success text-center'>Gallery updated successfully!</div>";
        echo "<meta http-equiv='refresh' content='2;url=galleryupdate.php'>";
    }
}

// Fetch gallery records
$result = $conn->query("SELECT * FROM gallery ORDER BY created_at DESC");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4 text-light">Gallery Update</h2>
    <table class="table table-dark table-striped table-bordered text-center align-middle">
        <thead style="background:#EB1616; color:white;">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Caption</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <form method="POST">
                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <img src="uploads/gallery/<?php echo $row['image']; ?>"
                                alt="<?php echo htmlspecialchars($row['caption']); ?>" width="100" height="70"
                                class="rounded border border-2 border-secondary">

                        </td>
                        <td>
                            <input type="text" name="caption" value="<?php echo htmlspecialchars($row['caption']); ?>"
                                class="form-control bg-dark text-light" disabled>
                        </td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="button" class="btn btn-sm btn-warning editBtn">Edit</button>
                            <button type="submit" name="update"
                                class="btn btn-sm btn-success updateBtn d-none">Update</button>
                            <a href="galleryupdate.php?delete=<?php echo $row['id']; ?>"
                                onclick="return confirm('Are you sure to delete?')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    document.querySelectorAll(".editBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            let row = this.closest("tr");
            let input = row.querySelector("input[name='caption']");
            let updateBtn = row.querySelector(".updateBtn");

            input.removeAttribute("disabled");
            input.focus();
            updateBtn.classList.remove("d-none");
            this.classList.add("d-none");
        });
    });
</script>

<?php include 'footer.php'; ?>