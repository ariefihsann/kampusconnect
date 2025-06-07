<?php
session_start();
include '../connectPhpToDb.php';

if (isset($_GET['id_dosen'])) {
    $id_dosen = mysqli_real_escape_string($db, $_GET['id_dosen']);
    $sql = "SELECT * FROM datadosen WHERE id_dosen = '$id_dosen' LIMIT 1";
    $result = mysqli_query($db, $sql);

    // tampil data tugas
    $id_dosen = mysqli_real_escape_string($db, $_GET['id_dosen']);
    $query_tugas = "SELECT * FROM tugas WHERE id_dosen = '$id_dosen' ORDER BY batas_waktu DESC";
    $result_tugas = mysqli_query($db, $query_tugas);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $nama_dosen = $row['nama_dosen'];
        $nip = $row['nip'];
        $hari = $row['hari'];
        $jam_mulai = date("H:i", strtotime($row['jam_mulai']));
        $jam_selesai = date("H:i", strtotime($row['jam_selesai']));
        $mata_kuliah = $row['mata_kuliah'];
    } else {
        echo "<div class='alert alert-danger'>Data dosen tidak ditemukan.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-warning'>ID tidak tersedia di URL.</div>";
    exit;
}

$sql_presensi = "SELECT * FROM presensi_status
                 JOIN datadosen ON presensi_status.id_dosen = datadosen.id_dosen
                 WHERE presensi_status.id_dosen = '$id_dosen' 
                 ORDER BY tanggal DESC, waktu_tutup DESC 
                 LIMIT 1";

$result_presensi = mysqli_query($db, $sql_presensi);
if ($result_presensi && mysqli_num_rows($result_presensi) > 0) {
    $row_presensi = mysqli_fetch_assoc($result_presensi);
    $presensi_terakhir = $row_presensi['tanggal'] . ' ' . $row_presensi['waktu_tutup'];
} else {
    $presensi_terakhir = "Belum ada data presensi";
}

// daftar pengumpulan tugas
if (isset($_GET['id_dosen'])) {
    $id_dosen = mysqli_real_escape_string($db, $_GET['id_dosen']);
    $query = "SELECT * FROM tugas WHERE id_dosen = '$id_dosen' ORDER BY batas_waktu DESC";
    $result = mysqli_query($db, $query);
}

