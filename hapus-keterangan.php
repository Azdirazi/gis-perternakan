<?php

include "connection.php";
include "helper.php";
$id = $_GET['id'];

$connection->query("
    DELETE FROM keterangan WHERE id = '$id'
");

if ($connection->affected_rows > 0) {
    set_flash_message('add_success', 'Berhasil menghapus tahun');
} else {
    set_flash_message('add_failed', 'Gagal menghapus tahun');
}
return redirect('keterangan.php?halaman=keterangan');