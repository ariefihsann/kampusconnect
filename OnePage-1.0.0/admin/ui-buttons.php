<?php
session_start();
include '../connectPhpToDb.php';
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Learning Platform - Materi</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/seodashlogo.png" />
  <link rel="stylesheet" href="node_modules/simplebar/dist/simplebar.min.css">
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

  <style>
    .file-card {
      transition: all 0.3s ease;
      height: 100%;
    }

    .file-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .file-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .file-badge {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .file-size {
      color: #6c757d;
      font-size: 0.85rem;
    }

    .search-box {
      max-width: 400px;
    }

    .filter-buttons .btn {
      margin-right: 5px;
      margin-bottom: 5px;
    }

    .file-upload-wrapper {
      position: relative;
    }

    .file-upload-wrapper input[type="file"] {
      padding: 10px;
      border: 2px dashed #dee2e6;
      border-radius: 8px;
      transition: all 0.3s;
    }

    .file-upload-wrapper input[type="file"]:hover {
      border-color: #0d6efd;
      background-color: #f8f9fa;
    }

    .modal-content {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #86b7fe;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .icon-circle {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .bg-light-primary {
      background-color: rgba(13, 110, 253, 0.1);
    }

    .modal-content {
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd !important;
    }

    .file-upload-wrapper input[type="file"]::file-selector-button {
      border: none;
      background: transparent;
      padding: 0;
      margin-right: 8px;
    }

    .border-bottom {
      border-bottom: 1px solid #dee2e6 !important;
    }

    .custom-file-upload {
      cursor: pointer;
      transition: all 0.2s ease;
      border: 1px dashed #0d6efd !important;
    }

    .custom-file-upload:hover {
      background-color: #f8f9fa;
      border-color: #0a58ca !important;
      color: #0a58ca;
    }
  </style>
</head>

<body>
  <!-- Body Wrapper -->
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
              <a class="sidebar-link active" href="./ui-buttons.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Materi</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-alerts.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:file-text-bold-duotone" class="fs-6"></iconify-icon>
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
                    <a href="./authentication-login.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid position-relative">

        <!-- Floating Upload Button -->
        <button type="button" class="btn btn-primary btn-lg rounded-circle" data-bs-toggle="modal"
          data-bs-target="#uploadModal"
          style="position: fixed; bottom: 40px; right: 40px; width: 60px; height: 60px; font-size: 28px; z-index: 999;">
          <i class="fas fa-upload"></i> <!-- Ikon upload (jika Font Awesome dipakai) -->
          +
        </button>

        <!-- Modal Upload File -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
              <form method="POST" action="/upload/OnePage-1.0.0/upload.php" enctype="multipart/form-data">
                <!-- Minimalist Header -->
                <div class="modal-header border-0 pb-0">
                  <div class="w-100 text-center">
                    <div class="icon-circle bg-light-primary mb-3 mx-auto">
                      <i class="bi bi-cloud-arrow-up text-primary fs-4"></i>
                    </div>
                    <h5 class="modal-title fs-5 fw-normal text-dark mb-4">Upload File Baru</h5>
                  </div>
                  <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                    aria-label="Tutup"></button>
                </div>

                <div class="modal-body px-4 pt-0">
                  <!-- Judul File -->
                  <div class="mb-4">
                    <label for="judul" class="form-label small text-muted mb-1">Judul File</label>
                    <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 py-2" id="judul"
                      name="judul" placeholder="Materi Minggu 1" required>
                    <div class="form-text small">Masukkan judul yang deskriptif</div>
                  </div>

                  <!-- Deskripsi -->
                  <div class="mb-4">
                    <label for="deskripsi" class="form-label small text-muted mb-1">Deskripsi</label>
                    <textarea class="form-control border-0 border-bottom rounded-0 px-0 py-2" id="deskripsi"
                      name="deskripsi" rows="2" placeholder="Pengantar Sistem Informasi" required></textarea>
                  </div>

                  <!-- Nama Pengunggah -->
                  <div class="mb-4">
                    <label for="uploader" class="form-label small text-muted mb-1">Nama Pengunggah</label>
                    <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 py-2" id="uploader"
                      name="uploader" placeholder="Dr. Ahmad Fauzi" required>
                  </div>

                  <!-- File Upload - Improved Version -->
                  <div class="mb-4">
                    <label class="form-label small text-muted mb-1">Pilih File</label>
                    <div class="file-upload-wrapper">
                      <label for="fileInput" class="custom-file-upload btn btn-outline-primary rounded-pill w-100 py-2">
                        <i class="bi bi-cloud-arrow-up me-2"></i>Pilih File
                      </label>
                      <input type="file" class="d-none" name="file" id="fileInput" required>
                      <div id="fileNameDisplay" class="small text-muted mt-2 text-center">Belum ada file dipilih</div>
                      <div class="form-text small mt-1 text-center">Format yang didukung: PDF, DOCX, PPTX, XLSX (Maks.
                        10MB)</div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                  <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    Batal
                  </button>
                  <button type="submit" class="btn btn-primary rounded-pill px-4">
                    Upload
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>



        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title fw-semibold mb-0">Materi Perkuliahan </h5>
          <div class="d-flex">
            <div class="input-group search-box">
              <input type="text" class="form-control" placeholder="Cari materi...">
              <button class="btn btn-primary" type="button">
                <i class="ti ti-search"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Filter Buttons -->
        <div class="card mb-4">
          <div class="card-body p-3">
            <div class="filter-buttons">
              <span class="me-2">Filter:</span>
              <button class="btn btn-outline-primary btn-sm active">Semua</button>
              <button class="btn btn-outline-primary btn-sm">PDF</button>
              <button class="btn btn-outline-primary btn-sm">Dokumen</button>
              <button class="btn btn-outline-primary btn-sm">Gambar</button>
              <button class="btn btn-outline-primary btn-sm">Presentasi</button>
              <button class="btn btn-outline-primary btn-sm">Video</button>
            </div>
          </div>
        </div>
        <!-- Pastikan sudah ada Bootstrap & MDB di halaman -->


        <!-- Materi Cards -->
        <div class="container mt-4">
          <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success'];
                                              unset($_SESSION['success']); ?></div>
          <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
          <?php endif; ?>

          <div class="row">
            <?php
            $query = mysqli_query($db, "SELECT * FROM uploads ORDER BY id DESC");
            while ($data = mysqli_fetch_assoc($query)) {
              $filename = $data['nama_file'];
              $filetype = pathinfo($filename, PATHINFO_EXTENSION);
              $sizeMB = round($data['ukuran_file'] / 1024 / 1024, 2);
              $uploader = $data['uploader'];
              $tanggal = date("d M Y", strtotime($data['tanggal_upload']));

              $icon = match ($filetype) {
                'pdf' => 'vscode-icons:file-type-pdf2',
                'doc', 'docx' => 'vscode-icons:file-type-word',
                'ppt', 'pptx' => 'vscode-icons:file-type-powerpoint',
                'xls', 'xlsx' => 'vscode-icons:file-type-excel',
                'jpg', 'jpeg', 'png' => 'vscode-icons:file-type-image',
                'txt' => 'vscode-icons:file-type-text',
                default => 'vscode-icons:file-type-text',
              };
            ?>
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card file-card" style="box-sizing: border-box ;">
                  <div class="card-body text-center">
                    <iconify-icon icon="<?= $icon ?>" style="font-size: 40px;"></iconify-icon>
                    <h5 class="card-title"><?= htmlspecialchars($data['judul']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($data['deskripsi']) ?></p>
                    <span class="text-muted"><?= $sizeMB ?> MB</span>
                    <div class="mt-5">
                      <a href="/upload/uploads/<?= $filename ?>" class="btn btn-primary btn-sm mt-3" target="_blank">Preview</a>
                      <a href="/upload/uploads/<?= $filename ?>" class="btn btn-success btn-sm mt-3" download>Download</a>
                    </div>
                  </div>
                  <div class="card-footer bg-light text-muted text-start">
                    <small>Uploader: <?= $uploader ?><br>Tanggal: <?= $tanggal ?></small>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>

        <div class="row">



        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Learning Platform © 2023</p>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Simple filter functionality
    document.querySelectorAll('.filter-buttons .btn').forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.filter-buttons .btn').forEach(btn => {
          btn.classList.remove('active');
        });

        // Add active class to clicked button
        this.classList.add('active');

        // Here you would typically filter the content
        // For this example, we'll just log the filter
        console.log('Filter by:', this.textContent.trim());
      });
    });


    document.getElementById('fileInput').addEventListener('change', function(e) {
      const fileNameDisplay = document.getElementById('fileNameDisplay');
      if (this.files.length > 0) {
        fileNameDisplay.textContent = this.files[0].name;
        fileNameDisplay.classList.remove('text-muted');
        fileNameDisplay.classList.add('text-primary');
      } else {
        fileNameDisplay.textContent = 'Belum ada file dipilih';
        fileNameDisplay.classList.remove('text-primary');
        fileNameDisplay.classList.add('text-muted');
      }
    });
  </script>
</body>

</html>