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
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#"><img class="img-fluid" src="/assets/front/images/logo_white.png"></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav w-100 d-flex flex-row justify-content-between wrap px-md-5">
            <div class="nav-item text-nowrap">
                <p class="px-3" id="header_date"><i class="bi-calendar-fill"></i> <?php echo strtoupper(date("l, d M")); ?></p>
            </div>
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" id="header_right_btn" href="#">Settings<i class="bi-gear-fill"></i></a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky d-flex align-items-center justify-content-center">
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
                                <i class="bi-share-fill"></i>
                                Invite Friends
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-bank2"></i>
                                Installments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-cash"></i>
                                Upload Payment Proof
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-people-fill"></i>
                                My Circle Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-info-circle-fill"></i>
                                Give Us Feedback
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <i class="bi-box-arrow-left"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>