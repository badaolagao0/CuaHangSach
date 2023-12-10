<?php
    include_once('./Controller/cTG.php');
    class viewTG{
        function viewAllTG(){
            $p = new controlTG();
            $tbl = $p -> getAllTG();
            $location = 'admin.php';
            $this -> display($tbl, $location);
        }

        function viewTGByName($ten){
            $p = new controlTG();
            $tbl = $p -> getAllTGByName($ten);
            $location = 'admin.php?tg';
            $this -> display($tbl, $location);

        }
        
        function display($tbl, $location){
            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    $dem = 0 ;
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ TÁC GIẢ</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchNameTG" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddTG'>Thêm</a>";
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
                        if ($row['TrangThaiXoa'] == 0) {
                            echo '<tr>';
                        $MaTacGia = $row['MaTacGia']; 
                          
                        // print_r($MaTacGia);                 
                        $HoTen = $row['HoTen'];
                        $NgaySinh = $row['NgaySinh'];
                        $QuocTich = $row['QuocTich'];
                        $NgheDanh = $row['NgheDanh'];
                        echo '<th scope="row">'.$MaTacGia.'</th>';
                        echo ' <td>'.$HoTen.'</td>';
                        echo ' <td>'.$NgaySinh.'</td>';
                        echo ' <td>'.$QuocTich.'</td>';
                        echo ' <td>'.$NgheDanh.'</td>';
                        echo "<td><a class='btn-adj' href='admin.php?UpdTG=".$row['MaTacGia']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>  
                        <a class='btn-adj' style='margin-top: 5px' href='admin.php?DelTG=".$row['MaTacGia']."' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
                        echo "</td>";
                        echo '</tr>';     
                        echo '</tr>';
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
<!-- <style>
    .btn-adj {
        display: inline-block;
        padding: 8px 12px;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
        border-radius: 4px;
        margin-right: 5px;
        margin-top: 5px;
    }
</style> -->