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
        <!-- Sidebar -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class=" me-2"></i>TIMORESTO</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="admin.php" class="btn btn-primary m-2 ">Entri Barang</a>
                    <a href="meja.php" class="btn btn-primary m-2 active" >Entri Meja</a>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <span class="d-none d-lg-inline-flex ms-auto text-secondary">HALAMAN ADMIN</span>
                <div class="navbar-nav align-items-center ms-auto">
                    <div>
                        <a>
                            <div class="m-3">
                            <a href="../index.php" class="btn btn-outline-danger">Log Out</a>
                            </div>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Data Meja -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">DATA MEJA</h6> 
                        <a href="tambahMeja.php" class="btn btn-outline-success">Tambah Meja</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">No</th>
                                    <th scope="col">No Meja</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../koneksi.php';

                                $query = "SELECT * FROM meja";
                                $result = $koneksi->query($query);

                                if ($result && $result->num_rows > 0) {
                                    $no = 1;

                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['kodeMeja']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm edit-btn"
                                            onclick="window.location.href='editMeja.php?idMeja=<?php echo $row['idMeja']; ?>'" 
                                            data-id="<?php echo $row['idMeja']; ?>" 
                                            data-nama="<?php echo $row['kodeMeja']; ?>" 
                                            data-harga="<?php echo $row['keterangan']; ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $row['idMeja']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="hapusModal<?php echo $row['idMeja']; ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                                <a href="hapusMeja.php?idMeja=<?php echo $row['idMeja']; ?>" class="btn btn-danger">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Tidak ada data yang tersedia</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
   
</body>

</html>

