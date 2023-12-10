<?php
    include_once('./Controller/cModule.php');
    class viewNV{
        function viewAllNV(){
            $p = new controlModule();
            $tbl = $p -> getAllNhanVien();
            $this -> display($tbl);
        }

        function display($tbl){
            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    $dem = 0 ;
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ NHÂN VIÊN</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchName" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddNV'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã</th>';
                    echo '<th scope="col">Họ tên</th>';
                    echo '<th scope="col">Email</th>';
                    echo '<th scope="col">Số điện thoại</th>';
                    echo '<th scope="col">Lương </th>';
                    echo '<th scope="col">Trạng thái</th>';
                    echo '<th scope="col">Loại NV</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        if ($row['MaLoaiNV'] != 'LNV01'){
                            echo '<tr>';
                            echo '<th scope="row">'.$row['MaNhanVien'].'</th>';
                            echo ' <td>'.$row['HoTen'].'</td>';
                            echo ' <td>'.$row['Email'].'</td>';
                            echo ' <td>'.$row['SoDienThoai'].'</td>';
                            echo ' <td>'.number_format($row['Luong'], 0, ',', '.').'.000đ</td>';
                            if ($row['TrangThaiHD'] == 1) {
                                $t = 'Đang làm việc';
                            } else {
                                $t = 'Ngừng làm việc';
                            }
                            echo ' <td>'.$t.'</td>';
                            echo ' <td>'.$row['TenLoaiNV'].'</td>';
                            echo "<td><a class='btn-adj' href='admin.php?UpdNV=".$row['MaNhanVien']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>  
                            <a class='btn-adj' style='margin-top: 5px' href='admin.php?DelNV=".$row['MaNhanVien']."' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
                            echo "</td>";
                            echo '</tr>';
                        }
                    }
                    echo '</tbody>';
                echo '</table>';
                } else {
                    echo '<script>alert("Khong co san pham")</script>';
                }
            } 
    }
    }
?>