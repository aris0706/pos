<?php

include 'konfig.php';
session_start();
    ?>
    <html>
        <head>
            <title>Point of Sales</title>
            <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
            <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="font-awesome-4.1.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="css/jquery.dataTables.min.css">
            
	        <link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.css">
	        <script type="text/javascript" src="js/jquery-ui/jquery-ui.js"></script>	
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#datatable').dataTable();
                });
            </script>

        </head>

        <body>
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="-webkit-box-shadow: 0px 0px 10px #888888;">
                <div class="navbar-header">
                &nbsp;&nbsp;&nbsp;<img src="images/larva2.png" width="100">
                </div>
                <p class="navbar-text">&nbsp;</p>

<?php if($_SESSION['level'] == 'Admin'){ ?>

                <div>
                    <ul class="nav navbar-nav">
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_home' || $_GET['view'] == 'ubah_home' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_home">Home &nbsp;</a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_user' || $_GET['view'] == 'edit_user' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_user">Data User &nbsp;
                                <span class="label label-default" style="border-radius: 50px;"> 4</span>
                            </a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_menu' || $_GET['view'] == 'edit_menu' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_menu">Data Menu &nbsp;
                                <span class="label label-info" style="border-radius: 50px;"> 12</span>
                            </a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_pesanan' || $_GET['view'] == 'pesanan_baru' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_pesanan">Pesanan &nbsp;
                                <span class="label label-danger" style="border-radius: 50px;"> 18</span>
                            </a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_pembayaran' || $_GET['view'] == 'pembayaran_baru' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_pembayaran">Pembayaran &nbsp;
                                <span class="label label-warning" style="border-radius: 50px;"> 10</span>
                            </a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_laporanpenjualan' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_laporanpenjualan">Laporan Penjualan &nbsp;
                                <span class="label label-default" style="border-radius: 50px;"> </span>
                            </a>
                        </li>

                    </ul>

                    <p class="navbar-text navbar-right">Hy, <?php echo $_SESSION['username']; ?> <img src="images/profile.png">  | <a class="btn btn-default btn-xs" href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a>  &nbsp;</p>
                </div>
<?php } else if($_SESSION['level'] == 'Pelayan' OR $_SESSION['level'] == 'Koki'){?>
                <div>
                    <ul class="nav navbar-nav">
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_home' || $_GET['view'] == 'ubah_home' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_home">Home &nbsp;</a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_pesanan' || $_GET['view'] == 'pesanan_baru' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_pesanan">Pesanan &nbsp;
                                <span class="label label-danger" style="border-radius: 50px;"> 18</span>
                            </a>
                        </li>

                    </ul>

                    <p class="navbar-text navbar-right">Hy, <?php echo $_SESSION['username']; ?> <img src="images/profile.png">  | <a class="btn btn-default btn-xs" href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a>  &nbsp;</p>
                </div>

<?php } else if($_SESSION['level'] == 'Kasir'){?>
                <div>
                    <ul class="nav navbar-nav">
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_home' || $_GET['view'] == 'ubah_home' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_home">Home &nbsp;</a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_pembayaran' || $_GET['view'] == 'pembayaran_baru' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_pembayaran">Pembayaran &nbsp;
                                <span class="label label-warning" style="border-radius: 50px;"> 10</span>
                            </a>
                        </li>

                    </ul>

                    <p class="navbar-text navbar-right">Hy, <?php echo $_SESSION['username']; ?> <img src="images/profile.png">  | <a class="btn btn-default btn-xs" href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a>  &nbsp;</p>
                </div>

<?php } else if($_SESSION['level'] == 'Owner'){?>
                <div>
                    <ul class="nav navbar-nav">
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_home' || $_GET['view'] == 'ubah_home' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_home">Home &nbsp;</a>
                        </li>
                        <li <?php if (isset($_GET['view'])) {echo $_GET['view'] == 'tampil_laporanpenjualan' ? 'class="active"' : '';} ?> >
                            <a href="?view=tampil_laporanpenjualan">Laporan Penjualan &nbsp;
                                <span class="label label-default" style="border-radius: 50px;"> </span>
                            </a>
                        </li>

                    </ul>

                    <p class="navbar-text navbar-right">Hy, <?php echo $_SESSION['username']; ?> <img src="images/profile.png">  | <a class="btn btn-default btn-xs" href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a>  &nbsp;</p>
                </div>


<?php } ?>
            </nav>
            <div class="container">
                <div class="col-lg-12">
                    <div class="panel panel-default"> 
                        <div class="panel-body">
                            <?php
                            if (isset($_GET['view']) AND isset($_GET['id'])) {
                                $view = $_GET['view'];
                                include 'departemen/' . $view . '.php';
                            } else if (isset($_GET['view'])) {
                                $view = $_GET['view'];
                                include 'departemen/' . $view . '.php';
                            } else {
                                $_GET['view'] = 'tampil_home';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <footer align="center">
                    Created by <a href="##">Aris Yunanto </a> | STMIK Insan Pembangunan 2021
                </footer>
            
        </body>

    </html>
