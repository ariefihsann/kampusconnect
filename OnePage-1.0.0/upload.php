<?php
session_start();
include 'connectPhpToDb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($db, $_POST['judul'] ?? '');
    $deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi'] ?? '');
    $uploader = mysqli_real_escape_string($db, $_POST['uploader'] ?? 'Anonim');
    $tanggal_upload = date("Y-m-d");

    $targetDir = "../uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFile = $targetDir . $fileName;
    $fileSize = $_FILES["file"]["size"];

    // Buat folder kalau belum ada
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $query = "INSERT INTO uploads (nama_file, ukuran_file, judul, deskripsi, uploader, tanggal_upload, path)
                  VALUES ('$fileName', $fileSize, '$judul', '$deskripsi', '$uploader', '$tanggal_upload', '$targetFile')";

        if (mysqli_query($db, $query)) {
            $_SESSION['upload_success'] = true;
        } else {
            $_SESSION['upload_error'] = "Gagal menyimpan ke database: " . mysqli_error($db);
        }
    } else {
        $_SESSION['upload_error'] = "Gagal mengupload file.";
    }

    header("Location: /upload/OnePage-1.0.0/dosen/ui-buttons.php");
    exit;
}
