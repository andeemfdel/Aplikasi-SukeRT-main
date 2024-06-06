<?php
// Include the database connection file
include 'db.php';

// Your query
$sql = "SELECT * FROM tb_surat"; // Replace 'table_name' with your actual table name
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // Process your data here
        echo "ID: " . $row["id"]. " Tipe Ajuan: " . $row["tipe_ajuan"].
        " - Nama: " . $row["nama"].
        " - Tempat Lahir : " . $row["ttl_tempat"]. 
        " - Tanggal Lahir: " . $row["ttl_tanggal"]. 
        " - Jenis Kelamin: " . $row["jenis_kelamin"]. 
        " - Agama: " . $row["agama"]. 
        " - Pekerjaan : " . $row["Status Pernikahan"]. 
        " - Kewarganegaraan: " . $row["kewarganegaraan"].
        " - No.NIK: " . $row["nik"]. 
        " - RT/RW: " . $row["rt_rw"]. 
        " - Alamat: " . $row["alamat"]. 
        " - Alasan: " . $row["alasan"].  
        "<br>"; 
    }
} else {
    echo "0 results";
}
$koneksi->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>
            <div class="logo">sukeRT</div>
            <ul>
                <li><a href="index.html" class="nav-link">Beranda</a></li>
                <li><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                <li><a href="laporan.php" class="nav-link">Laporan</a></li>
                <li><a href="logout.php" class="nav-link">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="laporan">
        <center><h2>Laporan Pengajuan Surat</h2></center>
        <div class="float-right">
		        <a href="laporan_excel.php" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> &nbsp Excel</a>
			<br>
			<br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe Ajuan</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Kewarganegaraan</th>
                    <th>Status Pernikahan</th>
                    <th>No. NIK</th>
                    <th>RT/RW</th>
                    <th>Alamat</th>
                    <th>Alasan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=1;
                $data = mysqli_query($koneksi, "SELECT * FROM tb_surat");
                while($d = mysqli_fetch_array($data)){

                ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['tipe_ajuan']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['ttl_tempat']; ?></td>
                            <td><?php echo $row['ttl_tanggal']; ?></td>
                            <td><?php echo $row['jenis_kelamin']; ?></td>
                            <td><?php echo $row['agama']; ?></td>
                            <td><?php echo $row['pekerjaan']; ?></td>
                            <td><?php echo $row['kewarganegaraan']; ?></td>
                            <td><?php echo $row['status_pernikahan']; ?></td>
                            <td><?php echo $row['nik']; ?></td>
                            <td><?php echo $row['rt_rw']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['alasan']; ?></td>
                        </tr>
                    <?php 
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
 
