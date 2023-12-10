<?php 
    include_once("Controller/cCart.php");
    $p = new ControlCart();
    $ma = $_SESSION['id'];
    if(isset($_REQUEST["xoa"])){
      $tbl = $p ->GetDeleteProductInCart($_REQUEST["maGH"]);
      echo "<script> window.location='Cart.php'</script>";
    }elseif(isset($_REQUEST["sua"])){
        $productIds = $_GET['productId'];
        $quantities = $_GET['quantity'];
        for ($i = 0; $i < count($productIds); $i++) {
            $p -> getUpdateCart($productIds[$i], $quantities[$i], $_SESSION['id']);
        }
        echo "<script> window.location='Cart.php#sanphamgiohang'</script>"; 
    }
    $tbl = $p ->GetAllProductInCart($ma);
    if($tbl){
        //kiểm tra kết quả trả về
        if(mysql_num_rows($tbl) > 0){
            while($row = mysql_fetch_assoc($tbl)){
              //lấy về số lượng của mã sách trong kho 
              //để đặt thuộc tính data max trong thẻ input để số lượng đặt không được vượt quá trong kho
              $Tongsoluong = $p->GetTongSLByMaSach($row["MaSach"]);
                echo "<div class='row' id='sanphamgiohang'>";
                echo '<input type="hidden" name="IDGH" class="idCard" value="'.$row["MaGioHang"].'">';
                echo ' <div class="col-1" style="align-items: center; display: flex; justify-content: center;">
                        <input type="checkbox" class="productCheckbox" data-product-id="'.$row['MaSach'].'" onclick="calculateTotal()">
                      </div>';
                echo '<div class="col-2">
                        <img class="card-img-top border-bottom-0 rounded imgproduct" style="width: 100%" src="./image/'.$row['HinhAnh'].'">
                      </div>';
                echo '<div class="col-3 pt-2 d-flex flex-column justify-content-between">
                          <span class="tieude">'.$row['TieuDe'].'</span><span>'.$row['DonGia'].'.000đ</span>
                      </div>';
                echo '<input type="hidden" class="unitPrice centered-number" placeholder="Unit Price" value="'.$row['DonGia'].'">
                      <div class="col-2 pt-2" style="align-items: center; display: flex; justify-content: center;">
                        <button type="button" onclick="decrementQuantity(this, 0)" style="margin-right: 5px; width: 20px; border: 1px">-</button>
                        <input type="text" class="quantity centered-number" placeholder="Quantity" style="width: 35px; text-align: center" value="'.$row['SoLuongMua'].'" oninput="validateNumberInput(this)" data-max="'.$Tongsoluong.'">
                        <button type="button" onclick="incrementQuantity(this, 0)" style="margin-left: 5px; width: 20px; border: 1px">+</button>
                      </div>';
                echo '<div class="col-2 pt-2" style="align-items: center; display: flex; justify-content: center;">
                        <span class="subtotal" id="itemPrice">'.$row['DonGia']*$row['SoLuongMua'].'.000đ</span>
                      </div>';
                echo '<div class="col-2 pt-2" style="align-items: center; display: flex; justify-content: center;">
                        <a href="Cart.php?xoa&maGH='.$row["MaGioHang"].'" onclick="return confirm(&quot;Bạn có chắc xóa!&quot;)">
                          <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                      </div>
                      <hr class="mt-3">';
                echo "</div>";

            }

        }else{
            echo "<div class='container' style='background-color:white'>";
            echo "<div style ='font-size: 20px' class='justify-content-around row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 pt-4 pb-4'>";
            echo "KHÔNG CÓ KẾT QUẢ!";
            echo "</div>";
            echo "</div>";
        }
    }else{
        echo "không có giá trị";
    }
?>


