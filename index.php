<?php

include './konfig.php';
session_start();
if (isset($_SESSION['level']) == null) {
    ?>
    <html>
        <head>
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="font-awesome-4.1.0/css/font-awesome.min.css">
            <!--- <style type="text/css">
                body{
                    background-image: url(images/home_good_personal.png);
                }

            </style> --->
            <title>Login Sistem Informasi Point of Sales</title>
        </head>
        <body>
            <div align="center">
                

                <div align="center" style="width:420px;margin-top:7%;">
                    <form name="login_form" method="post" class="well well-lg" action="login.php" style="-webkit-box-shadow: 0px 0px 20px #888888;">
                        <img src="images/larva.png" width="200"><br>
                        <br>
                        <?php 
                        if(isset($_GET['error'])){
                            if($_GET['error'] == 'salah'){
                                echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                Username atau Password tidak sesuai, silahkan diulang kembali!
                                </div>';
                            } else if($_GET['error'] == 'kosong'){
                                echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                Masukkan username atau masukkan password!
                                </div>';
                            } 
                        }
                        ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="username" id="username" class="form-control" type="text" placeholder="Username" autocomplete="off" autofocus="" />
                        </div>
                        <br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input name="password" id="password" class="form-control" type="password" placeholder="Password" autocomplete="off" />
                        </div>
                        <br />
                        <input name="submit" type="submit" value="Login" class="btn btn-primary btn-block">
                        <br/>
                        <a class="small" href="##">Point of Sales System - Cafe Larva</a>

                    </form>

                </div>
            </div>
            <br>
            <br>
            <br>

            <footer align="center">
                
            </footer>
        </body>
    </html>
    <?php
} else {
        header("location:cafelarva.php?view=tampil_home");
}
?>


