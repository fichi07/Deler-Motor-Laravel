<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
try {
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
        'timeout' => 5
    ]);

    $response =  $client->request('GET', '/api/motor/'.$_GET['id']);
    $body = $response->getBody();
    $data_body = json_decode($body, true);
 
} catch (RuntimeException $e) {
    echo $e->getMessage();
}

if (isset($_POST['edit'])) {
    try {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000',
            'timeout' => 5
        ]);
    

        $response =  $client->request('PUT', '/api/motor/' . $data_body['data']['id'], [
            'json' => [
                'nama' => $_POST['nama'],
                'warna' => $_POST['warna'],
                'tahun' => $_POST['tahun'],
                'stok' => $_POST['stok'],
                'harga' => $_POST['harga']
            ]
        ]);

        $body = $response->getBody();
        // $data_body = json_decode($body, true);

        header('location:dashboard_admin.php');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Motor</title>
    <!-- Custom fonts for this template-->
    <link href="tampilan/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="tampilan/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="tampilan/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Let's Work Dude</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <div class="sidebar-heading" style="margin-top: 20px;">
                Menu
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>DASHBOARD</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="daftar_penjualan.php">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span>Daftar Penjualan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= $_SESSION["user"] ?></b> (Admin)</span>
                                <i class="fas fa-user-circle fa-fw"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit Data Motor</h1>

                    <form action="" method="POST">

                        <h6 class="m-0 font-weight-bold text-primary">Nama</h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" value="<?= $data_body['data']['nama']; ?>" name="nama">
                        </div>

                        <h6 class="m-0 font-weight-bold text-primary">Warna</h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" value="<?= $data_body['data']['warna']; ?>" name="warna">
                        </div>

                        <h6 class="m-0 font-weight-bold text-primary">Tahun</h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" value="<?= $data_body['data']['tahun']; ?>" name="tahun">
                        </div>

                        <h6 class="m-0 font-weight-bold text-primary">Stok</h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" value="<?= $data_body['data']['stok']; ?>" name="stok">
                        </div>

                        
                        <h6 class="m-0 font-weight-bold text-primary">Harga</h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" value="<?= $data_body['data']['harga']; ?>" name="harga">
                        </div>

                        

                        <div style="display: flex; justify-content: center;">
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Edit" style="width: 250px;" name="edit">
                        </div>

                    </form>
                    <br>
                    <br>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Ayo Vaksin!</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="tampilan/vendor/jquery/jquery.min.js"></script>
    <script src="tampilan/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="tampilan/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="tampilan/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="tampilan/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="tampilan/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="tampilan/js/demo/datatables-demo.js"></script>

</body>

</html>
