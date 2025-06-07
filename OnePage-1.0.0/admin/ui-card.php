<?php
include '../connectPhpToDb.php';

$sql = "SELECT * FROM datadosen";
$result = mysqli_query($db, $sql);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Praktikum Web</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/seodashlogo.png" />
  <link rel="stylesheet" href="node_modules/simplebar/dist/simplebar.min.css">
  <link rel="stylesheet" href="assets/css/styles.min.css" />

  <style>
    .text-gradient-primary {
      background: linear-gradient(to right, #3b82f6, #8b5cf6);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Gradient Backgrounds */
    .bg-gradient-primary {
      background: linear-gradient(to right, #3b82f6, #8b5cf6);
    }

    .bg-gradient-info {
      background: linear-gradient(to right, #06b6d4, #3b82f6);
    }

    .bg-gradient-warning {
      background: linear-gradient(to right, #f59e0b, #ec4899);
    }

    .bg-gradient-danger {
      background: linear-gradient(to right, #ef4444, #f97316);
    }

    .bg-gradient-success {
      background: linear-gradient(to right, #10b981, #3b82f6);
    }

    .bg-gradient-secondary {
      background: linear-gradient(to right, #64748b, #475569);
    }

    /* Card Hover Effect */
    .course-card {
      transition: all 0.3s ease;
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .course-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Button Hover Effect */
    .btn-hover-scale {
      transition: all 0.3s ease;
    }

    .btn-hover-scale:hover {
      transform: scale(1.05);
    }

    /* Animate.css Delay */
    [data-animation-delay] {
      animation-delay: calc(var(--animate-delay) * ms);
    }

    * Minimalist Color Scheme */ .bg-blue {
      background-color: #3b82f6;
    }

    .bg-teal {
      background-color: #14b8a6;
    }

    .bg-amber {
      background-color: #f59e0b;
    }

    .bg-red {
      background-color: #ef4444;
    }

    .bg-green {
      background-color: #10b981;
    }

    .bg-gray {
      background-color: #6b7280;
    }

    .text-blue {
      color: #3b82f6;
    }

    .text-teal {
      color: #14b8a6;
    }

    .text-amber {
      color: #f59e0b;
    }

    .text-red {
      color: #ef4444;
    }

    .text-green {
      color: #10b981;
    }

    .text-gray {
      color: #6b7280;
    }

    .btn-outline-blue {
      border-color: #3b82f6;
      color: #3b82f6;
    }

    .btn-outline-teal {
      border-color: #14b8a6;
      color: #14b8a6;
    }

    .btn-outline-amber {
      border-color: #f59e0b;
      color: #f59e0b;
    }

    .btn-outline-red {
      border-color: #ef4444;
      color: #ef4444;
    }

    .btn-outline-green {
      border-color: #10b981;
      color: #10b981;
    }

    .btn-outline-gray {
      border-color: #6b7280;
      color: #6b7280;
    }

    /* Card Hover Effect */
    .course-card {
      transition: all 0.2s ease;
      border-radius: 8px;
    }

    .course-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* Button Hover Effect */
    .btn-outline-blue:hover {
      background-color: #3b82f6;
      color: white;
    }

    .btn-outline-teal:hover {
      background-color: #14b8a6;
      color: white;
    }

    .btn-outline-amber:hover {
      background-color: #f59e0b;
      color: white;
    }

    .btn-outline-red:hover {
      background-color: #ef4444;
      color: white;
    }

    .btn-outline-green:hover {
      background-color: #10b981;
      color: white;
    }

    .btn-outline-gray:hover {
      background-color: #6b7280;
      color: white;
    }

    /* Add these to your existing style section */
    .bg-pink {
      background-color: #ec4899;
    }

    .badge {
      padding: 0.35em 0.65em;
      font-weight: 500;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(59, 130, 246, 0.05);
    }

    .input-group-text {
      transition: all 0.3s ease;
    }

    .input-group:focus-within .input-group-text {
      color: #3b82f6;
    }

    .card-header {
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="assets/images/logos/logo-light.svg" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-buttons.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Materi</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-alerts.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:file-text-bold-duotone" fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Data Mata Kuliah</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Card</span>
              </a>
            </li>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="../form_login.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-gradient-primary">Daftar Mata Kuliah</h5>
              <div class="row g-4">

                <!-- Add this section below the existing course cards -->
              </div>

              <!-- Minimalist Course Cards -->
              <div class="row g-4 mb-3 mt-2">
                <!-- Matematika 2 -->
                <div class="col-lg-4 col-md-6">
                  <div class="card h-100 course-card border-0 shadow-sm animate__animated animate__fadeInUp" data-animation-delay="100">
                    <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center">
                      <h5 class="card-title mb-0">Pemrograman Web</h5>
                      <iconify-icon icon="fluent:math-formula-24-filled" class="fs-4"></iconify-icon>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div>
                          <p class="mb-0 fw-medium">Andhik Ampuh Yunanto S.Kom., M.Kom</p>
                          <small class="text-muted">Dosen Pengampu</small>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-blue mb-2">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2"></iconify-icon>
                        <span>Senin (13:50 - 15:30)</span>
                      </div>
                      <div class="d-flex align-items-center text-muted">
                        <iconify-icon icon="solar:map-point-wave-bold-duotone" class="me-2"></iconify-icon>
                        <span>Ruang C 102</span>
                      </div>
                    </div>
                    <div class="card-footer bg-light border-top-0 text-center py-3">
                      <a href="./datakuliah.php?id_dosen=<?= 1 ?>" class="btn btn-outline-blue btn-sm px-3">
                        <span class="d-flex align-items-center">
                          <span>Akses Kuliah</span>
                          <iconify-icon icon="mingcute:right-fill" class="ms-2 fs-5"></iconify-icon>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Sistem Operasi -->
                <div class="col-lg-4 col-md-6">
                  <div class="card h-100 course-card border-0 shadow-sm animate__animated animate__fadeInUp" data-animation-delay="200">
                    <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center">
                      <h5 class="card-title mb-0">Sistem Operasi</h5>
                      <iconify-icon icon="material-symbols:operating-system" class="fs-4"></iconify-icon>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div>
                          <p class="mb-0 fw-medium">Prof Iwan Syarif S.Kom., M.Kom., M.Sc., Ph.D</p>
                          <small class="text-muted">Dosen Pengampu</small>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-blue mb-2">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2"></iconify-icon>
                        <span>Selasa, 13:50 - 15:30</span>
                      </div>
                      <div class="d-flex align-items-center text-muted">
                        <iconify-icon icon="solar:map-point-wave-bold-duotone" class="me-2"></iconify-icon>
                        <span>Ruang B205</span>
                      </div>
                    </div>
                    <div class="card-footer bg-light border-top-0 text-center py-3">
                      <a href="./datakuliah.php?id_dosen=<?= 2 ?>" class="btn btn-outline-blue btn-sm px-3">
                        <span class="d-flex align-items-center">
                          <span>Akses Kuliah</span>
                          <iconify-icon icon="mingcute:right-fill" class="ms-2 fs-5"></iconify-icon>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Matematika 2 -->
                <div class="col-lg-4 col-md-6">
                  <div class="card h-100 course-card border-0 shadow-sm animate__animated animate__fadeInUp" data-animation-delay="100">
                    <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center">
                      <h5 class="card-title mb-0">Matematika 2</h5>
                      <iconify-icon icon="fluent:math-formula-24-filled" class="fs-4"></iconify-icon>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div>
                          <p class="mb-0 fw-medium">Rosiyah Faradisa S.Si, M.Si</p>
                          <small class="text-muted">Dosen Pengampu</small>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-blue mb-2">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2"></iconify-icon>
                        <span>Kamis, 11:20 - 13:00</span>
                      </div>
                      <div class="d-flex align-items-center text-muted">
                        <iconify-icon icon="solar:map-point-wave-bold-duotone" class="me-2"></iconify-icon>
                        <span>Ruang A304</span>
                      </div>
                    </div>
                    <div class="card-footer bg-light border-top-0 text-center py-3">
                      <a href="./datakuliah.php" class="btn btn-outline-blue btn-sm px-3">
                        <span class="d-flex align-items-center">
                          <span>Akses Kuliah</span>
                          <iconify-icon icon="mingcute:right-fill" class="ms-2 fs-5"></iconify-icon>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Matematika 2 -->
                <div class="col-lg-4 col-md-6">
                  <div class="card h-100 course-card border-0 shadow-sm animate__animated animate__fadeInUp" data-animation-delay="100">
                    <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center">
                      <h5 class="card-title mb-0">Matematika 2</h5>
                      <iconify-icon icon="fluent:math-formula-24-filled" class="fs-4"></iconify-icon>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div>
                          <p class="mb-0 fw-medium">Rosiyah Faradisa S.Si, M.Si</p>
                          <small class="text-muted">Dosen Pengampu</small>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-blue mb-2">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2"></iconify-icon>
                        <span>Kamis, 11:20 - 13:00</span>
                      </div>
                      <div class="d-flex align-items-center text-muted">
                        <iconify-icon icon="solar:map-point-wave-bold-duotone" class="me-2"></iconify-icon>
                        <span>Ruang A304</span>
                      </div>
                    </div>
                    <div class="card-footer bg-light border-top-0 text-center py-3">
                      <a href="./datakuliah.php" class="btn btn-outline-blue btn-sm px-3">
                        <span class="d-flex align-items-center">
                          <span>Akses Kuliah</span>
                          <iconify-icon icon="mingcute:right-fill" class="ms-2 fs-5"></iconify-icon>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Matematika 2 -->
                <div class="col-lg-4 col-md-6">
                  <div class="card h-100 course-card border-0 shadow-sm animate__animated animate__fadeInUp" data-animation-delay="100">
                    <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center">
                      <h5 class="card-title mb-0">Matematika 2</h5>
                      <iconify-icon icon="fluent:math-formula-24-filled" class="fs-4"></iconify-icon>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div>
                          <p class="mb-0 fw-medium">Rosiyah Faradisa S.Si, M.Si</p>
                          <small class="text-muted">Dosen Pengampu</small>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-blue mb-2">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2"></iconify-icon>
                        <span>Kamis, 11:20 - 13:00</span>
                      </div>
                      <div class="d-flex align-items-center text-muted">
                        <iconify-icon icon="solar:map-point-wave-bold-duotone" class="me-2"></iconify-icon>
                        <span>Ruang A304</span>
                      </div>
                    </div>
                    <div class="card-footer bg-light border-top-0 text-center py-3">
                      <a href="./datakuliah.php" class="btn btn-outline-blue btn-sm px-3">
                        <span class="d-flex align-items-center">
                          <span>Akses Kuliah</span>
                          <iconify-icon icon="mingcute:right-fill" class="ms-2 fs-5"></iconify-icon>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- Matematika 2 -->
                <div class="col-lg-4 col-md-6">
                  <div class="card h-100 course-card border-0 shadow-sm animate__animated animate__fadeInUp" data-animation-delay="100">
                    <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center">
                      <h5 class="card-title mb-0">Matematika 2</h5>
                      <iconify-icon icon="fluent:math-formula-24-filled" class="fs-4"></iconify-icon>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div>
                          <p class="mb-0 fw-medium">Rosiyah Faradisa S.Si, M.Si</p>
                          <small class="text-muted">Dosen Pengampu</small>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-blue mb-2">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2"></iconify-icon>
                        <span>Kamis, 11:20 - 13:00</span>
                      </div>
                      <div class="d-flex align-items-center text-muted">
                        <iconify-icon icon="solar:map-point-wave-bold-duotone" class="me-2"></iconify-icon>
                        <span>Ruang A304</span>
                      </div>
                    </div>
                    <div class="card-footer bg-light border-top-0 text-center py-3">
                      <a href="./datakuliah.php" class="btn btn-outline-blue btn-sm px-3">
                        <span class="d-flex align-items-center">
                          <span>Akses Kuliah</span>
                          <iconify-icon icon="mingcute:right-fill" class="ms-2 fs-5"></iconify-icon>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- end card table matkul -->

              </div>
            </div>
          </div>
          <script src="assets/libs/jquery/dist/jquery.min.js"></script>
          <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
          <script src="assets/libs/simplebar/dist/simplebar.js"></script>
          <script src="assets/js/sidebarmenu.js"></script>
          <script src="assets/js/app.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const courseCards = document.querySelectorAll('.course-card');

              courseCards.forEach(card => {
                const delay = card.getAttribute('data-animation-delay');
                card.style.setProperty('--animate-delay', delay);
              });
            });
          </script>
</body>

</html>