<?php
    include_once('./Controller/cNXB.php');
    include_once('View/Module/getInfo.php');
    $p = new controlNXB();
    $productpage= 6;
    $count = $p->countNXB();
    $temp = 'admin.php?pagenxb';
    if (isset($_REQUEST['searchNameNxb'])){
        $ten = $_REQUEST['searchNameNxb'];
        $tbl = $p -> getAllNxbByName($ten);
    }elseif (isset($_REQUEST['pagenxb'])){
        $page = $_REQUEST["pagenxb"];
        $tbl = $p->getNXBOnPage($page,$productpage);
    }elseif($_REQUEST["previous"]){
        echo "<script> alert('có')</script>";
    }

            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ NHÀ XUẤT BẢN</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchNameNxb" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddNXB'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã</th>';
                    echo '<th scope="col">Tên NXB</th>';
                    echo '<th scope="col">Địa chỉ</th>';
                    echo '<th scope="col">Năm thành lập</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        if ($row['TrangThaiXoa'] == 0) {
                            echo '<tr>';
                            $MaNXB = $row['MaNXB'];                    
                            $TenNXB = $row['TenNXB'];                    
                            $DiaChi = $row['DiaChi'];  
                            $NamThanhLap = $row['NamThanhLap'];
                            echo '<th scope="row">'.$MaNXB.'</th>';
                            echo ' <td>'.$TenNXB.'</td>';
                            echo ' <td>'.$DiaChi.'</td>';
                            echo ' <td>'.$NamThanhLap.'</td>';
                            echo "<td><a class='btn-adj' href='admin.php?UpdNXB=".$row['MaNXB']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>  
                            <a class='btn-adj' style='margin-top: 5px' href='admin.php?DelNXB=".$row['MaNXB']."' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
                            echo "</td>";
                            echo '</tr>';     
                            echo '</tr>';
                        }
                    }
                    echo '</tbody>';
                echo '</table>';
                pagination($count, $page, $temp, $productpage);
                } else {
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ NHÀ XUẤT BẢN</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchNameNxb" placeholder="Tìm kiếm" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddNXB'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã</th>';
                    echo '<th scope="col">Tên NXB</th>';
                    echo '<th scope="col">Địa chỉ</th>';
                    echo '<th scope="col">Năm thành lập</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '</table>';
                }
            } else {
                echo "<div style='margin:10px;'> <h2>QUẢN LÝ NHÀ XUẤT BẢN</h2>";
                echo '<form action="#" method="post" >';
                echo '<input type="text" name="searchNameNxb" placeholder="Tìm kiếm" />';
                echo '<button type="submit" class="btn-search">';
                echo '<i class="fas fa-search"></i>';
                echo '</button>';
                echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddNXB'>Thêm</a>";
                echo '</form>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Mã</th>';
                echo '<th scope="col">Tên NXB</th>';
                echo '<th scope="col">Địa chỉ</th>';
                echo '<th scope="col">Năm thành lập</th>';
                echo '<th scope="col">Tùy chỉnh</th>';
                echo '</tr>';
                echo '</thead>';
                echo '</table>';
            }
?>