// riwayat
$id_mahasiswa = isset($_GET['id_mahasiswa']) ? $_GET['id_mahasiswa'] : null;

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
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card shadow-sm border-0 animate__animated animate__fadeIn">
                                            <!-- TAMPILAN HTML -->
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <div class="card shadow-sm border-0 animate__animated animate__fadeIn">
                                                        <div class="card-header bg-gradient-primary text-white">
                                                            <h5 class="card-title mb-0"><?= htmlspecialchars($mata_kuliah) ?></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <!-- Dosen Information -->
                                                            <div class="row ">
                                                                <div class="col-md-6">
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <div class="bg-blue rounded-circle p-2 me-3">
                                                                            <iconify-icon icon="solar:user-bold-duotone" class="text-white fs-4"></iconify-icon>
                                                                        </div>
                                                                        <div>
                                                                            <p class="mb-1 fw-medium"><?= htmlspecialchars($nama_dosen) ?></p>
                                                                            <small class="text-muted">NIP: <?= htmlspecialchars($nip) ?></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <div class="bg-blue rounded-circle p-2 me-3">
                                                                            <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-white fs-4"></iconify-icon>
                                                                        </div>
                                                                        <div>

                                                                            <p class="mb-1 fw-medium"><?= htmlspecialchars($hari) ?> (<?= htmlspecialchars($jam_mulai) ?> - <?= htmlspecialchars($jam_selesai) ?>)</p>
                                                                            <small class="text-muted">Presensi terakhir: <?= htmlspecialchars($presensi_terakhir) ?></small>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Tambahkan konten lain di sini sesuai kebutuhan -->
                                                        </div>
                                                        <!-- Presensi Section -->
                                                        <div class="row mb-4 ms-2">
                                                            <div class="col-md-5 mb-3 ms-5  mb-md-0">
                                                                <div class="card border-0 shadow-sm h-100">
                                                                    <div class="card-header bg-light">
                                                                        <h6 class="mb-0">PRESENSI</h6>
                                                                    </div>
                                                                    <div class="card-body text-center py-4">
                                                                        <button class="btn btn-primary btn-hover-scale">
                                                                            <iconify-icon icon="solar:presentation-graph-bold-duotone" class="me-2"></iconify-icon>
                                                                            Conference ETHOL
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 mb-3 ms-5 mb-md-0">
                                                                <div class="card border-0 shadow-sm h-100">
                                                                    <div class="card-header bg-light">
                                                                        <h6 class="mb-0">ATURAN PRESENSI</h6>
                                                                    </div>
                                                                    <div class="card-body text-center py-4">
                                                                        <button class="btn btn-outline-primary btn-hover-scale">
                                                                            <iconify-icon icon="solar:presentation-graph-bold-duotone" class="me-2"></iconify-icon>
                                                                            Conference Lainnya
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- History Presensi -->
                                    <?php
                                    // Pastikan koneksi $db dan $id_dosen sudah tersedia
                                    $tampil = mysqli_query($db, "SELECT * FROM presensi_status WHERE id_dosen = '$id_dosen' ORDER BY id DESC LIMIT 5");
                                    ?>

                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">History Presensi</h6>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    Rows per page: 5
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">5</a></li>
                                                    <li><a class="dropdown-item" href="#">10</a></li>
                                                    <li><a class="dropdown-item" href="#">20</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-2 ms-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">ID</th>
                                                            <th class="border-top-0">Tanggal</th>
                                                            <th class="border-top-0">Waktu Buka</th>
                                                            <th class="border-top-0">Waktu Tutup</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($row = mysqli_fetch_array($tampil)) : ?>
                                                            <tr>
                                                                <td><?= $row['id']; ?></td>
                                                                <td><?= $row['tanggal']; ?></td>
                                                                <td><?= $row['waktu_buka']; ?></td>
                                                                <td><?= $row['waktu_tutup']; ?></td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                            <small class="text-muted">1-5 of <?= mysqli_num_rows($tampil) ?></small>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary">&lt;&lt;</button>
                                                <button class="btn btn-sm btn-outline-secondary">&gt;</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Peserta Kuliah -->
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Peserta Kuliah</h6>
                                            <div class="input-group w-25">
                                                <span class="input-group-text bg-white border-end-0"><iconify-icon icon="solar:magnifer-bold-duotone"></iconify-icon></span>
                                                <input type="text" class="form-control border-start-0" placeholder="Cari...">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <div class="me-4">
                                                    <span class="badge bg-blue text-white">Laki-laki: 18</span>
                                                </div>
                                                <div class="me-4">
                                                    <span class="badge bg-pink text-white">Perempuan: 13</span>
                                                </div>
                                                <div>
                                                    <span class="badge bg-secondary">Total: 31</span>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>id</th>
                                                            <th>Nama</th>
                                                            <th>Nrp</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Example rows would go here -->
                                                        <tr>
                                                            <?php
                                                            $tampil = mysqli_query($db, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa ASC");
                                                            while ($row = mysqli_fetch_array($tampil)) :
                                                                $id_mahasiswa = $row['id_mahasiswa'];
                                                                $nama = $row['nama'];
                                                                $nrp = $row['nrp'];
                                                            ?>
                                                        <tr>
                                                            <td><?= $id_mahasiswa ?></td>
                                                            <td><?= htmlspecialchars($nama) ?></td>
                                                            <td><?= htmlspecialchars($nrp) ?></td>
                                                            <td class="text-center">
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add this section after the Presensi Section and before the History Presensi section -->
                                </div>
                                <!-- Improved Student Task Submission Section -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-1">PENGUMPULAN TUGAS MAHASISWA</h5>
                                                <small class="text-muted">Mata Kuliah: <?= htmlspecialchars($mata_kuliah) ?></small>
                                                <small class="text-muted"> | Dosen: <?= htmlspecialchars($nama_dosen) ?></small>
                                            </div>
                                            <div class="card-body p-4">

                                                <?php if (mysqli_num_rows($result) > 0): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($result)):
                                                        $id_tugas = $row['id_tugas'];
                                                        $judul = htmlspecialchars($row['judul']);
                                                        $deskripsi = htmlspecialchars($row['deskripsi']);
                                                        $batas_waktu = strtotime($row['batas_waktu']);
                                                        $file_path = $row['path'];
                                                        $file_name = basename($file_path);
                                                        $file_ext = strtoupper(pathinfo($file_name, PATHINFO_EXTENSION));
                                                        $file_size = file_exists($file_path) ? round(filesize($file_path) / 1048576, 2) . " MB" : "-";

                                                        $now = time();
                                                        $selisih = $batas_waktu - $now;
                                                        $sisa_hari = floor($selisih / (60 * 60 * 24));
                                                        $sisa_jam = floor(($selisih % (60 * 60 * 24)) / (60 * 60));
                                                        $sisa_waktu = $selisih > 0 ? "$sisa_hari hari $sisa_jam jam" : "Sudah lewat";
                                                    ?>
                                                        <div class="card mb-4 border-primary">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-8">
                                                                        <h5 class="text-primary mb-2"><?= $judul ?></h5>
                                                                        <div class="d-flex flex-wrap gap-3 mb-2">
                                                                            <span>
                                                                                <iconify-icon icon="solar:calendar-bold-duotone" class="me-2 text-muted"></iconify-icon>
                                                                                <small class="text-muted">Batas: <?= date("d M Y, H:i", $batas_waktu) ?> WIB</small>
                                                                            </span>
                                                                            <span>
                                                                                <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2 text-muted"></iconify-icon>
                                                                                <small class="text-muted">Sisa waktu: <?= $sisa_waktu ?></small>
                                                                            </span>
                                                                        </div>
                                                                        <p><?= $deskripsi ?></p>

                                                                        <div class="d-flex align-items-center">
                                                                            <iconify-icon icon="solar:file-bold-duotone" class="me-2 text-primary" width="24"></iconify-icon>
                                                                            <div>
                                                                                <div class="fw-medium"><?= $file_name ?></div>
                                                                                <small class="text-muted"><?= $file_size ?> • <?= $file_ext ?></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                                                        <div class="d-flex flex-column gap-2">
                                                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitAssignmentModal<?= $id_tugas ?>">
                                                                                <iconify-icon icon="solar:upload-square-bold-duotone" class="me-2"></iconify-icon>
                                                                                Kumpulkan Tugas
                                                                            </button>
                                                                            <a href="<?= $file_path ?>" class="btn btn-outline-primary" download>
                                                                                <iconify-icon icon="solar:download-bold-duotone" class="me-2"></iconify-icon>
                                                                                Download File
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Pengumpulan Tugas -->
                                                        <div class="modal fade" id="submitAssignmentModal<?= $id_tugas ?>" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <form method="post" action="../upload_tugas_mahasiswa.php" enctype="multipart/form-data">
                                                                        <div class="modal-header bg-light">
                                                                            <h5 class="modal-title">Pengumpulan Tugas</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="id_tugas" value="<?= $id_tugas ?>">
                                                                            <input type="hidden" name="id_dosen" value="<?= $row['id_dosen'] ?>">

                                                                            <div class="row mb-3">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Mata Kuliah</label>
                                                                                    <input type="text" class="form-control" value="<?= $mata_kuliah ?>" readonly>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Dosen Pengampu</label>
                                                                                    <input type="text" class="form-control" value="<?= $nama_dosen ?>" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label">Judul Tugas</label>
                                                                                <input type="text" class="form-control" value="<?= $judul ?>" readonly>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="catatan<?= $id_tugas ?>" class="form-label">Catatan (Opsional)</label>
                                                                                <textarea name="catatan" class="form-control" id="catatan<?= $id_tugas ?>" rows="3"></textarea>
                                                                            </div>

                                                                            <div class="mb-4">
                                                                                <label for="assignmentUpload<?= $id_tugas ?>" class="form-label">Upload File</label>
                                                                                <input type="file" name="lampiran_file" class="form-control" id="assignmentUpload<?= $id_tugas ?>" required>
                                                                                <div class="form-text">Format: .pdf, .docx, .zip (maks. 10MB)</div>
                                                                            </div>

                                                                            <div class="d-flex justify-content-between border-top pt-3">
                                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary">
                                                                                    <iconify-icon icon="solar:upload-square-bold-duotone" class="me-1"></iconify-icon>
                                                                                    Submit Tugas
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <div class="alert alert-info">Belum ada tugas yang tersedia.</div>
                                                <?php endif; ?>

                                                <?php

                                                // Ambil parameter
                                                $id_dosen = $_GET['id_dosen'];
                                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                                $per_page = 10;
                                                $offset = ($page - 1) * $per_page;

                                                // Filter dan pencarian
                                                $search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
                                                $status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

                                                // Query dasar
                                                $query = "SELECT pt.*, t.judul, m.nama AS nama_mahasiswa, m.nrp
                                            FROM pengumpulan_tugas pt
                                            JOIN tugas t ON pt.id_tugas = t.id_tugas
                                            JOIN mahasiswa m ON pt.id_mahasiswa = m.id_mahasiswa
                                            WHERE t.id_dosen = '$id_dosen'";

                                                // Tambahkan filter pencarian
                                                if (!empty($search)) {
                                                    $query .= " AND (m.nama LIKE '%$search%' OR t.judul LIKE '%$search%' OR m.nrp LIKE '%$search%')";
                                                }

                                                // Tambahkan filter status
                                                if ($status_filter !== 'all') {
                                                    if ($status_filter === 'unrated') {
                                                        $query .= " AND pt.nilai IS NULL";
                                                    } elseif ($status_filter === 'rated') {
                                                        $query .= " AND pt.nilai IS NOT NULL";
                                                    } elseif ($status_filter === 'late') {
                                                        $query .= " AND pt.status_pengumpulan = 'Terlambat'";
                                                    }
                                                }

                                                // Hitung total data
                                                $result_count = mysqli_query($db, $query);
                                                $total_rows = mysqli_num_rows($result_count);
                                                $total_pages = ceil($total_rows / $per_page);

                                                // Tambahkan sorting dan pagination
                                                $query .= " ORDER BY pt.waktu_pengumpulan DESC LIMIT $offset, $per_page";
                                                $result = mysqli_query($db, $query);
                                                ?>

                                                <div class="card border-0 shadow-sm mt-5">
                                                    <div class="card-header bg-light">
                                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                            <h5 class="mb-2">Daftar Pengumpulan Tugas Mahasiswa</h5>

                                                            <div class="d-flex flex-wrap gap-2">
                                                                <!-- Filter Status -->
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                        <iconify-icon icon="solar:filter-bold-duotone"></iconify-icon>
                                                                        Filter:
                                                                        <?= $status_filter === 'all' ? 'Semua' : (
                                                                            $status_filter === 'unrated' ? 'Belum Dinilai' : (
                                                                                $status_filter === 'rated' ? 'Sudah Dinilai' : 'Terlambat'
                                                                            )) ?>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item <?= $status_filter === 'all' ? 'active' : '' ?>"
                                                                                href="?id_dosen=<?= $id_dosen ?>&status=all">Semua</a></li>
                                                                        <li><a class="dropdown-item <?= $status_filter === 'unrated' ? 'active' : '' ?>"
                                                                                href="?id_dosen=<?= $id_dosen ?>&status=unrated">Belum Dinilai</a></li>
                                                                        <li><a class="dropdown-item <?= $status_filter === 'rated' ? 'active' : '' ?>"
                                                                                href="?id_dosen=<?= $id_dosen ?>&status=rated">Sudah Dinilai</a></li>
                                                                        <li><a class="dropdown-item <?= $status_filter === 'late' ? 'active' : '' ?>"
                                                                                href="?id_dosen=<?= $id_dosen ?>&status=late">Terlambat</a></li>
                                                                    </ul>
                                                                </div>

                                                                <!-- Search -->
                                                                <form method="get" class="input-group" style="width: 250px;">
                                                                    <input type="hidden" name="id_dosen" value="<?= $id_dosen ?>">
                                                                    <input type="hidden" name="status" value="<?= $status_filter ?>">
                                                                    <input type="text" class="form-control" name="search" placeholder="Cari mahasiswa/tugas..."
                                                                        value="<?= htmlspecialchars($search) ?>">
                                                                    <button class="btn btn-primary" type="submit">
                                                                        <iconify-icon icon="solar:magnifer-bold-duotone"></iconify-icon>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <!-- Tabs Navigation -->
                                                        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link <?= $status_filter === 'all' ? 'active' : '' ?>"
                                                                    onclick="window.location.href='?id_dosen=<?= $id_dosen ?>&status=all'">
                                                                    Semua <span class="badge bg-secondary"><?= $total_rows ?></span>
                                                                </button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link <?= $status_filter === 'unrated' ? 'active' : '' ?>"
                                                                    onclick="window.location.href='?id_dosen=<?= $id_dosen ?>&status=unrated'">
                                                                    Belum Dinilai <span class="badge bg-primary"><?= get_count($db, $id_dosen, 'unrated') ?></span>
                                                                </button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link <?= $status_filter === 'rated' ? 'active' : '' ?>"
                                                                    onclick="window.location.href='?id_dosen=<?= $id_dosen ?>&status=rated'">
                                                                    Sudah Dinilai <span class="badge bg-success"><?= get_count($db, $id_dosen, 'rated') ?></span>
                                                                </button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link <?= $status_filter === 'late' ? 'active' : '' ?>"
                                                                    onclick="window.location.href='?id_dosen=<?= $id_dosen ?>&status=late'">
                                                                    Terlambat <span class="badge bg-warning"><?= get_count($db, $id_dosen, 'late') ?></span>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover align-middle mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th width="20%">Mahasiswa</th>
                                                                        <th width="20%">Tugas</th>
                                                                        <th width="15%">Status</th>
                                                                        <th width="15%">Tanggal</th>
                                                                        <th width="10%">Nilai</th>
                                                                        <th width="20%" class="text-end pe-4">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (mysqli_num_rows($result) > 0): ?>
                                                                        <?php while ($row = mysqli_fetch_assoc($result)):
                                                                            $status = $row['status_pengumpulan'];
                                                                            $nilai = $row['nilai'] ?? '-';
                                                                            $badge_class = $nilai === '-' ? 'bg-primary' : 'bg-success';
                                                                        ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="bg-blue bg-opacity-10 rounded p-2 me-3">
                                                                                            <iconify-icon icon="solar:user-bold-duotone" class="text-blue"></iconify-icon>
                                                                                        </div>
                                                                                        <div>
                                                                                            <h6 class="mb-0"><?= htmlspecialchars($row['nama_mahasiswa']) ?></h6>
                                                                                            <small class="text-muted"><?= htmlspecialchars($row['nrp']) ?></small>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><?= htmlspecialchars($row['judul']) ?></td>
                                                                                <td>
                                                                                    <span class="badge <?= $badge_class ?> bg-opacity-10 text-<?= str_replace('bg-', '', $badge_class) ?>">
                                                                                        <?= $status ?>
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <?= date("d M Y, H:i", strtotime($row['waktu_pengumpulan'])) ?>
                                                                                    <small class="text-muted">WIB</small>
                                                                                </td>
                                                                                <td>
                                                                                    <span class="fw-bold <?= $nilai !== '-' ? 'text-success' : 'text-muted' ?>">
                                                                                        <?= $nilai ?>
                                                                                    </span>
                                                                                </td>
                                                                                <td class="text-end pe-4">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                                            <iconify-icon icon="solar:menu-dots-bold-duotone"></iconify-icon>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                                            <li>
                                                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal<?= $row['id_pengumpulan'] ?>">
                                                                                                    <iconify-icon icon="solar:eye-bold-duotone" class="me-2"></iconify-icon>
                                                                                                    Detail
                                                                                                </a>
                                                                                            </li>
                                                                                            <?php if ($nilai === '-'): ?>
                                                                                                <li>
                                                                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#nilaiModal<?= $row['id_pengumpulan'] ?>">
                                                                                                        <iconify-icon icon="solar:pen-bold-duotone" class="me-2"></iconify-icon>
                                                                                                        Beri Nilai
                                                                                                    </a>
                                                                                                </li>
                                                                                            <?php endif; ?>
                                                                                            <li>
                                                                                                <a class="dropdown-item" href="../uploads/<?= $row['lampiran_file'] ?>" download>
                                                                                                    <iconify-icon icon="solar:download-bold-duotone" class="me-2"></iconify-icon>
                                                                                                    Download
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php endwhile; ?>
                                                                    <?php else: ?>
                                                                        <tr>
                                                                            <td colspan="6" class="text-center py-5">
                                                                                <div class="py-4">
                                                                                    <iconify-icon icon="solar:file-text-bold-duotone" class="text-muted fs-1"></iconify-icon>
                                                                                    <h5 class="mt-3 text-muted">Tidak ada data pengumpulan</h5>
                                                                                    <p class="text-muted">Tidak ditemukan pengumpulan tugas dengan filter yang dipilih</p>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <!-- Pagination -->
                                                    <?php if ($total_pages > 1): ?>
                                                        <div class="card-footer bg-light">
                                                            <nav aria-label="Page navigation">
                                                                <ul class="pagination justify-content-center mb-0">
                                                                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                                                        <a class="page-link" href="?id_dosen=<?= $id_dosen ?>&status=<?= $status_filter ?>&search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">
                                                                            Previous
                                                                        </a>
                                                                    </li>

                                                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                                            <a class="page-link" href="?id_dosen=<?= $id_dosen ?>&status=<?= $status_filter ?>&search=<?= urlencode($search) ?>&page=<?= $i ?>">
                                                                                <?= $i ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endfor; ?>

                                                                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                                                        <a class="page-link" href="?id_dosen=<?= $id_dosen ?>&status=<?= $status_filter ?>&search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">
                                                                            Next
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Add this after the card closing tag but before the closing div -->
                                                <?php
                                                // Reset result pointer to loop again for modals
                                                mysqli_data_seek($result, 0);
                                                while ($row = mysqli_fetch_assoc($result)):
                                                ?>
                                                    <!-- Detail Modal -->
                                                    <div class="modal fade" id="detailModal<?= $row['id_pengumpulan'] ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailModalLabel">Detail Pengumpulan Tugas</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-4">
                                                                        <div class="col-md-6">
                                                                            <h6>Mahasiswa</h6>
                                                                            <p><?= htmlspecialchars($row['nama_mahasiswa']) ?> (<?= htmlspecialchars($row['nrp']) ?>)</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6>Tugas</h6>
                                                                            <p><?= htmlspecialchars($row['judul']) ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-4">
                                                                        <div class="col-md-6">
                                                                            <h6>Status</h6>
                                                                            <p>
                                                                                <span class="badge <?= $row['nilai'] === null ? 'bg-primary' : 'bg-success' ?> bg-opacity-10 text-<?= $row['nilai'] === null ? 'primary' : 'success' ?>">
                                                                                    <?= $row['status_pengumpulan'] ?>
                                                                                </span>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6>Tanggal Pengumpulan</h6>
                                                                            <p><?= date("d M Y, H:i", strtotime($row['waktu_pengumpulan'])) ?> WIB</p>
                                                                        </div>
                                                                    </div>

                                                                    <?php if (!empty($row['catatan'])): ?>
                                                                        <div class="mb-4">
                                                                            <h6>Catatan Mahasiswa</h6>
                                                                            <div class="border p-3 rounded bg-light">
                                                                                <?= nl2br(htmlspecialchars($row['catatan'])) ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <div class="mb-4">
                                                                        <h6>Lampiran</h6>
                                                                        <div class="d-flex align-items-center">
                                                                            <iconify-icon icon="solar:file-bold-duotone" class="fs-4 me-2"></iconify-icon>
                                                                            <a href="../uploads/<?= $row['lampiran_file'] ?>" download class="text-decoration-none">
                                                                                <?= htmlspecialchars($row['lampiran_file']) ?>
                                                                            </a>
                                                                            <span class="ms-2 text-muted">(<?= formatFileSize(filesize('../uploads/' . $row['lampiran_file'])) ?>)</span>
                                                                        </div>
                                                                    </div>

                                                                    <?php if ($row['nilai'] !== null): ?>
                                                                        <div class="mb-4">
                                                                            <h6>Nilai dan Feedback</h6>
                                                                            <div class="border p-3 rounded bg-light">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <p><strong>Nilai:</strong> <?= $row['nilai'] ?></p>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p><strong>Tanggal Penilaian:</strong> <?= date("d M Y, H:i", strtotime($row['waktu_penilaian'])) ?> WIB</p>
                                                                                    </div>
                                                                                </div>
                                                                                <?php if (!empty($row['feedback'])): ?>
                                                                                    <p><strong>Feedback:</strong></p>
                                                                                    <p><?= nl2br(htmlspecialchars($row['feedback'])) ?></p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                    <a href="../uploads/<?= $row['lampiran_file'] ?>" download class="btn btn-primary">
                                                                        <iconify-icon icon="solar:download-bold-duotone" class="me-1"></iconify-icon> Download
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Nilai Modal -->
                                                    <div class="modal fade" id="nilaiModal<?= $row['id_pengumpulan'] ?>" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="../process_nilai.php" method="post">
                                                                    <input type="hidden" name="id_pengumpulan" value="<?= $row['id_pengumpulan'] ?>">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="nilaiModalLabel">Beri Nilai</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="nilai" class="form-label">Nilai (0-100)</label>
                                                                            <input type="number" class="form-control" id="nilai" name="nilai" min="0" max="100" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>

                                                <?php
                                                // Helper function to format file size
                                                function formatFileSize($bytes)
                                                {
                                                    if ($bytes >= 1073741824) {
                                                        return number_format($bytes / 1073741824, 2) . ' GB';
                                                    } elseif ($bytes >= 1048576) {
                                                        return number_format($bytes / 1048576, 2) . ' MB';
                                                    } elseif ($bytes >= 1024) {
                                                        return number_format($bytes / 1024, 2) . ' KB';
                                                    } elseif ($bytes > 1) {
                                                        return $bytes . ' bytes';
                                                    } elseif ($bytes == 1) {
                                                        return $bytes . ' byte';
                                                    } else {
                                                        return '0 bytes';
                                                    }
                                                }
                                                ?>

                                                <?php
                                                // Fungsi helper untuk menghitung jumlah berdasarkan status
                                                function get_count($db, $id_dosen, $type)
                                                {
                                                    $query = "SELECT COUNT(*) as total FROM pengumpulan_tugas pt
                                                        JOIN tugas t ON pt.id_tugas = t.id_tugas
                                                        WHERE t.id_dosen = '$id_dosen'";

                                                    if ($type === 'unrated') {
                                                        $query .= " AND pt.nilai IS NULL";
                                                    } elseif ($type === 'rated') {
                                                        $query .= " AND pt.nilai IS NOT NULL";
                                                    } elseif ($type === 'late') {
                                                        $query .= " AND pt.status_pengumpulan = 'Terlambat'";
                                                    }

                                                    $result = mysqli_query($db, $query);
                                                    $row = mysqli_fetch_assoc($result);
                                                    return $row['total'];
                                                }
                                                ?>

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