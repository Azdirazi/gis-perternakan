<?php

include "connection.php";
include "helper.php";
$id_tahun = $_GET['id_tahun'];
$id_jenis = $_GET['id_jenis'];

$connection->query("
    DELETE FROM peternakan WHERE id_tahun = '$id_tahun' AND id_jenis = '$id_jenis'
");

if ($connection->affected_rows > 0) {
    set_flash_message('add_success', 'Berhasil menghapus Peternakan');
} else {
    set_flash_message('add_failed', 'Gagal menghapus Peternakan');
}
return redirect('peternakan.php?halaman=peternakan');