<?php
session_start();
include 'connectPhpToDb.php';

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($db, $_POST['nama']);
    $nrp      = mysqli_real_escape_string($db, $_POST['nrp']);
    $gender   = mysqli_real_escape_string($db, $_POST['gender']);
    $prodi    = mysqli_real_escape_string($db, $_POST['prodi']);
    $fakultas = mysqli_real_escape_string($db, $_POST['fakultas']);

    // Simpan ke tabel mahasiswa
    $query = "INSERT INTO mahasiswa (nama, nrp, jenis_kelamin, prodi, fakultas)
              VALUES ('$nama', '$nrp', '$gender', '$prodi', '$fakultas')";

    if (mysqli_query($db, $query)) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location='register.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar: " . mysqli_error($db) . "'); window.location='register.php';</script>";
    }
}
