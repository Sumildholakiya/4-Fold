<?php
// Session start
session_start();



// Admin ka naam session se lo
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : "Admin";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>4 Fold Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/np/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Sidebar Start -->
        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <img src="img/logo.png" height="50" alt="logo">
                </a>
               

                <div class="navbar-nav w-100">

                    <!-- Dashboard -->
                    <a href="index.php"
                        class="nav-item mt-2 nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>">
                        <i class="fa fa-tachometer-alt"></i> Dashboard
                    </a>

                    <!-- Bookings -->
                    <a href="booking.php"
                        class="nav-item mt-2 nav-link <?= ($current_page == 'booking.php') ? 'active' : '' ?>">
                        <i class="fa fa-table"></i> Bookings
                    </a>

                    <!-- Insert Dropdown -->
                    <div class="nav-item dropdown mt-2">
                        <a href="#"
                            class="nav-link dropdown-toggle <?= ($current_page == 'roominsert.php' || $current_page == 'galleryinsert.php') ? 'active' : '' ?>"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-keyboard"></i> Insert
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="roominsert.php"
                                class="dropdown-item <?= ($current_page == 'roominsert.php') ? 'active' : '' ?>">
                                <i class="fa fa-bed me-2"></i> Room
                            </a>
                            <a href="galleryinsert.php"
                                class="dropdown-item <?= ($current_page == 'galleryinsert.php') ? 'active' : '' ?>">
                                <i class="fa fa-image me-2"></i> Gallery
                            </a>
                        </div>
                    </div>

                    <!-- Update Dropdown -->
                    <div class="nav-item dropdown mt-2">
                        <a href="#"
                            class="nav-link dropdown-toggle <?= ($current_page == 'roomupdate.php' || $current_page == 'galleryupdate.php') ? 'active' : '' ?>"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-edit"></i> Update
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="roomupdate.php"
                                class="dropdown-item <?= ($current_page == 'roomupdate.php') ? 'active' : '' ?>">
                                <i class="fa fa-bed me-2"></i> Room
                            </a>
                            <a href="galleryupdate.php"
                                class="dropdown-item <?= ($current_page == 'galleryupdate.php') ? 'active' : '' ?>">
                                <i class="fa fa-image me-2"></i> Gallery
                            </a>
                        </div>
                    </div>

                    <!-- Records Dropdown -->
                    <div class="nav-item dropdown mt-2">
                        <a href="#"
                            class="nav-link dropdown-toggle <?= ($current_page == 'query.php' || $current_page == 'newUser.php' || $current_page == 'users.php') ? 'active' : '' ?>"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-folder"></i> Records
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="query.php"
                                class="dropdown-item <?= ($current_page == 'query.php') ? 'active' : '' ?>">
                                <i class="fa fa-question-circle me-2"></i> User Queries
                            </a>
                            <a href="newUser.php"
                                class="dropdown-item <?= ($current_page == 'newUser.php') ? 'active' : '' ?>">
                                <i class="fa fa-user-plus me-2"></i> New Settlers
                            </a>
                            <a href="users.php"
                                class="dropdown-item <?= ($current_page == 'users.php') ? 'active' : '' ?>">
                                <i class="fa fa-users me-2"></i> Users
                            </a>
                        </div>
                    </div>

                </div>



            </nav>
        </div>

        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.png" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">4 FOLD</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="../login.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->