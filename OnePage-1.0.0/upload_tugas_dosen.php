<?php
include 'connectPhpToDb.php';
session_start(); // Jika pakai session login

// Proses saat form disubmit
if (isset($_POST['upload'])) {
    // Ambil data dari form
    $judul = mysqli_real_escape_string($db, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi']);
    $batas_waktu = mysqli_real_escape_string($db, $_POST['batas_waktu']);
    $id_dosen = 1; // Bisa juga: $_SESSION['id_dosen'];

    // Proses upload file
    $fileName = $_FILES['path']['name'];
    $fileTmp = $_FILES['path']['tmp_name'];
    $uploadDir = "../uploads/";
    $filePath = $uploadDir . basename($fileName);

    if (move_uploaded_file($fileTmp, $filePath)) {
        // Simpan ke database
        $query = "INSERT INTO tugas (judul, deskripsi, batas_waktu, path, id_dosen) 
                  VALUES ('$judul', '$deskripsi', '$batas_waktu', '$filePath', '$id_dosen')";

        if (mysqli_query($db, $query)) {
            // Redirect pakai JavaScript karena header() tidak boleh dipakai setelah echo
            echo "<script>
                    alert('Tugas berhasil diunggah.');
                    window.location.href = '/upload/OnePage-1.0.0/admin/datakuliah.php?id_dosen=$id_dosen';
                  </script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($db);
        }
    } else {
        echo "Gagal mengunggah file.";
    }
}

// Tutup koneksi
mysqli_close($db);
