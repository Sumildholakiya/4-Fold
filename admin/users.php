<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<style>
    body {
        background: linear-gradient(135deg, #0d1b2a, #1b263b);
        color: #fff;
    }
    .card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
    }
    .table thead {
        background-color: #181B23;

        color: white;
    }
    .table tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.05);
        transition: 0.3s;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="mb-0">Users List</h4>
        </div>
        <div class="card-body p-4">
            <table class="table table-bordered table-hover text-center align-middle text-white">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tbl_user";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['user_name']}</td>
                                    <td>{$row['user_email']}</td>
                                    <td>{$row['user_contact']}</td>
                                    <td>{$row['user_pass']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-muted'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
