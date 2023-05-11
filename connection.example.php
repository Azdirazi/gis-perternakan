<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$connection = new mysqli ("localhost", "root", "", "db_absen");

if ($connection->connect_error != null) {
    echo  "Gagal terhubung ke Database";
    die();
}
