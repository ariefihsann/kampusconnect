<?php
session_start();
include 'connectPhpToDb.php'; // koneksi DB

// Cek apakah form disubmit dengan method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari session
    $id_mahasiswa = $_SESSION['id_mahasiswa'] ?? null;
    $id_dosen = $_POST['id_dosen'] ?? null;
    $id_tugas = $_POST['id_tugas'] ?? null;



    if (!$id_mahasiswa) {
        echo "<script>alert('ID mahasiswa tidak ditemukan di session!'); window.history.back();</script>";
        exit();
    }
    if (!$id_dosen) {
        echo "<script>alert('ID dosen tidak ditemukan!'); window.history.back();</script>";
        exit();
    }
    if (!$id_tugas) {
        echo "<script>alert('ID tugas tidak ditemukan!'); window.history.back();</script>";
        exit();
    }


    // ID tugas harus ditentukan, bisa dari hidden input atau URL
    $id_tugas = $_POST['id_tugas'] ?? 1; // Default: 1 jika tidak ada
    $catatan = mysqli_real_escape_string($db, $_POST['catatan'] ?? '');

    // Validasi file
    if (isset($_FILES['lampiran_file']) && $_FILES['lampiran_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['lampiran_file'];
        $fileName = basename($file['name']);
        $fileSize = $file['size'];
        $fileTmp = $file['tmp_name'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['pdf', 'docx', 'zip'];

        if (!in_array($fileType, $allowed)) {
            echo "<script>alert('Format file tidak diizinkan!'); window.history.back();</script>";
            exit();
        }

        if ($fileSize > 10 * 1024 * 1024) { // 10MB
            echo "<script>alert('Ukuran file melebihi 10MB!'); window.history.back();</script>";
            exit();
        }

        // Buat nama unik untuk file
        $newFileName = uniqid('tugas_', true) . '.' . $fileType;
        $uploadDir = '../uploads/';
        $uploadPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($fileTmp, $uploadPath)) {
            echo "<script>alert('Gagal mengupload file!'); window.history.back();</script>";
            exit();
        }

        // Simpan data ke database
        $now = date('Y-m-d H:i:s');
        $waktu_pengumpulan = $now; // gunakan waktu saat ini
        $lampiran_file = $newFileName;
        $status_pengumpulan = 'terkumpul'; // atau status lain sesuai sistemmu
        $query = "INSERT INTO pengumpulan_tugas 
        (id_tugas, id_mahasiswa, waktu_pengumpulan, catatan, lampiran_file, status_pengumpulan,id_dosen) 
        VALUES 
        ('$id_tugas', '$id_mahasiswa', '$waktu_pengumpulan', '$catatan', '$lampiran_file', '$status_pengumpulan', '$id_dosen')";


        if (mysqli_query($db, $query)) {
            echo "<script>alert('Tugas berhasil dikumpulkan!'); window.location.href='mahasiswa/index.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data ke database: " . mysqli_error($db) . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('File tidak ditemukan atau gagal diunggah!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.history.back();</script>";
}
