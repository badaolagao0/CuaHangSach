<?php
    include_once('./Controller/cModule.php');
    include_once('getInfo.php');
    class viewDonDatHang{
        function viewAllDonDatHang(){
            $p = new controlModule();
            $tbl = $p -> getAllDonDatHang();
            // $location = 'admin.php?dondathang';
            $this -> display($tbl);
        }

        function viewAllDonDatHangByKh($id){
            include_once('View/Module/getInfo.php');
            $p = new controlModule();
            $tbl = $p -> getInfoKh($id);
            echo "<h1 style='text-align: center;'>Đơn mua</h1>";
            $this -> displayByKh($tbl);
        }

        function display($tbl){
            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    $dem = 0 ;
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ ĐƠN ĐẶT HÀNG</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchName" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn btn-primary">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã Đơn hàng</th>';
                    echo '<th scope="col">Mã Khách hàng</th>';
                    //echo '<th scope="col">Mã Sách</th>';
                    echo '<th scope="col">Ngày Giao</th>';
                    echo '<th scope="col">Số lượng</th>';
                    //echo '<th scope="col">Ghi chú</th>';
                    echo '<th scope="col">Nơi giao</th>';
                    echo '<th scope="col">Tổng tiền</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        if ($dem == 0 ) {
                            echo '<tr>';
                        }
                        echo '<th scope="row">'.$row['MaDonHang'].'</th>';
                        echo ' <td>'.$row['MaKH'].'</td>';
                        echo ' <td>'.$row['MaSach'].'</td>';
                        //echo ' <td>'.$row['NgayGiao'].'</td>';
                        echo ' <td>'.$row['SoLuong'].'</td>';
                        //echo ' <td>'.$row['GhiChu'].'</td>';
                        echo ' <td>'.$row['NoiGiao'].'</td>';
                        echo ' <td>'.$row['TongTien'].'</td>';
                        echo '</tr>';     
                        $dem++;
                        if ($dem==2) {
                            echo '</tr>';
                            $dem = 0;
                        }          
                    }
                    echo '</tbody>';
                echo '</table>';
                } else {
                    echo '<script>alert("Khong co san pham")</script>';
                }
            } else {
                // echo '<script> window.location = "'.$location.'"; </script>';
        }
    }   

    function displayByKh($tbl){
        if ($tbl) {
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    if ($row['TinhTrang'] == 0) {
                        $t = '<b style="color: red;">Chờ xử lý</b>';
                    } elseif ($row['TinhTrang'] == 1){
                        $t = '<b style="color: green;">Đã giao</b>';
                    }else {
                        $t = 'Đã hủy';
                    }
                    echo '<div class="box">';
                    // echo "<div class='box-children'>";
                    $formattedNumber = number_format($row['TongTien'], 0, ',', '.');
                    echo '</form action="#" method="post" >';
                    if ($row['TinhTrang'] == 0) {
                        echo "<div style='position: absolute;right: 47px;'>
                        <a class='btn btn-danger ms-4' style='margin-top: 16px' href='vTkKh.php?huyDon=".$row['MaDonHang']."
                        ' onclick='return confirm(\"Có chắc chắn hủy không\")'>Hủy đặt hàng</a>
                        </div>";
                    }
                    echo '</form>';
                    getDetailDonDatHangByKh($row['ChiTietDonHang'], $row['ChiTietSoLuong']);
                    // echo "</div>";
                    echo "<div class='box-children adj-box-children'>";
                    echo "<div class='d-flex mb-2'><p style='color: #000;'> Thông tin đơn hàng: ". $t ."</p>";
                    echo "</div>";
                    echo "<div><h3>Tổng tiền: ".$formattedNumber.".000đ</h3></div>";
                    echo "</div>";
                    echo "</div>";
                }
                // echo '
                //     <script>
                //     function confirmBox(dataId) {
                //         // Tạo modal
                //         var modalHTML = `
                //           <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                //             <div class="modal-dialog">
                //               <div class="modal-content">
                //                 <div class="modal-header">
                //                   <h5 class="modal-title" id="confirmModalLabel">Xác nhận</h5>
                //                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                //                 </div>
                //                 <div class="modal-body">
                //                   Bạn có chắc chắn muốn hủy không?
                //                 </div>
                //                 <div class="modal-footer">
                //                     <button type="button" class="btn btn-success"
                //                         onclick="performAction(\'${dataId}\')">Xác nhận</button>
                //                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Thoát</button>
                //                 </div>
                //               </div>
                //             </div>
                //           </div>
                //        `;
                      
                //         // Thêm modal vào body
                //         document.body.insertAdjacentHTML("beforeend", modalHTML);
                      
                //         // Hiển thị modal
                //         var confirmModal = new bootstrap.Modal(document.getElementById("confirmModal"));
                //         confirmModal.show();
                //       }
                      
                //       function performAction(dataId) {
                //         console.log(dataId)

                //         location.href = `huyDonHang.php?id=${dataId}`

                //         // Sau khi thực hiện hành động, bạn có thể ẩn modal
                //         var confirmModal = bootstrap.Modal.getInstance(document.getElementById("confirmModal"));
                //         confirmModal.hide();
                //       }
                      
                //     </script>
                // ';
            }
        }
    }
    }
?>