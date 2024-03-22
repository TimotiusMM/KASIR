<?php
include '../koneksi.php'; 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TIMORESTO</title>
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
            <a href="waiter.php" class="btn btn-primary m-2 ">Entri Barang</a>
            <a href="order.php" class="btn btn-primary m-2 active"  >Entri Order</a>
        </div>
    </nav>
</div>

<div class="content">
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        <span class="d-none d-lg-inline-flex ms-auto text-secondary">HALAMAN WAITER</span>
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
                <a href="tambahOrder.php" class="btn btn-outline-success ">Tambah Order</a>
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
                            <th scope="col">Action</th>
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
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm edit-btn" onclick="window.location.href='editOrder.php?idPesanan=<?php echo $row['idPesanan']; ?>'" data-id="<?php echo $row['idPesanan']; ?>" data-menu="<?php echo $row['idMenu']; ?>" data-pelanggan="<?php echo $row['idPelanggan']; ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $row['idPesanan']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="hapusModal<?php echo $row['idPesanan']; ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                        <a href="hapusOrder.php?idPesanan=<?php echo $row['idPesanan']; ?>" class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>Tidak ada data yang tersedia</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="cetakOrder.php" target="_blank" class="btn btn-secondary float-start">Generate Order</a>
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

</body>

</html>

