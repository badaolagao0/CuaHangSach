<?php
    include_once('./Controller/cLS.php');
    class viewLS{
        function viewAllLS(){
            $p = new controlLS();
            $tblLS = $p -> getAllLS();
            $location = 'admin.php';
            $this -> displayLS($tblLS, $location);
        }

        function viewLSByName($ten){
            $p = new controlLS();
            $tblLS = $p -> getAllLSByName($ten);
            $location = 'admin.php?ls';
            $this -> displayLS($tblLS, $location);
        }

        function displayLS($tblLS, $location){
            if ($tblLS) {
                if (mysql_num_rows($tblLS) > 0){
                    $dem = 0 ;
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ LOẠI SÁCH</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchNameLS" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddLS'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã thể loại</th>';
                    echo '<th scope="col">Tên thể loại</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tblLS)){
                        if ($row['TrangThaiXoa'] == 0) {
                            echo '<tr>';
                            $MaLoai = $row['MaLoai'];                    
                            $TenLoai = $row['TenLoai'];
                            echo '<th scope="row">'.$MaLoai.'</th>';
                            echo ' <td>'.$TenLoai.'</td>';
                            echo "<td><a class='btn-adj' href='admin.php?UpdLS=".$row['MaLoai']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>  
                            <a class='btn-adj' style='margin-top: 5px' href='admin.php?DelLS=".$row['MaLoai']."' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
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