<?php
    include_once('./Controller/cModule.php');
    include_once('getInfo.php');
    $p = new controlModule();
    $productpage= 5;
    $count = $p->countBinhluan();
    $temp = 'admin.php?pagebinhluan';
    if (isset($_REQUEST['searchBinhLuanOfSach'])){
        $ten = $_REQUEST['searchBinhLuanOfSach'];
        $tbl = $p -> getAllBinhLuanByBookName($ten);
    }elseif (isset($_REQUEST['pagebinhluan'])){
        $page = $_REQUEST["pagebinhluan"];
        $tbl = $p->getBinhluanOnPage($page,$productpage);
    }elseif($_REQUEST["previous"]){
        echo "<script> alert('có')</script>";
    }

            if ($tbl) {
                if (mysql_num_rows($tbl) > 0){
                    echo "<div style='margin:10px;'> <h2>DANH SÁCH BÌNH LUẬN</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchBinhLuanOfSach" placeholder="Nhập tên sách" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Khách hàng</th>';
                    echo '<th scope="col">Sách</th>';
                    echo '<th scope="col">Nội dung</th>';
                    echo '<th scope="col">Ngày bình luận</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysql_fetch_assoc($tbl)){
                        echo '<tr>';
                        echo '<td scope="row">'.getNameKH($row['MaKH']).'</td>';
                        echo '<td>'.getNameSach($row['MaSach']).'</td>';
                        echo '<td>'.$row['NoiDung'].'</td>';
                        $formattedDate = date('d/m/Y', strtotime($row['NgayBinhLuan']));
                        echo '<td>'.$formattedDate.'</td>';
                        echo "<td>  
                        <a class='btn-adj' style='margin-top: 5px' href='admin.php?DelBL=".$row['MaBinhLuan']."' onclick='return confirm(\"Có chắc chắn xóa không\")'><i class='fa fa-times' aria-hidden='true'></i></a> </td>";
                        echo "</td>";
                        echo '</tr>';     
                        echo '</tr>';
                    }
                    echo '</tbody>';
                echo '</table>';
                pagination($count, $page, $temp, $productpage);
                } else {
                    echo "<div style='margin:10px;'> <h2>DANH SÁCH BÌNH LUẬN</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchBinhLuanOfSach" placeholder="Nhập tên sách" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Khách hàng</th>';
                    echo '<th scope="col">Sách</th>';
                    echo '<th scope="col">Nội dung</th>';
                    echo '<th scope="col">Ngày bình luận</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    echo '</table>';
                }
            } else {
                echo "<div style='margin:10px;'> <h2>DANH SÁCH BÌNH LUẬN</h2>";
                    echo '<form action="#" method="post" >';
                    echo '<input type="text" name="searchBinhLuanOfSach" placeholder="Nhập tên sách" />';
                    echo '<button type="submit" class="btn-search">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</button>';
                    echo '</form>';
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Khách hàng</th>';
                    echo '<th scope="col">Sách</th>';
                    echo '<th scope="col">Nội dung</th>';
                    echo '<th scope="col">Ngày bình luận</th>';
                    echo '<th scope="col">Tùy chỉnh</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    echo '</table>';
            }
?>