<?php
include 'header.php';
include 'db.php';
?>

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
            <h4 class="mb-0"> New Settler Subscribers</h4>
        </div>
        <div class="card-body p-4">
            <table class="table table-bordered table-hover text-center align-middle text-white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Subscribed On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT settler_id, settler_email, DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at 
                            FROM tbl_newsettler 
                            ORDER BY settler_id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['settler_id']}</td>
                                    <td>{$row['settler_email']}</td>
                                    <td>{$row['created_at']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-muted'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
