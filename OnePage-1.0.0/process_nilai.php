
<?php
session_start();
include 'connectPhpToDb.php'; // Pastikan file koneksi database sudah ada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    $id_pengumpulan = mysqli_real_escape_string($db, $_POST['id_pengumpulan']);
    $nilai = (int)$_POST['nilai'];

    // Validasi range nilai (0-100)
    if ($nilai < 0 || $nilai > 100) {
        $_SESSION['error'] = "Nilai harus antara 0-100";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Query update nilai
    $query = "UPDATE pengumpulan_tugas 
              SET nilai = '$nilai'
              WHERE id_pengumpulan = '$id_pengumpulan'";

    $result = mysqli_query($db, $query);

    if ($result) {
        $_SESSION['success'] = "Nilai berhasil disimpan!";
        echo "<div class='alert alert-success'>Nilai berhasil disimpan!</div>
              <script>
                alert('Nilai berhasil disimpan!');
              </script>";
    } else {
        $_SESSION['error'] = "Gagal menyimpan nilai: " . mysqli_error($db);
        echo "<div class='alert alert-danger'>Gagal menyimpan nilai: " . mysqli_error($db) . "</div>
              <script>
                alert('Gagal menyimpan nilai: " . mysqli_error($db) . "');
              </script>";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>