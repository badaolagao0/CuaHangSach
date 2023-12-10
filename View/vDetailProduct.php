<?php 
    include_once("Controller/CDetailProduct.php");

    
    $maSach = $_REQUEST["maSach"];
    $p = new ControlDetail();
    $tbl = $p -> getDetailProduct($maSach);

    if($tbl){
        if(mysql_num_rows($tbl) > 0){
            echo "    <form action='#' method='post'>";
            echo "<div class = 'container my-4 rounded py-4'style='background-color:white'>";
            include_once("Controller/cCart.php");
            $ccart = new ControlCart();
            $Tongsoluong = $ccart->GetTongSLByMaSach($maSach);
            $row = mysql_fetch_assoc($tbl);
                echo '<div class="row product">';
                echo '<div class="col-4">';
                echo '<input type="hidden" name="" class="product-id" value="'.$_REQUEST['maSach'].'">';
                echo '    <img style="max-width: 100%;" id="productImage" class="card-img-top rounded imgproduct" src="./image/'.$row['HinhAnh'].'">';
                echo '</div>';
                echo '<div class="col-1"></div>';
                echo '<div class="col-7 d-flex flex-column justify-content-between">';
                echo '    <div class="">';
                echo '    <h4 class="tieude" id="tieudeanh">'.$row['TieuDe'].'</h4>';
                echo '    </div>';
                echo '    <div class="">';
                echo '        <p class="tacgia">Tác giả: ';
                echo $row['HoTen'];
                while($row = mysql_fetch_assoc($tbl)){
                    echo ', '.$row['HoTen'];
                }
                // Đưa con trỏ về dòng đầu tiên để duyệt dữ liệu
                mysql_data_seek($tbl,0);
                $row = mysql_fetch_assoc($tbl);
                echo'</p>';
                echo '    <p class="nxb">Nhà xuất bản:'.$row['TenNXB'].' </p>';
                echo '    <p class="theloai">Thể loại: '.$row['TenLoai'].'</p>';
                echo '    <p class="tonkho">Số lượng tồn: '.$row['SoLuong'].'</p>';
                echo '    </div>';
                echo '    <div class="">';
                echo '    <input type="hidden" name="" id="unitpriceinput" class="price unitPrice" value="'.$row['DonGia'].'">';
                echo '    <h4 style ="color: red;   font-weight: bold" class="giatien">Giá: '.$row['DonGia'].'.000đ </h4>';
                echo '    <p>';
                echo '        <button type="button" onclick="decrementQuantity(this, 0)" style="margin-right: 5px; width: 20px; border: 1px">-</button>';
                echo '        <input type="text" name="quantity" id="quantityInput" class="quantity centered-number" placeholder="Quantity" style="width: 35px; text-align: center" value="1" oninput="validateNumberInput(this)" data-max="'.$Tongsoluong.'">';
                echo '        <button type="button" onclick="incrementQuantity(this, 0)" style="margin-left: 5px; width: 20px; border: 1px">+</button>';
                echo '    </p>';
                echo '    </div>';
                echo '    <div class="">';
                echo '    <!-- Thêm sự kiện click để gọi hàm checkout -->';
                echo '    <button type="submit" class="btn btn-success" name="submitAddGh"">Thêm vào giỏ hàng</button>';
                echo '    <button type="button" class="btn btn-primary" onclick="checkout()">Đặt hàng</button>';
                echo '    </div>';
                echo '</div>';
                echo '</div>';


            echo "</div>";
            echo "</form>";
        }else{
            echo "0 result";
        }
    }else{
        echo "Khong co gia tri";
    }

    function insertGh($idSach, $idKh, $amount){
        $p = new ControlDetail();
        $result = $p -> addSachToGh($idSach, $idKh, $amount);
        return $result;
    }
?>

<script>
function checkout(element) {
    var productId = document.querySelectorAll('.product-id').value;
    var quantity = document.getElementById('quantityInput').value;
    var unitPrice = document.getElementById('unitpriceinput').value;
    // var imgSrc = document.querySelectorAll('.imgproduct').getAttribute('src');
    var imgSrc = document.getElementById('productImage').getAttribute('src');
    var title = document.getElementById('tieudeanh').textContent;
    var idCart = document.querySelectorAll('.idCard').value;
    var total = unitPrice * quantity;


    // Tiếp theo là xử lý dữ liệu và chuyển hướng trang
    // ...

    window.location.href = 'formOrder.php?productId=<?php echo $_REQUEST['maSach']; ?>&quantity=' + quantity +
        '&unitPrice=' + unitPrice + '&imgSrc=' + imgSrc + '&title=' + title + '&total=' + total;
}
</script>