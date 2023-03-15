<?php
$user = $profile[0];
$full_name = $user['f_name'] . " " . $user['l_name'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/assets/bootstrap5.3/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/admin_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="/assets/jquery/jquery-3.6.4.min.js"></script>
    <script src="/assets/bootstrap5.3/bootstrap.bundle.min.js"></script>
    <?php
    if (!empty($js)) {
        echo '<script src="' . $js . '"></script>';
    }
    ?>
</head>

<body>
    <header id="header_navbar" class="navbar navbar-light sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand text-center col-md-3 col-lg-2 me-0 px-3 fs-6" href="/"><img class="img-fluid" width="200" src="/assets/front/images/logo_white.png"></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav w-100 d-flex flex-row justify-content-between wrap px-md-5">
            <div class="nav-item text-nowrap">
                <p class="px-1" id="header_date"><i class="bi-calendar-fill"></i> <?php echo strtoupper(date("l, d M")); ?></p>
            </div>
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" id="header_right_btn" href="#">Settings<i class="bi-gear-fill"></i></a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="pt-3 d-none d-md-flex flex-column align-items-center">
                    <img class="img-fluid" width="90px" src="/images/avatar.png">
                    <span class="mt-2" id="sidenav_name"><?php echo $full_name; ?></span>
                    <span id="sidenav_id">Unique ID: <?php echo $this->session->userdata('bliss_id'); ?></span>
                </div>
                <div class="position-sticky sidebar-sticky d-flex align-items-center justify-content-center">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/admin">
                                <i class="bi-house-fill"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-person-fill-gear"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-bank2"></i>
                                Bank Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-share-fill"></i>
                                Invite Friends
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-calendar2-check-fill"></i>
                                Installments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-cash"></i>
                                Payment Proof
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/admin/DistributorLevelInformation">
                                <i class="bi-people-fill"></i>
                                Circle Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-info-circle-fill"></i>
                                Give Us Feedback
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/admin/logout">
                            <i class="bi-box-arrow-left"></i>
                            Logout
                        </a>
                    </li>
                </div>
            </nav>