<?php
    session_start();
    if ($_SESSION['type'] == 'LNV01'){
        $temp = 'admin.php?pagedondathang';
    } else {
        $temp = 'nhanvien.php?pagedondathang';
    }
    include_once('./Controller/cModule.php');
    include_once('getInfo.php');
    $p = new controlModule();
    $productpage= 5;
    $count = $p->countDonDatHang();
    // $temp = 'admin.php?pagedondathang';
    if (isset($_REQUEST['searchDonDatHangOfKh'])){
        $ten = $_REQUEST['searchDonDatHangOfKh'];
        $tbl = $p -> getDonDatHangOfKh($ten);
    }elseif (isset($_REQUEST['pagedondathang'])){
        $page = $_REQUEST["pagedondathang"];
        $tbl = $p->getDonDatHangOnPage($page,$productpage);
    }elseif($_REQUEST["previous"]){
        echo "<script> alert('có')</script>";
    }

            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    $demModel = 1;
                    echo "<div style='margin:10px;'> <h2>ĐƠN ĐẶT HÀNG</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchDonDatHangOfKh" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã Đơn hàng</th>';
                    echo '<th scope="col">Khách hàng</th>';
                    echo '<th scope="col">Tình trạng</th>';
                    echo '<th scope="col">Nơi giao</th>';
                    echo '<th scope="col">Tổng tiền</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        $timestamp = strtotime($row['NgayGiao']);
                        $formattedDate = date('d/m/Y', $timestamp);
                        echo '<tr>';
                        echo '<th scope="row">'.$row['MaDonHang'].'</th>';
                        echo ' <td>'.$row['hoten_khachhang'].'</td>';
                        if ($row['TinhTrang'] == 0) {
                            $t = '<b style="color: red;">Chờ xử lý</b>';
                        } elseif ($row['TinhTrang'] == 1){
                            $t = '<b style="color: green;">Đã giao</b>';
                        }else {
                            $t = 'Đã hủy';
                        }
                        echo ' <td>'.$t.'</td>';
                        echo ' <td>'.$row['NoiGiao'].'</td>';
                        $formattedNumber = number_format($row['TongTien'], 0, ',', '.');
                        echo ' <td>'.$formattedNumber.'.000đ</td>';
                        echo "<td>
                                <a class='btn-adj' style='margin-right: 5px;
                                cursor: pointer;' data-modal='myModal".$demModel."' id='myBtn'>
                                <i class='fa fa-eye' style='margin-left: 2px;'></i>
                                </a>";
                        if ($row['TinhTrang'] == 0){
                        echo"    <a class='btn-adj btn-success'
                            style='margin-top: 5px; color: #f8f3f3;'
                            href='admin.php?doitrangthaidonhang=1&id={$row['MaDonHang']}'><i class='fa fa-check-square-o' aria-hidden='true'></i></a>";
                        }
                        echo   "</td>";
                        echo "</td>";
                        echo '</tr>';             
                    echo '<div id="myModal'.$demModel.'" class="modal" style="z-index: 4">';
                            // <!-- Modal content -->
                            echo '<div class="modal-content" style="width: 70%">
                              <div class="modal-header">
                                <h2 style="color: #000;">THÔNG TIN ĐƠN ĐẶT HÀNG</h2>
                                <span class="close" data-modal="myModal'.$demModel.'">&times;</span>
                              </div>';
                            echo  '<div class="modal-body">';
                            echo'      <div class="row">
                                      <div class="col-md-4 control-label">
                                          <p>Mã đơn:</p>
                                      </div>
                                      <div class="col-md-8">
                                          <p>'.$row["MaDonHang"].'</p>
                                      </div>
                                  </div>';
                            echo'      <div class="row">
                                      <div class="col-md-4 control-label">
                                          <p>Khách hàng:</p>
                                      </div>
                                      <div class="col-md-8">
                                          <p>'.$row["hoten_khachhang"].'</p>
                                      </div>
                                  </div>';
                            echo'      <div class="row">
                                      <div class="col-md-4 control-label">
                                          <p>Nhân viên xử lý:</p>
                                      </div>
                                      <div class="col-md-8">
                                          <p>'.$row["hoten_nhanvien"].'</p>
                                      </div>
                                  </div>';
                                  getDetailDonDatHang($row['ChiTietDonHang'], $row['ChiTietSoLuong']);
                            echo'      <div class="row">
                                      <div class="col-md-4 control-label">
                                          <p>Ngày giao:</p>
                                      </div>
                                      <div class="col-md-8">
                                          <p>'.$formattedDate.'</p>
                                      </div>
                                  </div>';
                            echo'      <div class="row">
                                      <div class="col-md-4 control-label">
                                          <p>Nơi giao:</p>
                                      </div>
                                      <div class="col-md-8">
                                          <p>'.$row['NoiGiao'].'</p>
                                      </div>
                                  </div>';
                            echo'      <div class="row">
                                      <div class="col-md-4 control-label">
                                          <p>Ghi chú:</p>
                                      </div>
                                      <div class="col-md-8">
                                          <p>'.$row['GhiChu'].'</p>
                                      </div>
                                  </div>';
                            echo'  </div>';
                            echo'  <div class="modal-footer">
                                    <div class="row" style="width: 100%">
                                        <div class="col-md-6">
                                            <h5 style="color: #000;"> Trạng thái: <b> <i>'.$t.'</i></b></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 style="color: #000;"> Tổng tiền:<b> <i>'.$formattedNumber.'.000đ</i></b></h5>
                                        </div>
                                    </div>
                                </div>';
                            echo '</div>';
                          echo '</div>';
                          $demModel += 1;
                }
                    echo '</tbody>';
                echo '</table>';
                pagination($count, $page, $temp, $productpage);
                } else {
                    echo "<div style='margin:10px;'> <h2>ĐƠN ĐẶT HÀNG</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchDonDatHangOfKh" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã Đơn hàng</th>';
                    echo '<th scope="col">Khách hàng</th>';
                    echo '<th scope="col">Ngày Giao</th>';
                    echo '<th scope="col">Số lượng</th>';
                    echo '<th scope="col">Nơi giao</th>';
                    echo '<th scope="col">Tổng tiền</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '</table>';
                }
            } else {
                echo "<div style='margin:10px;'> <h2>ĐƠN ĐẶT HÀNG</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchDonDatHangOfKh" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã Đơn hàng</th>';
                    echo '<th scope="col">Khách hàng</th>';
                    echo '<th scope="col">Ngày Giao</th>';
                    echo '<th scope="col">Số lượng</th>';
                    echo '<th scope="col">Nơi giao</th>';
                    echo '<th scope="col">Tổng tiền</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '</table>';
        }
?>