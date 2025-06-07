<?php
session_start();
include 'connectPhpToDb.php';

if (isset($_POST['register'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = $_POST['pass'];
    $nama = mysqli_real_escape_string($db, $_POST['nama']);

    $role = 'mahasiswa';

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $cek = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah digunakan!'); window.history.back();</script>";
        exit();
    }

    $query = "INSERT INTO users (nama, email, pass, role)
              VALUES ('$nama', '$email', '$hashed_pass', '$role')";
    $simpan = mysqli_query($db, $query);

    if ($simpan) {
        $id_user = mysqli_insert_id($db);

        $query_mhs = "INSERT INTO mahasiswa (id_user, nama, nrp)
                  VALUES ('$id_user', '$nama', '" . mysqli_real_escape_string($db, $_POST['nrp']) . "')";
        $simpan_mhs = mysqli_query($db, $query_mhs);

        if ($simpan_mhs) {
            echo "<script>alert('Pendaftaran berhasil!'); window.location='form_login.php';</script>";
        } else {
            $error_msg = addslashes(mysqli_error($db));
            echo "<script>alert('Gagal menyimpan ke tabel mahasiswa: $error_msg'); window.location='register.php';</script>";
        }

        echo "<script>alert('Pendaftaran berhasil!'); window.location='form_login.php';</script>";
    } else {
        $error_msg = addslashes(mysqli_error($db));
        echo "<script>alert('Gagal mendaftar: $error_msg'); window.location='register.php';</script>";
    }
}
