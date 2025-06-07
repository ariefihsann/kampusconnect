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
                                                                <div class="d-flex justify-content-center gap-2">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $id_mahasiswa ?>">
                                                                        Ubah
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $id_mahasiswa ?>">
                                                                        Hapus
                                                                    </button>
                                                                </div>
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
                                    <div class="row mb-4 ms-2">
                                        <div class="col-12">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0">UPLOAD TUGAS</h6>
                                                </div>
                                                <div class="card-body">
                                                    <form action="../upload_tugas_dosen.php" method="post" enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label for="taskTitle" class="form-label">Judul Tugas</label>
                                                            <input type="text" name="judul" class="form-control" id="taskTitle" name="taskTitle" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="taskDescription" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsi" id="taskDescription" name="taskDescription" rows="3" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="dueDate" class="form-label">Batas Pengumpulan</label>
                                                            <input type="datetime-local" name="batas_waktu" class="form-control" id="dueDate" name="dueDate" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="taskFile" class="form-label">File Tugas (PDF/DOCX/PPT)</label>
                                                            <input type="file" name="path" class="form-control" id="taskFile" name="taskFile" accept=".pdf,.doc,.docx,.ppt,.pptx" required>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" name="upload" class="btn btn-primary">
                                                                <iconify-icon icon="solar:upload-square-bold-duotone" class="me-2"></iconify-icon>
                                                                Upload Tugas
                                                            </button>
                                                        </div>
                                                    </form>

                                                    <!-- List of uploaded tasks (optional) -->
                                                    <div class="mt-4">
                                                        <h6 class="mb-3">Daftar Tugas Terupload</h6>
                                                        <div class="list-group">
                                                            <?php if (isset($result_tugas) && mysqli_num_rows($result_tugas) > 0): ?>
                                                                <?php while ($tugas = mysqli_fetch_assoc($result_tugas)):
                                                                    // Format tanggal & ukuran file
                                                                    $judul = $tugas['judul'];
                                                                    $deskripsi = $tugas['deskripsi'];
                                                                    $batas_waktu = date('d M Y, H:i', strtotime($tugas['batas_waktu']));
                                                                    $file_path = $tugas['path'];
                                                                    $file_ext = strtoupper(pathinfo($file_path, PATHINFO_EXTENSION));
                                                                    $file_size = file_exists($file_path) ? round(filesize($file_path) / 1024, 1) . "KB" : "-";
                                                                ?>
                                                                    <a href="<?= $file_path ?>" target="_blank" class="list-group-item list-group-item-action">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h6 class="mb-1"><?= htmlspecialchars($judul) ?></h6>
                                                                            <small><?= $batas_waktu ?></small>
                                                                        </div>
                                                                        <p class="mb-1"><?= htmlspecialchars($deskripsi) ?></p>
                                                                        <small class="text-muted"><?= $file_ext ?>, <?= $file_size ?></small>
                                                                    </a>
                                                                <?php endwhile; ?>
                                                            <?php else: ?>
                                                                <div class="list-group-item">
                                                                    <p class="mb-0 text-muted">Belum ada tugas yang diunggah.</p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Improved Student Task Submission Section -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-1">PENGUMPULAN TUGAS MAHASISWA</h5>
                                                <small class="text-muted">Mata Kuliah: <?= htmlspecialchars($mata_kuliah) ?></small><small class="text-muted">| Dosen: <?= htmlspecialchars($nama_dosen) ?></small>
                                            </div>
                                            <div class="card-body p-4">

                                                <!-- Current Assignment Card -->
                                                <div class="card mb-4 border-primary">
                                                    <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
                                                        <?php while ($row = mysqli_fetch_assoc($result)):
                                                            $judul = htmlspecialchars($row['judul']);
                                                            $deskripsi = htmlspecialchars($row['deskripsi']);
                                                            $batas_waktu = strtotime($row['batas_waktu']);
                                                            $file_path = $row['path'];
                                                            $file_name = basename($file_path);
                                                            $file_ext = strtoupper(pathinfo($file_name, PATHINFO_EXTENSION));
                                                            $file_size = file_exists($file_path) ? round(filesize($file_path) / 1048576, 2) . " MB" : "-";
                                                            $now = time();

                                                            // Hitung sisa waktu
                                                            $selisih = $batas_waktu - $now;
                                                            $sisa_hari = floor($selisih / (60 * 60 * 24));
                                                            $sisa_jam = floor(($selisih % (60 * 60 * 24)) / (60 * 60));
                                                            $sisa_waktu = $selisih > 0 ? "$sisa_hari hari $sisa_jam jam" : "Sudah lewat";
                                                        ?>

                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-md-8">
                                                                            <h5 class="text-primary mb-2"><?= $judul ?></h5>
                                                                            <div class="d-flex flex-wrap gap-3 mb-2">
                                                                                <span class="d-flex align-items-center">
                                                                                    <iconify-icon icon="solar:calendar-bold-duotone" class="me-2 text-muted"></iconify-icon>
                                                                                    <small class="text-muted">Batas: <?= date("d M Y, H:i", $batas_waktu) ?> WIB</small>
                                                                                </span>
                                                                                <span class="d-flex align-items-center">
                                                                                    <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-2 text-muted"></iconify-icon>
                                                                                    <small class="text-muted">Sisa waktu: <?= $sisa_waktu ?></small>
                                                                                </span>
                                                                            </div>
                                                                            <p class="mb-3"><?= $deskripsi ?></p>

                                                                            <!-- Bagian File Lampiran -->
                                                                            <div class="file-attachment mb-3">
                                                                                <div class="d-flex align-items-center">
                                                                                    <iconify-icon icon="solar:file-bold-duotone" class="me-2 text-primary" width="24"></iconify-icon>
                                                                                    <div>
                                                                                        <div class="fw-medium"><?= $file_name ?></div>
                                                                                        <small class="text-muted"><?= $file_size ?> • <?= $file_ext ?></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                                                            <div class="d-flex flex-column gap-2">
                                                                                <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#submitAssignmentModal">
                                                                                    <iconify-icon icon="solar:upload-square-bold-duotone" class="me-2"></iconify-icon>
                                                                                    Kumpulkan Tugas
                                                                                </button>
                                                                                <a href="<?= $file_path ?>" class="btn btn-outline-primary px-4 py-2" download>
                                                                                    <iconify-icon icon="solar:download-bold-duotone" class="me-2"></iconify-icon>
                                                                                    Download File
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php endwhile; ?>
                                                    <?php else: ?>
                                                        <div class="alert alert-info">Belum ada tugas yang diunggah.</div>
                                                    <?php endif; ?>

                                                    <!-- Submission History -->
                                                    <!-- Submission History -->
                                                    <h6 class="mb-3 fw-semibold">Riwayat Pengumpulan</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover align-middle">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th width="30%">Tugas</th>
                                                                    <th width="20%">Status</th>
                                                                    <th width="20%">Tanggal</th>
                                                                    <th width="20%">File</th>
                                                                    <th width="10%">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <strong class="d-block">Tugas 1 - Layout HTML</strong>
                                                                        <small class="text-muted">Batas: 15 Juni 2023</small>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-success bg-opacity-10 text-success">Dinilai (85)</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="d-block">14 Juni 2023</span>
                                                                        <small class="text-muted">14:30 WIB</small>
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="d-flex align-items-center text-primary">
                                                                            <iconify-icon icon="solar:file-text-bold-duotone" class="me-1"></iconify-icon>
                                                                            tugas1_12345.pdf
                                                                        </a>
                                                                        <small class="text-muted">1.2 MB</small>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="btn-group" role="group">
                                                                            <button class="btn btn-sm btn-outline-primary px-3">
                                                                                Lihat
                                                                            </button>
                                                                            <a href="path/to/file/tugas1_12345.pdf" class="btn btn-sm btn-outline-success px-3" download>
                                                                                <iconify-icon icon="solar:download-bold-duotone"></iconify-icon>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong class="d-block">Tugas 2 - CRUD</strong>
                                                                        <small class="text-muted">Batas: 22 Juni 2023</small>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-warning bg-opacity-10 text-warning">Belum dikumpulkan</span>
                                                                    </td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td class="text-center">
                                                                        <button class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#submitAssignmentModal">
                                                                            Kumpulkan
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Submission Modal -->
                                                    <div class="modal fade" id="submitAssignmentModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h5 class="modal-title">Pengumpulan Tugas</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="assignmentForm">
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-6 mb-3 mb-md-0">
                                                                                <label class="form-label">Mata Kuliah</label>
                                                                                <input type="text" class="form-control" value="Pemrograman Web" readonly>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Dosen Pengampu</label>
                                                                                <input type="text" class="form-control" value="Dr. Ahmad S.T., M.Kom." readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Judul Tugas</label>
                                                                            <input type="text" class="form-control" value="Tugas 2 - Membuat Aplikasi CRUD" readonly>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="assignmentNotes" class="form-label">Catatan (Opsional)</label>
                                                                            <textarea id="assignmentNotes" name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan untuk dosen..."></textarea>
                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label for="assignmentUpload" class="form-label">Upload File Tugas</label>
                                                                            <input type="file" name="lampiran_file" class="form-control" id="assignmentUpload" required>
                                                                            <div class="form-text">Format yang diterima: .pdf, .docx, .zip (Maks. 10MB)</div>
                                                                        </div>

                                                                        <div class="d-flex justify-content-between border-top pt-3">
                                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                                <iconify-icon icon="solar:close-circle-bold-duotone" class="me-1"></iconify-icon>
                                                                                Batal
                                                                            </button>
                                                                            <button type="submit" class="btn btn-primary">
                                                                                <iconify-icon icon="solar:upload-square-bold-duotone" class="me-1"></iconify-icon>
                                                                                Submit Tugas
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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