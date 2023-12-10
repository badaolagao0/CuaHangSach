<?php
    include_once('./Controller/cKH.php');
    class viewKH{
        function viewAllKH(){
            $p = new controlKH();
            $tbl = $p -> getAllKH();
            $this -> display($tbl);
        }

        function display($tbl){
            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    $dem = 0 ;
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ KHÁCH HÀNG</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchName" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddKH'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã</th>';
                    echo '<th scope="col">Tên khách hàng</th>';
                    echo '<th scope="col">Ngày sinh</th>';
                    echo '<th scope="col">Email</th>';
                    echo '<th scope="col">Số điện thoại</th>';
                    echo '<th scope="col">Điểm tích lũy</th>';
                    echo '<th scope="col">Loại khách hàng</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        if ($dem == 0 ) {
                            echo '<tr>';
                        }
                        echo '<th scope="row">'.$row['MaKH'].'</th>';
                        echo ' <td>'.$row['HoTen'].'</td>';
                        // echo ' <td>'.$row['NgaySinh'].'</td>';
                        $date = date_create($row['NgaySinh']);
                        echo ' <td>'.date_format($date, 'd/m/Y').'</td>';
                        echo ' <td>'.$row['Email'].'</td>';
                        echo ' <td>'.$row['SoDienThoai'].'</td>';
                        echo ' <td>'.$row['DiemTichLuy'].'</td>';
                        echo ' <td>'.$row['TenLoaiKH'].'</td>';
                        // echo "<td><a class='btn btn-warning' href='admin.php?UpdKH=".$row['MaKH']."'><i class='fas fa-edit'></i></a>
                        // <a class='btn btn-danger' style='margin-top: 5px' href='admin.php?DelKH=".$row['MaKH']."' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fas fa-trash-alt'></i></a> </td>";
                        echo "<td><a class='btn-adj' href='admin.php?UpdKH=".$row['MaKH']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>  
                            <a class='btn-adj' style='margin-top: 5px' href='admin.php?DelKH=".$row['MaKH']."' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
                        echo "</td>";
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
                    echo '<script>alert("Không có khách hàng")<script>';
                }
            }
        }

    }
?>