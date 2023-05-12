<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
<<<<<<< HEAD
$connection = new mysqli ("localhost", "root", "", "db_peternakan");
=======
$connection = new mysqli ("localhost", "root", "", "db_absen");
>>>>>>> a310f9f1efd40fdc75347a01a1f0cfd9e82f288c

if ($connection->connect_error != null) {
    echo  "Gagal terhubung ke Database";
    die();
}
