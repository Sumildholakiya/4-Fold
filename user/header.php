<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>4 FOLD</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
</head>

<body class="main-layout">
    <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.php">
                                        <img height="50px" src="images/logo.png" alt="Logo" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="col-xl-7 col-lg-7 col-md-8 col-sm-8">
                        <nav class="navigation navbar navbar-expand-md navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item <?= $currentPage == 'index.php' ? 'active' : '' ?>">
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item <?= $currentPage == 'about.php' ? 'active' : '' ?>">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                    <li class="nav-item <?= $currentPage == 'room.php' ? 'active' : '' ?>">
                                        <a class="nav-link" href="room.php">Our room</a>
                                    </li>
                                    <li class="nav-item <?= $currentPage == 'gallery.php' ? 'active' : '' ?>">
                                        <a class="nav-link" href="gallery.php">Gallery</a>
                                    </li>
                                    <li class="nav-item <?= $currentPage == 'contact.php' ? 'active' : '' ?>">
                                        <a class="nav-link" href="contact.php">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <!-- Auth/Profile Area -->
                    <div class="col-xl-3 col-lg-3 col-md-2 col-sm-2 mt-2">
                        <div class="d-flex justify-content-end align-items-center h-100">
                            <div class="auth-area">
                                <?php if (!empty($_SESSION['user']) && is_array($_SESSION['user'])): ?>
                                    <?php
                                    $userName = $_SESSION['user']['name'] ?? 'User';
                                    $userEmail = $_SESSION['user']['email'] ?? '';
                                    $userContact = $_SESSION['user']['contact'] ?? '';
                                    ?>
                                    <div class="profile-wrapper" onclick="toggleDropdown()">
                                        <span class="user-name">
                                            <?= htmlspecialchars($userName); ?>
                                        </span>
                                        <img src="images/profile-icon.png" alt="Profile" class="profile-icon" />
                                    </div>

                                    <div class="dropdown shadow rounded bg-white p-3 mt-2" id="profileDropdown"
                                        style="display: none; min-width: 250px; position: absolute; right: 0; z-index: 999;">
                                        <div class="mb-2">
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($userName); ?></div>
                                            <?php if ($userEmail): ?>
                                                <div class="text-muted small">✉️ <?= htmlspecialchars($userEmail); ?></div>
                                            <?php endif; ?>
                                            <?php if ($userContact): ?>
                                                <div class="text-muted small">📞 <?= htmlspecialchars($userContact); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <hr class="my-2">
                                        <a href="logout.php" class="btn auth-red border-red w-100">Logout</a>
                                    </div>
                                <?php else: ?>
                                    <a href="../login.php">
                                        <button class="log-btn">Login</button>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>