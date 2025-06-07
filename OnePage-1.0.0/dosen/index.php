<?php
include '../connectPhpToDb.php';
session_start();

$query = "SELECT id, nama, nrp FROM datalogin";
$result = mysqli_query($db, $query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SeoDash Free Bootstrap Admin Template by Adminmart</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/seodashlogo.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />

  <style>
    .scrollable-table {
      max-height: 300px;
      overflow-y: auto;
    }

    .scrollable-table thead th {
      position: sticky;
      top: 0;
      background-color: white;
      z-index: 1;
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
          </ul>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                  Traffic Overview
                  <span>
                    <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                      data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                      data-bs-title="Traffic Overview"></iconify-icon>
                  </span>
                </h5>
                <div id="traffic-overview">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body text-center">
                <img src="assets/images/backgrounds/product-tip.png" alt="image" class="img-fluid" width="205">
                <h4 class="mt-7">Productivity Tips!</h4>
                <p class="card-subtitle mt-2 mb-3">Duis at orci justo nulla in libero id leo
                  molestie sodales phasellus justo.</p>
                <button class="btn btn-primary mb-3">View All Tips</button>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">

                <!-- selection table mahasiswa -->
                <h5 class="card-title">Data Mahasiswa</h5>

                <div class="table-responsive scrollable-table">
                  <table class="table text-nowrap align-middle mb-0">
                    <thead>
                      <tr class="border-2 border-bottom border-primary border-0">
                        <th scope="col" class="ps-0">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NRP</th>
                        <th scope="col" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-group-divider">
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

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="modalUbah<?= $id_mahasiswa ?>" tabindex="-1" aria-labelledby="modalUbahLabel<?= $id_mahasiswa ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="POST" action="../crud.php">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalUbahLabel<?= $id_mahasiswa ?>">Ubah Data Mahasiswa#<?= $id_mahasiswa ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id_mahasiswa" value="<?= $id_mahasiswa ?>">
                                  <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">NRP</label>
                                    <input type="text" class="form-control" name="nrp" value="<?= htmlspecialchars($nrp) ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="studentGender" class="form-label">Gender</label>
                                    <select class="form-select" id="studentGender" name="jenis_kelamin" required>
                                      <option value="" selected disabled>Select gender</option>
                                      <option value="L">L</option>
                                      <option value="P">P</option>
                                    </select>
                                  </div>
                                  <div class="mb-0">
                                    <label for="studentProgram" class="form-label">Study Program</label>
                                    <input type="text" class="form-control" id="studentProgram" name="prodi" placeholder="Enter your study Program" required>
                                  </div>
                                </div>
                                <div class="mb-3">
                                  <label for="studentFaculty" class="form-label ms-3">Faculty</label>
                                  <select class="form-select ms-3" id="studentFaculty" name="fakultas" style="max-width: 468px;" required>
                                    <option value="" selected disabled>Select faculty</option>
                                    <option value="engineering">Faculty of Engineering</option>
                                    <option value="science">Faculty of Science</option>
                                    <option value="economics">Faculty of Economics</option>
                                    <option value="social-politics">Faculty of Social & Political Sciences</option>
                                    <option value="arts">Faculty of Arts</option>
                                  </select>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success" name="ubahDataMhs">Simpan Perubahan</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="modalHapus<?= $id_mahasiswa ?>" tabindex="-1" aria-labelledby="modalHapusLabel<?= $id_mahasiswa ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="POST" action="../crud.php">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalHapusLabel<?= $id_mahasiswa_ ?>">Konfirmasi Hapus</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                  <p class="text-danger fw-bold"><?= htmlspecialchars($nama) ?> - <?= htmlspecialchars($email) ?></p>
                                  <input type="hidden" name="id_mahasiswa" value="<?= $id_mahasiswa ?>">
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger" name="hapusDataMhs">Ya, yakin</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>

                <!-- Button Tambah Data -->
                <div class="mt-3 mb-5">
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Data
                  </button>
                </div>

                <!-- Modal Tambah (Outside the loop) -->
                <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="POST" action="../crud.php">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTambahLabel">Tambah Data Mahasiswa</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">NRP</label>
                            <input type="text" class="form-control" name="nrp" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="tambahDataMhs">Simpan</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- akhir selection table mahasiswa -->

                <!-- selection table dosen-->
                <h5 class="card-title">Data dosen</h5>

                <div class="table-responsive scrollable-table">
                  <table class="table text-nowrap align-middle mb-0">
                    <thead>
                      <tr class="border-2 border-bottom border-primary border-0">
                        <th scope="col" class="ps-0">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIP</th>
                        <th scope="col" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-group-divider">
                      <?php
                      $tampil = mysqli_query($db, "SELECT * FROM datadosen ORDER BY id_dosen ASC");
                      while ($row = mysqli_fetch_array($tampil)) :
                        $id_dosen = $row['id_dosen'];
                        $nama_dosen = $row['nama_dosen'];
                        $nip = $row['nip'];
                        $email = $row['email'] ?? '';
                      ?>
                        <tr>
                          <td><?= $id_dosen ?></td>
                          <td><?= htmlspecialchars($nama_dosen) ?></td>
                          <td><?= htmlspecialchars($nip) ?></td>
                          <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUbahDosen<?= $id_dosen ?>">
                                Ubah
                              </button>
                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusDosen<?= $id_dosen ?>">
                                Hapus
                              </button>
                            </div>
                          </td>
                        </tr>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="modalUbahDosen<?= $id_dosen ?>" tabindex="-1" aria-labelledby="modalUbahLabel<?= $id_dosen ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="POST" action="../crud.php">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalUbahLabel<?= $id_dosen ?>">Ubah Data Dosen#<?= $id_dosen ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?= $id_dosen ?>">
                                  <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama_dosen" value="<?= htmlspecialchars($nama_dosen) ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="text" class="form-control" name="nip" value="<?= htmlspecialchars($nip) ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="pass" placeholder="Isi jika ingin ubah">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success" name="ubahDataDsn">Simpan Perubahan</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="modalHapusDosen<?= $id ?>" tabindex="-1" aria-labelledby="modalHapusLabel<?= $id ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="POST" action="../crud.php">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalHapusLabel<?= $id ?>">Konfirmasi Hapus</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                  <p class="text-danger fw-bold"><?= htmlspecialchars($nama_dosen) ?> - <?= htmlspecialchars($email) ?></p>
                                  <input type="hidden" name="id" value="<?= $id ?>">
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger" name="hapusDataDsn">Ya, yakin</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>

                <!-- Button Tambah Data -->
                <div class="mt-3 mb-5">
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahDosen">
                    Tambah Data
                  </button>
                </div>

                <!-- Modal Tambah (Outside the loop) -->
                <div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="POST" action="../crud.php">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTambahLabel">Tambah Data Dosen</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama_dosen" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Nip</label>
                            <input type="text" class="form-control" name="nrp" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="tambahDataDsn">Simpan</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- akhir selection table dosen -->





              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-5 pb-3">Sessions by
                  device<span><iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                      data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                      data-bs-title="Locations"></iconify-icon></span>
                </h5>
                <div class="row">
                  <div class="col-4">
                    <iconify-icon icon="solar:laptop-minimalistic-line-duotone"
                      class="fs-7 d-flex text-primary"></iconify-icon>
                    <span class="fs-11 mt-2 d-block text-nowrap">Computers</span>
                    <h4 class="mb-0 mt-1">87%</h4>
                  </div>
                  <div class="col-4">
                    <iconify-icon icon="solar:smartphone-line-duotone"
                      class="fs-7 d-flex text-secondary"></iconify-icon>
                    <span class="fs-11 mt-2 d-block text-nowrap">Smartphone</span>
                    <h4 class="mb-0 mt-1">9.2%</h4>
                  </div>
                  <div class="col-4">
                    <iconify-icon icon="solar:tablet-line-duotone" class="fs-7 d-flex text-success"></iconify-icon>
                    <span class="fs-11 mt-2 d-block text-nowrap">Tablets</span>
                    <h4 class="mb-0 mt-1">3.1%</h4>
                  </div>
                </div>

                <div class="vstack gap-4 mt-7 pt-2">
                  <div>
                    <div class="hstack justify-content-between">
                      <span class="fs-3 fw-medium">Computers</span>
                      <h6 class="fs-3 fw-medium text-dark lh-base mb-0">87%</h6>
                    </div>
                    <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75"
                      aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                  </div>

                  <div>
                    <div class="hstack justify-content-between">
                      <span class="fs-3 fw-medium">Smartphones</span>
                      <h6 class="fs-3 fw-medium text-dark lh-base mb-0">9.2%</h6>
                    </div>
                    <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75"
                      aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar bg-secondary" style="width: 50%"></div>
                    </div>
                  </div>

                  <div>
                    <div class="hstack justify-content-between">
                      <span class="fs-3 fw-medium">Tablets</span>
                      <h6 class="fs-3 fw-medium text-dark lh-base mb-0">3.1%</h6>
                    </div>
                    <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75"
                      aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar bg-success" style="width: 35%"></div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card overflow-hidden hover-img">
              <div class="position-relative">
                <a href="javascript:void(0)">
                  <img src="assets/images/blog/blog-img1.jpg" class="card-img-top" alt="matdash-img">
                </a>
                <span
                  class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                  min Read</span>
                <img src="assets/images/profile/user-3.jpg" alt="matdash-img"
                  class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40"
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
              </div>
              <div class="card-body p-4">
                <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Social</span>
                <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">As yen tumbles, gadget-loving
                  Japan goes
                  for secondhand iPhones</a>
                <div class="d-flex align-items-center gap-4">
                  <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-eye text-dark fs-5"></i>9,125
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-message-2 text-dark fs-5"></i>3
                  </div>
                  <div class="d-flex align-items-center fs-2 ms-auto">
                    <i class="ti ti-point text-dark"></i>Mon, Dec 19
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card overflow-hidden hover-img">
              <div class="position-relative">
                <a href="javascript:void(0)">
                  <img src="assets/images/blog/blog-img2.jpg" class="card-img-top" alt="matdash-img">
                </a>
                <span
                  class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                  min Read</span>
                <img src="assets/images/profile/user-2.jpg" alt="matdash-img"
                  class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40"
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
              </div>
              <div class="card-body p-4">
                <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Gadget</span>
                <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">Intel loses bid to revive
                  antitrust case
                  against patent foe Fortress</a>
                <div class="d-flex align-items-center gap-4">
                  <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-eye text-dark fs-5"></i>4,150
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-message-2 text-dark fs-5"></i>38
                  </div>
                  <div class="d-flex align-items-center fs-2 ms-auto">
                    <i class="ti ti-point text-dark"></i>Sun, Dec 18
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card overflow-hidden hover-img">
              <div class="position-relative">
                <a href="javascript:void(0)">
                  <img src="assets/images/blog/blog-img3.jpg" class="card-img-top" alt="matdash-img">
                </a>
                <span
                  class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                  min Read</span>
                <img src="assets/images/profile/user-3.jpg" alt="matdash-img"
                  class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40"
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
              </div>
              <div class="card-body p-4">
                <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Health</span>
                <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">COVID outbreak deepens as more
                  lockdowns
                  loom in China</a>
                <div class="d-flex align-items-center gap-4">
                  <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-eye text-dark fs-5"></i>9,480
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-message-2 text-dark fs-5"></i>12
                  </div>
                  <div class="d-flex align-items-center fs-2 ms-auto">
                    <i class="ti ti-point text-dark"></i>Sat, Dec 17
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                class="pe-1 text-primary text-decoration-underline">AdminMart.com</a>Distributed by <a
                href="https://themewagon.com/" target="_blank"
                class="pe-1 text-primary text-decoration-underline">ThemeWagon</a></p>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>