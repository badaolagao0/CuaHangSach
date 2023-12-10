<?php
    session_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleIndex.css">
    <style>
    /* body{
            position: relative;
        } */
    .bg-color {
        background-color: white;
    }

    /* Thêm vào phần style của bạn */
    #checkoutButton {
        color: #fff;
        background-color: #6c757d;
        cursor: not-allowed;
        /* Con trỏ không cho khi nút không thể nhấn */
        border-radius: 0.25rem;
        padding: 6px 8px;
        border-style: none;
    }

    .nuttatca {
        color: #fff;
        background-color: #198754;
        border-color: #198754;
        cursor: pointer;
        /* Con trỏ bình thường khi nút có thể nhấn */
        border-radius: 0.25rem;
        padding: 6px 8px;
        border-style: none;
    }

    #checkoutButton.active {
        color: #fff;
        background-color: #198754;
        border-color: #198754;
        cursor: pointer;
        /* Con trỏ bình thường khi nút có thể nhấn */
        border-radius: 0.25rem;
        padding: 6px 8px;
        border-style: none;
    }

    .position-fixed {
        z-index: 1;
    }
    </style>

</head>

<body>
    <!-- header -->
    <?php
            include_once("View/headerIndex.php"); 
     ?>

    <!--Nội dụng phần body  -->
    <div class="container p-2 border border-0 bg-color mt-5" style="border-radius: 20px">
        <div class="row p-4" style='align-items: center; display:flex;justify-content: center; text-align: center'>
            <div class="col-1 border-end">
                <button class="nuttatca" type="button" onclick="checkAll()" class="p-2">Tất cả</button>
            </div>
            <div class="col-2 border-end">
                <h5>Hình ảnh</h5>
            </div>
            <div class="col-3 border-end">
                <h5>Thông tin sản phẩm</h5>
            </div>
            <div class="col-2 border-end">
                <h5>Số lượng</h5>
            </div>
            <div class="col-2 border-end">
                <h5>Thành tiền</h5>
            </div>
            <div class="col-2">
                <h5>Tùy chọn</h5>
            </div>
        </div>
    </div>
    <div class="container p-3 border border-0 bg-color mt-2"
        style="border-radius: 20px; margin-bottom: 200px !important">
        <?php
            include_once("View/vCart.php");
        ?>
    </div>
    <div class="container-fluid position-fixed bottom-0 py-4"
        style="background-color: white; box-shadow: 0px 0px 5px 4px #999999;">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <h3>Thành tiền</h3>
                    <h3 id="totalPrice">0</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <button id="checkoutButton" type="button" onclick="checkout()" disabled>Đặt hàng</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>