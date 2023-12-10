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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleIndex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
.btn-adj {
    border: 1px solid #ccc;
    width: 22px;
}

.btn-adj:hover {
    /* background-color: #cccccc47; */
    opacity: 0.8;
    color: #000;
}
</style>

<body>
    <!-- header -->
    <?php 
    include_once("View/headerIndex.php"); 
    if (isset($_REQUEST['dx'])){
        session_destroy();
    }elseif(isset($_REQUEST['submitAddGh'])){
        if ($_SESSION['login'] == false){
            echo "<script> window.location='login.php'</script>"; 
        } else {
            include_once("View/vDetailProduct.php");
                $amount = $_REQUEST['quantity'];
                $idSach = $_REQUEST["maSach"];
                // echo "<script>alert('".$idKh.";".$amount.";".$idSach."')</script>";
                $result = insertGh($idSach, $_SESSION['id'], $amount);
                if ($result==1) {
                    echo "<script>alert('Thêm vào giỏ hàng thành công')</script>";
                    echo "<script> window.location='DetailProduct.php?maSach=$idSach'</script>"; 
                } else {
                    echo "<script>alert('Thêm vào giỏ hàng không thành công')</script>";
                }
        }
    }
    ?>


    <!--Nội dụng phần body  -->
    <div class="container p-3 border border-0 " id="sanpham" style="margin-top: 10px; background-color: white">
        <span style="padding: 0 12px; font-size: 26px; color: black">THÔNG TIN CHI TIẾT SẢN PHẨM</span>
    </div>
    <?php
        include_once("View/vDetailProduct.php");
    ?>

    <!--Binh Luận -->
    <div class="container my-4 rounded py-4" style="background-color:white">
        <h3>Bình luận sách</h3>
        <?php
    	// Hiển thị danh sách bình luận ở đây
        // hienThiDanhSachBinhLuan($binhLuanList);
        include_once("View/vComment.php");

    	// Hiển thị biểu mẫu bình luận
    	?>
    </div>

    <!-- footer -->
    <?php include_once("View/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- scrit kiểm tra tăng giảm số lượng và nhập vào ô số lượng không được lớn hơn số lượng trong kho -->
    <script>
    function incrementQuantity(button, index) {
        var input = button.parentElement.querySelector('.quantity');
        var max = parseInt(input.getAttribute('data-max'));

        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decrementQuantity(button, index) {
        var input = button.parentElement.querySelector('.quantity');

        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    // kiểm tra giá trị nhập vào
    function validateNumberInput(input) {
        // không cho nhập số lớn hơn giá trị trong kho
        var max = parseInt(input.getAttribute('data-max'));
        var value = parseInt(input.value);

        if (value > max) {
            input.value = max;
        }

        // không cho nhập ký tự
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value === '') {
            input.value = '1';
        }

    }
    </script>
</body>

</html>

<?php
	// Xử lý Gửi Bình Luận
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitComment'])) {
    // Lấy dữ liệu từ biểu mẫu
    $noiDung = $_POST['NoiDung'];

    // Thực hiện thêm bình luận vào cơ sở dữ liệu
    $result = $cComment->themBinhLuan($idKh, $idSach, $noiDung);

    if ($result) {
        echo "<script>alert('Bình luận thành công')</script>";
        // Refresh trang để hiển thị bình luận mới
        echo "<script>window.location.reload();</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm bình luận')</script>";
    }
	}
	?>