<?php
session_start();
include 'connectPhpToDb.php';

// tambah data mahasiswa
if (isset($_POST['tambahDataMhs'])) {
    $simpan = mysqli_query($db, "INSERT INTO datalogin (nama, email,nrp,pass) 
                                 VALUES ('$_POST[nama]', 
                                 '$_POST[email]', 
                                 '$_POST[nrp]',
                                 '$_POST[pass]')");

    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Hash password

    if ($simpan) {
        echo "<script>
                alert('Data berhasil disimpan.'); 
               document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal disimpan.'); 
                document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    }
}
// end tambah data mahasiswa

// tambah data dosen
if (isset($_POST['tambahDataDsn'])) {
    $simpan = mysqli_query($db, "INSERT INTO datadosen (nama_dosen, email,nip, pass) 
                                 VALUES ('$_POST[nama_dosen]', 
                                 '$_POST[email]', 
                                 '$_POST[nip]', 
                                 '$_POST[pass]')");

    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Hash password

    if ($simpan) {
        echo "<script>
                alert('Data berhasil disimpan.'); 
               document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal disimpan.'); 
                document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    }
}
// end tambah data dosen

// hapus mahasiswa
if (isset($_POST['hapusDataMhs'])) {
    $hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE id_mahasiswa = '$_POST[id_mahasiswa]'");
    if ($hapus) {
        echo "<script>
                alert('Data berhasil dihapus.'); 
               document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal dihapus.'); 
                document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    }
}

// end hapus mahasiswa

// hapus dosen
if (isset($_POST['hapusDataDsn'])) {
    $hapus = mysqli_query($db, "DELETE FROM datadosen WHERE id = '$_POST[id]'");
    if ($hapus) {
        echo "<script>
                alert('Data berhasil dihapus.'); 
               document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal dihapus.'); 
                document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    }
}

// end hapus dosen

// ubah data mahasiswa

if (isset($_POST['ubahDataMhs'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama = $_POST['nama'];
    $nrp = $_POST['nrp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $prodi = $_POST['prodi'];
    $fakultas = $_POST['fakultas'];

    $update = "UPDATE mahasiswa SET 
                nama='$nama', 
                nrp='$nrp', 
                jenis_kelamin='$jenis_kelamin', 
                prodi='$prodi', 
                fakultas='$fakultas' 
               WHERE id_mahasiswa='$id_mahasiswa'";

    mysqli_query($db, $update);

    if (mysqli_affected_rows($db) > 0) {
        echo "<script>alert('Data berhasil diubah.'); document.location= '/upload/OnePage-1.0.0/admin/index.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah.'); document.location= '/upload/OnePage-1.0.0/admin/index.php';</script>";
    }
}


// end ubah data mahasiswa

// ubah data dosen

if (isset($_POST['ubahDataDsn'])) {
    $id = $_POST['id'];
    $nama_dosen = $_POST['nama_dosen'];
    $nip = $_POST['nip'];
    $email = $_POST['email'];
    $update = "UPDATE datadosen SET nama_dosen='$nama_dosen', email='$email', nip='$nip'";
    if (!empty($_POST['pass'])) {
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $update .= ", pass='$pass'";
    }
    $update .= " WHERE id='$id'";
    mysqli_query($db, $update);

    if (mysqli_affected_rows($db) > 0) {
        echo "<script>
                alert('Data berhasil diubah.'); 
               document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal diubah.'); 
                document.location= '/upload/OnePage-1.0.0/admin/index.php';
              </script>";
        exit();
    }
}
// end ubah data dosen