<?php
include('db.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet ->getActiveSheet();

$sheet ->setCellValue('A1' , 'Tipe Ajuan'); 
$sheet ->setCellValue('B1' , 'Nama Lengkap');
$sheet ->setCellValue('C1' , 'Tempat & Tanggal Lahir');
$sheet ->setCellValue('D1' , 'Jenis Kelamin');
$sheet ->setCellValue('E1' , 'Agama');
$sheet ->setCellValue('F1' , 'Pekerjaan');
$sheet ->setCellValue('G1' , 'Kewarganegaraan');
$sheet ->setCellValue('H1' , 'Status Pernikahan');
$sheet ->setCellValue('I1' , 'NO. NIK');
$sheet ->setCellValue('J1' , 'RT/RW');
$sheet ->setCellValue('K1' , 'Alamat');
$sheet ->setCellValue('L1' , 'Alasan Kebutuhan');

$data = mysqli_query($koneksi, "select * from tbl_surat");
$i = 1;
$no = 1;

while ($d = mysqli_fetch_array($data)) {
    $sheet ->setCellValue('A' , $i, $d['tipe_ajuan']);
    $sheet ->setCellValue('B' , $i, $d['Nama_lengkap']);
    $sheet ->setCellValue('C' , $i, $d['ttl']);
    $sheet ->setCellValue('D' , $i, $d['Kelamin']);
    $sheet ->setCellValue('E' , $i, $d['Agama']);
    $sheet ->setCellValue('F' , $i, $d['Pekerjaan']);
    $sheet ->setCellValue('G' , $i, $d['kwn']);
    $sheet ->setCellValue('H' , $i, $d['status-pernikahan']);
    $sheet ->setCellValue('I' , $i, $d['NIK']);
    $sheet ->setCellValue('J' , $i, $d['RT/RW']);
    $sheet ->setCellValue('K' , $i, $d['Alamat']);
    $sheet ->setCellValue('L' , $i, $d['Alasan_kebutuhan']);
    $i++;
}

$writer = new Xlsx($spreadsheet);
$writer ->save ('Data Ajuan.xlsx');
echo "<script>window.location = 'Data Ajuan.xlsx' </script>";

?>