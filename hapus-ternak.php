<?php

include 'connection.php';
include 'helper.php';

$id = $_GET['id'];

$connection->query("
    DELETE FROM ternak WHERE id = '$id'
");

return redirect('ternak.php?halaman=ternak');
