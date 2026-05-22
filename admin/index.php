<?php include 'header.php'; ?>
<?php
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
include 'db.php';

// Dashboard counts
$roomCount = $conn->query("SELECT COUNT(*) as total FROM rooms")->fetch_assoc()['total'];
$galleryCount = $conn->query("SELECT COUNT(*) as total FROM gallery")->fetch_assoc()['total'];
$bookingCount = $conn->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc()['total'];
$userCount = $conn->query("SELECT COUNT(*) as total FROM tbl_user")->fetch_assoc()['total'];
$queryCount = $conn->query("SELECT COUNT(*) as total FROM tbl_contactus")->fetch_assoc()['total'];

// Chart Data for last 7 days
$bookingChartLabels = [];
$bookingChartData = [];
$userChartLabels = [];
$userChartData = [];

for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $displayDate = date('d M', strtotime($date));

    // Bookings
    $bookingCountDay = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE DATE(created_at)='$date'")->fetch_assoc()['total'];
    $bookingChartLabels[] = $displayDate;
    $bookingChartData[] = $bookingCountDay;

    // Rooms Added
    $roomCountDay = $conn->query("SELECT COUNT(*) as total FROM rooms WHERE DATE(created_at)='$date'")->fetch_assoc()['total'];
    $userChartLabels[] = $displayDate;
    $userChartData[] = $roomCountDay;
}
?>

<!-- Dashboard Cards Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-bed fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Rooms</p>
                    <h6 class="mb-0"><?= $roomCount ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-image fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Gallery Images</p>
                    <h6 class="mb-0"><?= $galleryCount ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-calendar-check fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Bookings</p>
                    <h6 class="mb-0"><?= $bookingCount ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Registered Users</p>
                    <h6 class="mb-0"><?= $userCount ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard Cards End -->

<!-- Charts Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="bg-secondary text-center rounded p-4">
                <h6>Bookings Last 7 Days</h6>
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-secondary text-center rounded p-4">
                <h6>Rooms Added Last 7 Days</h6>
                <canvas id="userChart"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Charts End -->

<!-- Recent Bookings Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent Bookings</h6>
            <a href="booking.php">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th>User</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM bookings ORDER BY id DESC LIMIT 5");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['customer_name']}</td>
                                    <td>{$row['checkin_date']}</td>
                                    <td>{$row['checkout_date']}</td>
                                    <td>{$row['phone']}</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No recent bookings found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Bookings End -->

<!-- Recent Queries Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent User Queries</h6>
            <a href="query.php">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM tbl_contactus ORDER BY contact_id DESC LIMIT 5");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['user_name']}</td>
                                    <td>{$row['user_email']}</td>
                                    <td>{$row['user_contact']}</td>
                                    <td>{$row['message']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No queries found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Queries End -->

<?php include 'footer.php'; ?>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bookings Last 7 Days Line Chart
    const bookingChart = new Chart(document.getElementById('bookingChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($bookingChartLabels) ?>,
            datasets: [{
                label: 'Bookings',
                data: <?= json_encode($bookingChartData) ?>,
                borderColor: '#FF4C4C',
                backgroundColor: 'rgba(255,76,76,0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Rooms Added Last 7 Days Line Chart
    const userChart = new Chart(document.getElementById('userChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($userChartLabels) ?>,
            datasets: [{
                label: 'Rooms Added',
                data: <?= json_encode($userChartData) ?>,
                borderColor: '#36A2EB',
                backgroundColor: 'rgba(54,162,235,0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>