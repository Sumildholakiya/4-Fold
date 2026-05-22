<?php
include 'header.php';
include 'db.php';

// Delete room
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $deleteQuery = "DELETE FROM rooms WHERE id=$id";
    mysqli_query($conn, $deleteQuery);
    echo "<div class='alert alert-success text-center'>Room deleted successfully!</div>";
    echo "<meta http-equiv='refresh' content='2;url=roomupdate.php'>";
}

// Update room
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $room_number = $_POST['room_number'];
    $room_name = $_POST['room_name'];
    $description = $_POST['description'];
    $rent = $_POST['rent'];
    $status = $_POST['status'];
    $facilities = $_POST['facilities'];

    $updateQuery = "UPDATE rooms SET 
        room_number='$room_number',
        room_name='$room_name',
        description='$description',
        rent='$rent',
        status='$status',
        facilities='$facilities'
        WHERE id=$id";

    mysqli_query($conn, $updateQuery);
    echo "<div class='alert alert-success text-center'>Room updated successfully!</div>";
    echo "<meta http-equiv='refresh' content='2;url=roomupdate.php'>";
}

// Fetch rooms
$query = "SELECT * FROM rooms ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container my-4">
    <h2 class="text-center mb-4" style="color:#EB1616;">Manage Rooms</h2>
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle" style="background:#191C23;">
            <thead style="background:#0D0D0D; color:#EB1616;">
                <tr>
                    <th>ID</th>
                    <th>Room Name</th>
                    <th>Description</th>
                    <th>Rent</th>
                    <th>Status</th>
                    <th>Facilities</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <form method="POST">
                            <td><?= $row['id'] ?></td>
                            <td><input type="text" name="room_name" class="form-control form-control-sm bg-dark text-white"
                                    value="<?= $row['room_name'] ?>" disabled></td>
                            <td><textarea name="description" class="form-control form-control-sm bg-dark text-white"
                                    disabled><?= $row['description'] ?></textarea></td>
                            <td><input type="number" name="rent" class="form-control form-control-sm bg-dark text-white"
                                    value="<?= $row['rent'] ?>" disabled></td>
                            <td>
                                <select name="status" class="form-select form-select-sm bg-dark text-white" disabled>
                                    <option value="Available" <?= $row['status'] == 'Available' ? 'selected' : '' ?>>Available
                                    </option>
                                    <option value="Booked" <?= $row['status'] == 'Booked' ? 'selected' : '' ?>>Booked</option>
                                </select>
                            </td>
                            <td><input type="text" name="facilities" class="form-control form-control-sm bg-dark text-white"
                                    value="<?= $row['facilities'] ?>" disabled></td>
                            <td>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <!-- Edit/Save Button -->
                                <button type="button" class="btn btn-sm text-white" style="background:#EB1616;"
                                    onclick="enableEdit(this)">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <!-- Save Button (hidden until editing) -->
                                <button type="submit" name="update" class="btn btn-sm text-white d-none"
                                    style="background:#0D0D0D;">
                                    <i class="bi bi-save"></i>
                                </button>
                                <!-- Delete Button -->
                                <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure to delete this room?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </form>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function enableEdit(button) {
        let row = button.closest("tr");
        let inputs = row.querySelectorAll("input, textarea, select");
        inputs.forEach(el => el.removeAttribute("disabled"));

        // hide edit, show save
        button.classList.add("d-none");
        row.querySelector("button[type=submit]").classList.remove("d-none");

        // highlight row while editing
        row.style.backgroundColor = "#2a2a2a";
    }
</script>

<?php include 'footer.php'; ?>