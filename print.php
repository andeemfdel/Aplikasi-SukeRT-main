<?php
include('db.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet ->getActiveSheet();

$sheet ->setCellValue('A1' , 'Tipe Ajuan'); 
$sheet ->setCellValue('B1' , 'Nama Lengkap');
$sheet ->setCellValue('C1' , 'Tempat');
$sheet ->setCellValue('D1' , 'Tanggal Lahir');
$sheet ->setCellValue('E1' , 'Jenis Kelamin');
$sheet ->setCellValue('F1' , 'Agama');
$sheet ->setCellValue('G1' , 'Pekerjaan');
$sheet ->setCellValue('H1' , 'Kewarganegaraan');
$sheet ->setCellValue('I1' , 'Status Pernikahan');
$sheet ->setCellValue('J1' , 'NO. NIK');
$sheet ->setCellValue('K1' , 'RT/RW');
$sheet ->setCellValue('L1' , 'Alamat');
$sheet ->setCellValue('M1' , 'Alasan Kebutuhan');

$data = mysqli_query($koneksi, "select * from tbl_surat");
$i = 1;
$no = 1;

while ($d = mysqli_fetch_array($data)) {
    $sheet ->setCellValue('A' , $i, $d['tipe_ajuan']);
    $sheet ->setCellValue('B' , $i, $d['nama']);
    $sheet ->setCellValue('C' , $i, $d['ttl_tempat']);
    $sheet ->setCellValue('D' , $i, $d['ttl_tanggal']);
    $sheet ->setCellValue('E' , $i, $d['jenis_kelamin']);
    $sheet ->setCellValue('F' , $i, $d['agama']);
    $sheet ->setCellValue('G' , $i, $d['pekerjaan']);
    $sheet ->setCellValue('H' , $i, $d['kewarganegaraan']);
    $sheet ->setCellValue('I' , $i, $d['status_pernikahan']);
    $sheet ->setCellValue('J' , $i, $d['nik']);
    $sheet ->setCellValue('K' , $i, $d['rt_rw']);
    $sheet ->setCellValue('L' , $i, $d['alamat']);
    $sheet ->setCellValue('M' , $i, $d['alasan']);
    $i++;
}

$writer = new Xlsx($spreadsheet);
$writer ->save ('Data Ajuan.xlsx');
echo "<script>window.location = 'Data Ajuan.xlsx' </script>";

?>