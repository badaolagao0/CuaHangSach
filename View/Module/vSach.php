<?php
    // session_start();
    include_once('./Controller/cModule.php');
    include_once('getInfo.php');
    $p = new controlModule();
    
    $productpage= 5;
    $count = $p->countProduct();
    $temp = 'admin.php?pagesach';
    if (isset($_REQUEST['searchNameBook']) && isset($_REQUEST['pagesach'])){
        $ten = $_REQUEST['searchNameBook'];
        $page = $_REQUEST["pagesach"];
        $tbl = $p -> getAllSachOnPageByName($page, $productpage, $ten);
    }elseif (isset($_REQUEST['pagesach'])){
        $page = $_REQUEST["pagesach"];
        // $tbl2 = $p->getProductOnPage($page,$productpage);
        $tbl = $p->getProductOnPage($page,$productpage);
    }elseif($_REQUEST["previous"]){
        echo "<script> alert('có')</script>";
    }
            
    if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                $demModel = 1;
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ SÁCH</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchNameBook" placeholder="Nhập tên sách" />';
                    echo '<button type="submit" name="searchSach" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddSach'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã sách</th>';
                    echo '<th scope="col">Tiêu đề</th>';
                    echo '<th scope="col">Đơn giá</th>';
                    echo '<th scope="col">Số lượng</th>';
                    echo '<th scope="col">Hình Ảnh</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        echo '<tr>';
                        echo '<th scope="row">'.$row['MaSach'].'</th>';
                        echo ' <td>'.$row['TieuDe'].'</td>';
                        // $formattedNumber = number_format($row['DonGia'], 0, ',', '.');
                        echo ' <td>'.number_format($row['DonGia'], 0, ',', '.').'.000đ</td>';
                        echo ' <td>'.$row['SoLuong'].'</td>';
                        echo ' <td>';
                        echo "<img style='width: 5rem; height: 5rem;' src ='image/".$row['HinhAnh']."'/>";
                        echo '</td>';
                        echo "<td>   
                        <a class='btn-adj' href='admin.php?UpdBook=".$row['MaSach']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>  
                        <a class='btn-adj' style='margin-top: 5px' href='admin.php?DelBook=".$row['MaSach']."
                        ' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
                        echo "</td>";
                        echo '</tr>'; 
                        $demModel += 1;  
                    }
                    echo '</tbody>';
                echo '</table>';
                pagination($count, $page, $temp, $productpage);
                } else {
                    echo "<div style='margin:10px;'> <h2>QUẢN LÝ SÁCH</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchNameBook" placeholder="Nhập tên sách" />';
                    echo '<button type="submit" name="searchSach" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddSach'>Thêm</a>";
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Mã sách</th>';
                    echo '<th scope="col">Tiêu đề</th>';
                    echo '<th scope="col">Đơn giá</th>';
                    echo '<th scope="col">Số lượng</th>';
                    echo '<th scope="col">Hình Ảnh</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    echo '</table>';
                }
            } else {
                echo "<div style='margin:10px;'> <h2>QUẢN LÝ SÁCH</h2>";
                echo '<form action="#" method="post" >';
                echo '<input type="text" name="searchNameBook" placeholder="Nhập tên sách" />';
                echo '<button type="submit" name="searchSach" class="btn-search">';
                echo '<i class="fas fa-search"></i>';
                echo '</button>';
                echo "<a style='float: right;' class='btn btn-success' href='admin.php?rAddSach'>Thêm</a>";
                echo '</form>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Mã sách</th>';
                echo '<th scope="col">Tiêu đề</th>';
                echo '<th scope="col">Đơn giá</th>';
                echo '<th scope="col">Số lượng</th>';
                echo '<th scope="col">Hình Ảnh</th>';
                echo '<th scope="col">Tùy chỉnh</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '</table>';
        }
?>