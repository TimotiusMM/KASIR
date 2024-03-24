<?php
include '../koneksi.php'; 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Laporan - TIMORESTO</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class=" me-2"></i>TIMORESTO</h3>
        </a>
        <div class="navbar-nav w-100">
            <a href="owner.php" class="btn btn-primary m-2 active">Laporan Order</a>
            <a href="transaksi.php" class="btn btn-primary m-2 ">Laporan Transaki</a>

        </div>
    </nav>
</div>

<div class="content">
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        <span class="d-none d-lg-inline-flex ms-auto text-secondary">HALAMAN OWNER</span>
        <div class="navbar-nav align-items-center ms-auto">
            <div>
                <a href="../index.php">
                    <div class="m-3">
                        <button class="d-none d-lg-inline-flex ms-auto btn btn-outline-danger">Log Out</button>
                    </div>
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">DATA ORDER</h6>
            </div>
            <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari">
            </div>
        </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Nama Menu</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Kode Meja</th>
                            <th scope="col">Nama User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../koneksi.php';

                        $query = "SELECT * FROM pesanan";
                        $result = $koneksi->query($query);

                        if ($result && $result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {

                            $query_namaMenu = "SELECT namaMenu FROM menu WHERE idMenu = '" . $row['idMenu'] . "'";
                            $result_namaMenu = mysqli_query($koneksi, $query_namaMenu);
                            $row_namaMenu = mysqli_fetch_assoc($result_namaMenu);
                            $namaMenu = $row_namaMenu['namaMenu'];

                            $query_kodeMeja = "SELECT kodeMeja FROM meja WHERE idMeja = '" . $row['idMeja'] . "'";
                            $result_kodeMeja = mysqli_query($koneksi, $query_kodeMeja);
                            $row_kodeMeja = mysqli_fetch_assoc($result_kodeMeja);
                            $kodeMeja = $row_kodeMeja['kodeMeja'];
 
                            $query_namaPelanggan = "SELECT namaPelanggan FROM pelanggan WHERE idPelanggan = '" . $row['idPelanggan'] . "'";
                            $result_namaPelanggan = mysqli_query($koneksi, $query_namaPelanggan);
                            $row_namaPelanggan = mysqli_fetch_assoc($result_namaPelanggan);
                            $namaPelanggan = $row_namaPelanggan['namaPelanggan'];

                            $query_namaUser = "SELECT namaUser FROM user WHERE idUser = '" . $row['idUser'] . "'";
                            $result_namaUser = mysqli_query($koneksi, $query_namaUser);
                            $row_namaUser = mysqli_fetch_assoc($result_namaUser);
                            $namaUser = $row_namaUser['namaUser'];
                    ?>
                            <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $namaPelanggan; ?></td>
                            <td><?php echo $namaMenu; ?></td>
                            <td><?php echo $row['jumlah']; ?></td>
                            <td><?php echo $kodeMeja; ?></td>
                            <td><?php echo $namaUser; ?></td>
                                  
                                </tr>
                                
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>Tidak ada data yang tersedia</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="mt-4">
                <a href="#" onclick="printTable()" class="btn btn-secondary float-start">Generate Laporan</a>
</div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    Copyright © 2024 All rights reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    Create By Timotius Marcelino Modo
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function printTable() {
        var table = document.querySelector(".table");

        var tableClone = table.cloneNode(true);

        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Cetak Tabel</title>');

        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');

        printWindow.document.write('</head><body>');

        printWindow.document.write('<h2 class="text-center">Laporan Order</h2>');
        printWindow.document.write(tableClone.outerHTML);
        printWindow.document.write('</body></html>');

        printWindow.document.close(); 
        printWindow.print();
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("tbody tr");

            rows.forEach(function(row) {
                var namaMenu = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                if (namaMenu.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>