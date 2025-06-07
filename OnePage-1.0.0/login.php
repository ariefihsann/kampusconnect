<?php
session_start();
include 'connectPhpToDb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = $_POST['pass'];
    $role = mysqli_real_escape_string($db, $_POST['role']);

    $query = "SELECT * FROM users WHERE email = '$email' AND role = '$role'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user['pass'])) {
            // Set session
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['id_user'] = $user['id_user']; // wajib

            $id_user = $user['id_user'];

            // Cek role dan ambil id sesuai role
            // Cek role dan ambil id sesuai role
            if ($user['role'] === 'mahasiswa') {
                $qMhs = mysqli_query($db, "SELECT id_mahasiswa FROM mahasiswa WHERE id_user = '$id_user'");
                if ($qMhs && mysqli_num_rows($qMhs) === 1) {
                    $mhs = mysqli_fetch_assoc($qMhs);
                    $_SESSION['id_mahasiswa'] = $mhs['id_mahasiswa'];
                } else {
                    echo "<script>alert('Data mahasiswa tidak ditemukan!'); window.history.back();</script>";
                    exit();
                }
            } elseif ($user['role'] === 'dosen') {
                $qDosen = mysqli_query($db, "SELECT id_dosen FROM datadosen WHERE id_user = '$id_user'");
                if ($qDosen && mysqli_num_rows($qDosen) === 1) {
                    $dosen = mysqli_fetch_assoc($qDosen);
                    $_SESSION['id_dosen'] = $dosen['id_dosen'];
                } else {
                    echo "<script>alert('Data dosen tidak ditemukan!'); window.history.back();</script>";
                    exit();
                }
            } elseif ($user['role'] === 'admin') {
                // Jika ada tabel admin dan ingin simpan id_admin
                $qAdmin = mysqli_query($db, "SELECT id_admin FROM admin WHERE id_user = '$id_user'");
                if ($qAdmin && mysqli_num_rows($qAdmin) === 1) {
                    $admin = mysqli_fetch_assoc($qAdmin);
                    $_SESSION['id_admin'] = $admin['id_admin'];
                }
                // Atau bisa dilewati jika tidak butuh
            }

            // Redirect sesuai role
            if ($user['role'] === 'admin') {
                header("Location: /upload/OnePage-1.0.0/admin/index.php");
            } elseif ($user['role'] === 'dosen') {
                header("Location: /upload/OnePage-1.0.0/dosen/index.php");
            } elseif ($user['role'] === 'mahasiswa') {
                header("Location: /upload/OnePage-1.0.0/mahasiswa/index.php");
            } else {
                echo "<script>alert('Role tidak dikenali!'); window.history.back();</script>";
            }
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Email atau Role tidak ditemukan!'); window.history.back();</script>";
    }
}
