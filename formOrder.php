<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="./css/sidebarMenu.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleIndex.css">
    <style>
    .bg-color {
        background-color: white;
    }

    .ttvc td {
        padding: 5px;
        ;
    }
    </style>

</head>

<body>

    <?php
        // Lấy đường dẫn URL hiện tại
        // $currentUrl = $_SERVER['REQUEST_URI'];
        if(isset($_REQUEST["dathang"])){
            $NoiGiao = $_REQUEST["NoiGiao"];
            $MaKH = $_SESSION["id"];
            $products = $_REQUEST['products'];
            $tongtien = $_REQUEST['totalPayment'];
            $idCart = $_REQUEST['idCart'];

            if ($NoiGiao != ''){
                include_once("Controller/cCart.php");
                $p = new ControlCart();
                $result = $p->GetAddDonHang($MaKH,$NoiGiao,$tongtien,$products,$idCart);
                if ($result==1) {
                    echo "<script>alert('Đặt thành công')</script>";
                    echo "<script> window.location='Cart.php'</script>"; 
                } elseif ($result==0) {
                    echo "<script>alert('Thêm thất bại')</script>";
                } else{
                    echo "<script>alert('Lưu ảnh thất bại')</script>";
                }
            } else {
                echo "<script>alert('Vui lòng nhập địa chỉ!')</script>";
                echo "<script> window.location='Cart.php'</script>";
            }
        }
        // echo $NoiGiao;
        // echo $MaKH;
        // echo $products[0]["quantity"];
        // echo $products[1]["quantity"];
        // echo $tongtien;

    ?>
    <!-- header -->
    <div class="conteainer-fluid">
        <?php
            // if(isset($_SESSION['id'])){
            //     include_once("View/headerIndexKh.php"); 
            // }else{
                include_once("View/headerIndex.php"); 
            // }
         ?>

        <!--Nội dụng phần body  -->
        <!-- <div class="container p-2 border border-0 bg-color mt-5">
            <div class="row">
                <div class="col-2">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="col-10 ttvc">
                    <h5>THÔNG TIN VẬN CHUYỂN</h5>
                    <?php
                        //  include_once("./View/vThongTinVanChuyen.php")
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-5">

                </div>
                <div class="col-5"></div>
            </div>

        </div> -->

        <div class="container p-2 border border-0 bg-color mt-5">
            <div class="row">
                <i class="fa fa-book col-2" aria-hidden="true"></i>
                <h5 class="col-10">SẢN PHẨM</h5>
            </div>
            <?php
                // Kiểm tra xem có dữ liệu được truyền từ trang trước hay không
                if (isset($_GET['totalPayment'])) {
                    $totalPayment = $_GET['totalPayment'];
                    $productIds = $_GET['productId'];
                    $quantities = $_GET['quantity'];
                    $unitPrices = $_GET['unitPrice'];
                    $imgSrcs = $_GET['imgSrc'];
                    $titles = $_GET['title'];
                    $idCart = $_GET['idCart'];
                    // echo "<h5>".$idCart[0]."</h5>";
                    // for ($i = 0; $i < count($idCart); $i++) {
                    //     echo $idCart[0];
                    // }
    
                    // Xử lý dữ liệu theo ý muốn của bạn
                    // Ví dụ: In ra thông tin thanh toán và chi tiết sản phẩm
    
                    for ($i = 0; $i < count($productIds); $i++) {
                        echo '<div class="row"> <div class="col-2">';
                        echo '        <img class="card-img-top border-bottom-0 rounded" style="width: 100%" src="'.$imgSrcs[$i].'">';
                        echo '    </div><div class="col-3 pt-2 d-flex flex-column justify-content-between">';
                        echo '        <span>'.$titles[$i].'</span><span>'.$unitPrices[$i].'.000đ</span>';
                        echo '    </div>';
                        echo '    <div class="col-2 pt-2" style="align-items: center; display: flex; justify-content: center;"><span hidden>'.$productIds[$i].'</span></div>';
                        echo '    <input type="hidden" class="unitPrice centered-number" placeholder="Unit Price" value="111">';
                        echo '    <div class="col-2 pt-2" style="align-items: center; display: flex; justify-content: center;">';
                        echo '        <span class="soluong">'.$quantities[$i].'</span>';
                        echo '    </div><div class="col-3 pt-2" style="align-items: center; display: flex; justify-content: center;">';
                        echo '        <span class="subtotal" id="itemPrice">'.$quantities[$i]*$unitPrices[$i].'.000đ</span>';
                        echo '    </div>';
                        echo '    <hr class="mt-3">';
                        echo '</div>            ';                                                                                                            
                    }
                }elseif(isset($_GET['total'])){
                    $totalPayment = $_GET['total'];
                    $productIds = $_GET['productId'];
                    $quantities = $_GET['quantity'];
                    $unitPrices = $_GET['unitPrice'];
                    $imgSrcs = $_GET['imgSrc'];
                    $titles = $_GET['title'];
                    // echo "<h5>".$idCart[0]."</h5>";
                    // for ($i = 0; $i < count($idCart); $i++) {
                    //     echo $idCart[0];
                    // }
    
                    // Xử lý dữ liệu theo ý muốn của bạn
                    // Ví dụ: In ra thông tin thanh toán và chi tiết sản phẩm
    
                        echo '<div class="row"> <div class="col-2">';
                        echo '        <img class="card-img-top border-bottom-0 rounded" style="width: 100%" src="'.$imgSrcs.'">';
                        echo '    </div><div class="col-3 pt-2 d-flex flex-column justify-content-between">';
                        echo '        <span>'.$titles.'</span><span>'.$unitPrices.'.000đ</span>';
                        echo '    </div>';
                        echo '    <div class="col-2 pt-2" style="align-items: center; display: flex; justify-content: center;"><span>'.$productIds.'</span></div>';
                        echo '    <input type="hidden" class="unitPrice centered-number" placeholder="Unit Price" value="111">';
                        echo '    <div class="col-2 pt-2" style="align-items: center; display: flex; justify-content: center;">';
                        echo '        <span class="soluong">'.$quantities.'</span>';
                        echo '    </div><div class="col-3 pt-2" style="align-items: center; display: flex; justify-content: center;">';
                        echo '        <span class="subtotal" id="itemPrice">'.$quantities*$unitPrices.'.000đ</span>';
                        echo '    </div>';
                        echo '    <hr class="mt-3">';
                        echo '</div>            ';                                                                                                            
                } else {
                    echo "<p>Không có dữ liệu được chuyển qua.</p>";
                }
            ?>
        </div>

        <div class="container p-2 border border-0 bg-color mt-5">
            <div class="row">
                <div class="col-2">
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                </div>
                <div class="col-10">
                    <h5>ĐƠN VỊ VẬN CHUYỂN</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <p>Chuyển phát nhanh TPHCM Express</p>
                </div>
            </div>
        </div>

        <div class="container p-2 border border-0 bg-color mt-5">
            <div class="row">
                <div class="col-2">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="col-10">
                    <h5>PHƯƠNG THỨC THANH TOÁN</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <input type="radio" checked name="Thanhtoan" id=""> Thanh toán khi nhận hàng <br>
                    <input type="radio" name="Thanhtoan" id=""> Tài khoản ngân hàng
                </div>
            </div>
        </div>

        <div class="container p-2 border border-0 bg-color my-5 ">
            <div class="row">
                <div class="col-3">
                    Tổng tiền hàng: <br><br>
                    Tổng tiền vận chuyển: <br><br>
                    Tổng tiền thanh toán:
                </div>

                <div class="col-3">
                    <span><?php echo $totalPayment; ?></span> <br><br>
                    <span>30.000đ</span> <br><br>
                    <span><?php echo ($totalPayment + 30);echo'.000đ'; ?></span>
                </div>
                <div class="col-6 ttvc">
                    <h5>THÔNG TIN VẬN CHUYỂN</h5>
                    <form action="#" method="get">

                        <?php
                            include_once("./View/vThongTinVanChuyen.php")
                        ?>

                        <div class="row pt-3">
                            <!-- <div class="col-6"></div> -->
                            <div class="col-6">
                                <a href="./Cart.php">
                                    <button type="button" class="btn btn-secondary">HỦY</button>
                                </a>
                            </div>
                            <div class="col-6">
                                <?php
                                        echo '<input type="hidden" name="totalPayment" value="'.($totalPayment + 30).'">';
                                        // echo '<input type="hidden" name="NoiGiao" value="'.$row['NoiGiao'].'">';
                                        if (isset($_GET['totalPayment'])) {
                                            for ($i = 0; $i < count($productIds); $i++) {
                                                echo '<input type="hidden" name="products['.$i.'][productId]" value="'.$productIds[$i].'">';
                                                echo '<input type="hidden" name="products['.$i.'][quantity]" value="'.$quantities[$i].'">';
                                            }
                                            for ($i = 0; $i < count($idCart); $i++) {
                                                echo '<input type="hidden" name="idCart['.$i.']" value="'.$idCart[$i].'">';
                                            }
                                        }elseif(isset($_GET['total'])){
                                            for ($i = 0; $i < count($productIds); $i++) {
                                                echo '<input type="hidden" name="products['.$i.'][productId]" value="'.$productIds.'">';
                                                echo '<input type="hidden" name="products['.$i.'][quantity]" value="'.$quantities.'">';
                                            }
                                            for ($i = 0; $i < count($idCart); $i++) {
                                                echo '<input type="hidden" name="idCart['.$i.']" value="'.$idCart[$i].'">';
                                            }
                                        }
                                    ?>
                                <button type="submit" name="dathang" id="submitButton" class="btn btn-success"
                                    disabled>ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>




    <!-- footer -->
    <?php include_once("View/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    function toggleCheckbox(checkboxId) {
        // Lấy ra đối tượng checkbox được nhấp vào
        var checkbox = document.getElementById(checkboxId);

        // Tắt checkbox khác
        if (checkboxId === "cityCheckbox") {
            document.getElementById("textInputCheckbox").checked = !checkbox.checked;
            var idtest1 = "textInputCheckbox";
            var field1 = document.getElementById(idtest1.substring(0, idtest1.indexOf("Checkbox")));

            // Bật hoặc tắt trạng thái disabled của trường
            field1.disabled = checkbox.checked;
            var idtest2 = "cityCheckbox";
            var field2 = document.getElementById(idtest2.substring(0, idtest2.indexOf("Checkbox")));
            field2.disabled = !checkbox.checked;
        } else {
            document.getElementById("cityCheckbox").checked = !checkbox.checked;
            var idtest2 = "cityCheckbox";
            var field2 = document.getElementById(idtest2.substring(0, idtest2.indexOf("Checkbox")));

            // Bật hoặc tắt trạng thái disabled của trường
            field2.disabled = checkbox.checked;
            var idtest1 = "textInputCheckbox";
            var field1 = document.getElementById(idtest1.substring(0, idtest1.indexOf("Checkbox")));
            field1.disabled = !checkbox.checked;
        }

        // Bật hoặc tắt trạng thái disabled của nút submit
        var submitButton = document.getElementById("submitButton");
        submitButton.disabled = !document.getElementById("cityCheckbox").checked && !document.getElementById(
            "textInputCheckbox").checked;
    }
    </script>
</body>

</html>