<?php

include 'connection.php';
include 'helper.php';

$id = $_GET['id'];

$connection->query("
    DELETE FROM jenis WHERE id = '$id'
");

return redirect('jenis.php?halaman=jenis');
