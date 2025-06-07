<?php
$db = mysqli_connect('localhost', 'root', '', 'login_register_db');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