<script>
function calculateTotal() {
    var unitPrices = document.querySelectorAll('.unitPrice');
    var checkboxes = document.querySelectorAll('.productCheckbox');
    var quantities = document.querySelectorAll('.quantity');
    var subtotalElements = document.querySelectorAll('.subtotal');
    var totalPriceElement = document.getElementById('totalPrice');
    var total = 0;

    var atLeastOneChecked = false;

    for (var i = 0; i < unitPrices.length; i++) {
        var checkbox = checkboxes[i];

        if (checkbox.checked) {
            atLeastOneChecked = true;

            var unitPrice = parseFloat(unitPrices[i].value);
            var quantity = parseInt(quantities[i].value);
            var subtotal = unitPrice * quantity;

            subtotalElements[i].textContent = subtotal.toFixed(3) + 'đ';
            total += subtotal;
        } else {
            var unitPrice = parseFloat(unitPrices[i].value);
            var quantity = parseInt(quantities[i].value);
            var subtotal = unitPrice * quantity;

            subtotalElements[i].textContent = subtotal.toFixed(3) + 'đ';
        }
    }

    var checkoutButton = document.getElementById('checkoutButton');
    checkoutButton.classList.toggle('active', atLeastOneChecked);
    checkoutButton.disabled = !atLeastOneChecked; // Disable nếu không có checkbox nào được chọn

    totalPriceElement.textContent = total.toFixed(3) + 'đ';
}

// chọn tất cả sản phẩm (nút)
function checkAll() {
    var checkboxes = document.querySelectorAll('.productCheckbox');
    var allChecked = true;

    // Kiểm tra xem có checkbox nào chưa được chọn không
    for (var i = 0; i < checkboxes.length; i++) {
        if (!checkboxes[i].checked) {
            allChecked = false;
            break;
        }
    }

    // Nếu tất cả đã được chọn, bỏ chọn tất cả; ngược lại, chọn tất cả
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = !allChecked;
    }

    calculateTotal();
}

function incrementQuantity(button, index) {
    var input = button.parentElement.querySelector('.quantity');
    var max = parseInt(input.getAttribute('data-max'));

    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
    }
    calculateTotal();
    updateLink();
}

function decrementQuantity(button, index) {
    var input = button.parentElement.querySelector('.quantity');

    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        calculateTotal();
        updateLink();
    }
}

function updateLink() {
     // Ngăn chặn sự kiện submit mặc định
     event.preventDefault();
    var quantities = document.querySelectorAll('.quantity');
    
    var queryString = '';

    for (var i = 0; i < quantities.length; i++) {
        var productId = document.querySelectorAll('.productCheckbox')[i].getAttribute('data-product-id');
        queryString += '&quantity[]=' + encodeURIComponent(quantities[i].value);
        queryString += '&productId[]=' + productId;
    }

    calculateTotal(); // Gọi lại hàm calculateTotal sau khi cập nhật số lượng thành công
    window.location.replace('Cart.php?sua&' + queryString);
   
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

    calculateTotal();
}

function checkout() {
    var checkboxes = document.querySelectorAll('.productCheckbox');
    var selectedProducts = [];
    var totalPayment = parseFloat(document.getElementById('totalPrice').textContent);

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            var productId = checkboxes[i].getAttribute('data-product-id');
            var quantity = document.querySelectorAll('.quantity')[i].value;
            var unitPrice = document.querySelectorAll('.unitPrice')[i].value;
            var imgSrc = document.querySelectorAll('.imgproduct')[i].getAttribute('src');
            var title = document.querySelectorAll('.tieude')[i].textContent;
            var idCart = document.querySelectorAll('.idCard')[i].value;

            selectedProducts.push({
                productId: productId,
                quantity: quantity,
                unitPrice: unitPrice,
                imgSrc: imgSrc,
                title: title,
                idCart: idCart
            });
        }
    }

    var queryString = 'totalPayment=' + totalPayment.toFixed(3);

    for (var j = 0; j < selectedProducts.length; j++) {
        queryString +=
            '&productId[]=' + encodeURIComponent(selectedProducts[j].productId) +
            '&quantity[]=' + encodeURIComponent(selectedProducts[j].quantity) +
            '&unitPrice[]=' + encodeURIComponent(selectedProducts[j].unitPrice) +
            '&imgSrc[]=' + encodeURIComponent(selectedProducts[j].imgSrc) +
            '&title[]=' + encodeURIComponent(selectedProducts[j].title) +
            '&idCart[]=' + encodeURIComponent(selectedProducts[j].idCart);
    }

    window.location.href = 'formOrder.php?' + queryString;
}
</script>