<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_form'])) {
        $tipe_ajuan = $_POST['surat-keterangan'];
        $nama = $_POST['nama'];
        $ttl_tempat = $_POST['ttl_tempat'];
        $ttl_tanggal = $_POST['ttl_tanggal'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $agama = $_POST['agama'];
        $pekerjaan = $_POST['pekerjaan'];
        $kewarganegaraan = $_POST['kewarganegaraan'];
        $status_pernikahan = $_POST['status_pernikahan'];
        $nik = $_POST['nik'];
        $rt_rw = $_POST['rt_rw'];
        $alamat = $_POST['alamat'];
        $alasan = $_POST['alasan'];

        $sql = "INSERT INTO tb_surat (tipe_ajuan, nama, ttl, jenis_kelamin, agama, pekerjaan, kewarganegaraan, status_pernikahan, nik, rt_rw, alamat, alasan)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $tipe_ajuan, $nama, $ttl, $jenis_kelamin, $agama, $pekerjaan, $kewarganegaraan, $status_pernikahan, $nik, $rt_rw, $alamat, $alasan);

        if ($stmt->execute()) {
            echo "Data submitted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
    
    // Handle export request
    if (isset($_POST['export_data'])) {
        $filename = "data_export_" . date('Ymd') . ".xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $isPrintHeader = false;

        $result = $conn->query("SELECT * FROM tb_surat");

        if (!empty($result)) {
            foreach ($result as $row) {
                if (!$isPrintHeader) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        }

        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="submit-data">
        <h2>Submit Data</h2>
        <form action="submit_data.php" method="POST">
            <input type="hidden" name="submit_form" value="1">
            <!-- Form fields here -->
            <button type="submit">Submit</button>
        </form>

        <h2>Export Data</h2>
        <form action="submit_data.php" method="POST">
            <input type="hidden" name="export_data" value="1">
            <button type="submit">Export to Excel</button>
        </form>
    </section>
</body>
</html>
