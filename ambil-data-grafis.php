<?php
include "function.php";

$tahun = $_GET['tahun'];
$jenis = $_GET['jenis'];

$hasil = hitung_k_means($tahun,$jenis)[0];

$data_polygon = [];
foreach ($hasil as $data) {
    $id_kecamatan = $data['id_kecamatan'];
    $warna = "";
    if ($data['kelas'] == "C1") {
        $warna = "#dc3545";
    }
    if ($data['kelas'] == "C2") {
        $warna = "#28a745";
    }
    if ($data['kelas'] == "C3") {
        $warna = "#007bff";
    }
    $kecamatan = $connection->query("
        SELECT *
        FROM kecamatan 
        WHERE id = '$id_kecamatan'
    ")->fetch_assoc();
    $data_polygon[] = [
        'id_kecamatan' => $id_kecamatan,
        'minimum' => $data['minimum'],
        'nama' => $kecamatan['nama'],
        'kelas'  => $data['kelas'],
        'polygon' => $kecamatan['polygon'],
        'warna' => $warna
    ];
}

echo json_encode($data_polygon);