<?php
    include_once('./Controller/cModule.php');
    class viewTacGia{
        function viewAllTacGia(){
            $p = new controlModule();
            $tbl = $p -> getAllTacGia();
            $location = 'admin.php';
            $this -> display($tbl, $location);
        }

        function display($tbl, $location){
            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    $dem = 0 ;
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ TÁC GIẢ</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchName" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddNXB'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã tác giả</th>';
                    echo '<th scope="col">Họ tên</th>';
                    echo '<th scope="col">Ngày sinh</th>';
                    echo '<th scope="col">Quốc tịch</th>';
                    echo '<th scope="col">Nghệ danh</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        if ($dem == 0 ) {
                            echo '<tr>';
                        }
                        echo '<th scope="row">'.$row['MaTacGia'].'</th>';
                        echo ' <td>'.$row['HoTen'].'</td>';
                        echo ' <td>'.$row['NgaySinh'].'</td>';
                        echo ' <td>'.$row['QuocTich'].'</td>';
                        echo ' <td>'.$row['NgheDanh'].'</td>';
                        echo "<td><a class='btn btn-adj' href='#'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>  
                        <a class='btn btn-adj' style='margin-top: 5px' href='#' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
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
                    echo '<script>alert("Khong co san pham")</script>';
                }
            } else {
                echo '<script> window.location = "'.$location.'"; </script>';
        }
    }
    }
?>