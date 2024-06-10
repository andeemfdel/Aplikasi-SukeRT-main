<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('sukeRT')
    ->setTitle('Laporan Pengajuan Surat');

// Add some data
  $sheet->setCellValue('A1', 'ID')
        ->setCellValue('B1', 'Tipe Ajuan')
        ->setCellValue('C1', 'Nama')
        ->setCellValue('D1', 'Tempat Lahir')
        ->setCellValue('E1', 'Tanggal Lahir')
        ->setCellValue('F1', 'Jenis Kelamin')
        ->setCellValue('G1', 'Agama')
        ->setCellValue('H1', 'Pekerjaan')
        ->setCellValue('I1', 'Kewarganegaraan')
        ->setCellValue('J1', 'Status Pernikahan')
        ->setCellValue('K1', 'No. NIK')
        ->setCellValue('L1', 'RT/RW')
        ->setCellValue('M1', 'Alamat')
        ->setCellValue('N1', 'Alasan');

// Fetch data from database
$sql = "SELECT * FROM tb_surat";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowNumber = 2; // Start in cell A2
    while($row = $result->fetch_assoc()) {
      $sheet->setCellValue('A' . $rowNumber, $row['id'])
            ->setCellValue('B' . $rowNumber, $row['tipe_ajuan'])
            ->setCellValue('C' . $rowNumber, $row['nama'])
            ->setCellValue('D' . $rowNumber, $row['ttl_tempat'])
            ->setCellValue('E' . $rowNumber, $row['ttl_tanggal'])
            ->setCellValue('F' . $rowNumber, $row['jenis_kelamin'])
            ->setCellValue('G' . $rowNumber, $row['agama'])
            ->setCellValue('H' . $rowNumber, $row['pekerjaan'])
            ->setCellValue('I' . $rowNumber, $row['kewarganegaraan'])
            ->setCellValue('J' . $rowNumber, $row['status_pernikahan'])
            ->setCellValue('K' . $rowNumber, $row['nik'])
            ->setCellValue('L' . $rowNumber, $row['rt_rw'])
            ->setCellValue('M' . $rowNumber, $row['alamat'])
            ->setCellValue('N' . $rowNumber, $row['alasan']);
        $rowNumber++;
    }
}

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_Pengajuan_Surat.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
