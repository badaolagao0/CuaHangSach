<?php
    include_once('./Controller/cModule.php');
    class viewKho{
        function viewAllKho(){
            $p = new controlModule();
            $tbl = $p -> getAllKho();
            $location = 'admin.php';
            $this -> display($tbl, $location);
        }

        function display($tbl, $location){
            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    $dem = 0 ;
                    echo "<div style='margin:10px;'> <h2>THÔNG TIN KHO SÁCH</h2>";
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã kho</th>';
                    echo '<th scope="col">Tên kho</th>';
                    echo '<th scope="col">Số lượng tồn</th>';
                    echo '<th scope="col">Số lượng tổng</th>';
                    echo '<th scope="col">Địa chỉ</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        if ($dem == 0 ) {
                            echo '<tr>';
                        }
                        echo '<th scope="row">'.$row['MaKho'].'</th>';
                        echo '<th scope="row">'.$row['TenKho'].'</th>';
                        echo '<th scope="row">'.$row['SoLuongTonKho'].'</th>';
                        echo '<th scope="row">'.$row['SoLuongTong'].'</th>';
                        echo '<th scope="row">'.$row['DiaChi'].'</th>';
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