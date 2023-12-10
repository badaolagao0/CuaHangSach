<?php
    session_start();
    if (!$_SESSION['login']){
        echo '<script>window.location = "login.php";</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="./css/sidebarMenu.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleIndex.css">

</head>

<body>
    <!-- header -->
    <?php 
    include_once("View/headerIndex.php"); 
    if (isset($_REQUEST['dx'])){
        session_destroy();
    }
    ?>

    <!-- Slide-Banner -->
    <div class="container" style="margin-top:10px">
        <div class="row align-items-center">
            <div class="col-lg-8 col-sm-12 col-md-12 col-12 mb-2">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./image/slide1.jpg" class="d-block w-100 rounded-2" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <!-- <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p> -->
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./image/slide2.jpg" class="d-block w-100 rounded-2" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <!-- <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p> -->
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./image/slide4.jpg" class="d-block w-100 rounded-2" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <!-- <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p> -->
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="col-lg-4 col-sm-12 col-md-12 col-12">
                <img class="mb-2 rounded-3" src="./image/banner2.jpg" alt="" style="width:100%; height:auto;">
                <img class="rounded-3" src="./image/banner2.jpg" alt="" style="width:100%; height:auto;">

            </div>
        </div>
    </div>
    <!--Nội dụng phần body  -->
    <div class="container p-3 border border-0 bg-color-green" id="sanpham" style="margin-top: 10px">
        <span style="padding: 0 12px; font-size: 26px; color: white">SẢN PHẨM</span>
    </div>
    <?php

        include_once("View/vProduct.php");
    
        
    ?>


    <!-- footer -->
    <?php include_once("View/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>