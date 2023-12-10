<?php
    session_start();
        include_once('./Controller/cNXB.php');
        function getNameNXB($nxb){
            $p = new controlNXB();
            $tbl = $p -> getAllNXB();
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    if ($row['MaNXB'] == $nxb) {
                        return $row['TenNXB'];
                    }
                }
            }
        } 

        include_once('./Controller/cModule.php');
        function getNameCategory($category){
            $p = new controlModule();
            $tbl = $p -> getAllLoaiSach();
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    if ($row['MaLoai'] == $category) {
                        return $row['TenLoai'];
                    }
                }
            }
        } 

        function checkSoLuongTrong(){
            $p = new controlModule();
            $tbl = $p -> getAllKho();
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    return $row['SoLuongTong'] - $row['SoLuongTonKho'];
                }
            }
        } 

        // include_once('./Controller/cModule.php');
        function getNameKH($KH){
            $p = new controlModule();
            $tbl = $p -> getAllKH();
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    if ($row['MaKH'] == $KH) {
                        return $row['HoTen'];
                    }
                }
            }
        } 

        function getNameSach($Sach){
            $p = new controlModule();
            $tbl = $p -> getAllSach();
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    if ($row['MaSach'] == $Sach) {
                        return $row['TieuDe'];
                    }
                }
            }
        } 

        function getDetailDonDatHang($sach, $soluong){
            $p = new controlModule();
            $sachArr = preg_split('/\s+/', $sach);
            $soluongArr = preg_split('/\s+/', $soluong);
                for ($i = 0; $i < count($sachArr); $i++){
                        $tbl = $p -> getAllBookByIdForDetail($sachArr[$i]);
                        if ($tbl){
                            // <p>'.$row['TieuDe'].' x'.$soluongArr[$i].' '.$row["DonGia"].'.000đ</p>
                            while ($row = mysql_fetch_assoc($tbl)){
                                if ($i == 1) {
                                    echo'<div class="row">
                                            <div class="col-md-4 control-label"></div>
                                            <div class="col-md-8" style="display: flex">
                                                <img style="width: 5rem; height: 5rem;" src ="image/'.$row['HinhAnh'].'"/>
                                                <div>
                                                    <p>'.$row['TieuDe'].'</p>
                                                    <div style="display: flex;  justify-content: space-between;">
                                                        <p>x'.$soluongArr[$i].'</p> 
                                                        <p>'.$row["DonGia"].'.000đ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                } else {
                                    echo'      <div class="row">
                                            <div class="col-md-4 control-label">
                                                    <p>Sách:</p>
                                            </div>
                                            <div class="col-md-8" style="display: flex">
                                                <img style="width: 5rem; height: 5rem;" src ="image/'.$row['HinhAnh'].'"/>
                                                <div>
                                                    <p>'.$row['TieuDe'].'</p>
                                                    <div style="display: flex;     justify-content: space-between;">
                                                    <p>x'.$soluongArr[$i].'</p> 
                                                    <p>'.$row["DonGia"].'.000đ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            }
                        }
            }
        } 

        function gettacgia($Sach){
            $p = new controlModule();
            $tbl = $p -> getAllBookByID($Sach);  
            while ($row = mysql_fetch_assoc($tbl)) {
                $string .= $row['NgheDanh'] . ', ';
                return $string;
            }
        }

        function getImgSach($Sach){
            $p = new controlModule();
            $tbl = $p -> getAllSach();
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    if ($row['MaSach'] == $Sach) {
                        return $row['HinhAnh'];
                    }
                }
            }
        }
         
        function GetSLByMaSach($idSach){
            $p = new controlModule();
            $tbl = $p -> getAllBookById($idSach);
            if (mysql_num_rows($tbl) > 0){
                while ($row = mysql_fetch_assoc($tbl)){
                    if ($row['MaSach'] == $idSach) {
                        return $row['SoLuong'];
                    }
                }
            }
        } 

    // phân trang admin
    function pagination($amountObject, $currentPage, $temp, $productpage){
        $sumpage = ceil($amountObject/$productpage);
            echo '<div class="container mt-3">';
            echo '<ul class="pagination justify-content-center">';
            // kiểm tra lấy số page trên link xuống xem, nếu page bằng 1 thì không trở về page trước được nửa nên disable nó đi
            if($currentPage){
                echo '<li class="page-item disabled"><a class="page-link" href="'.$temp.'='.($currentPage-1).'#sanpham">Previous</a></li>';
            }else{
                echo '<li class="page-item"><a class="page-link" href="'.$temp.'='.($currentPage-1).'#sanpham">Previous</a></li>';
            }
            // Vòng for in ra các trang ví dụ: 1,2,3,...
            for($i = 1;$i <= $sumpage;$i++){
                // kiểm tra lấy số page trên link xuống, nếu bằng với số $i có nghĩa là đang nằm trên page này nên active cho nó sáng lên 
                if($currentPage == $i){
                    echo '<li class="page-item active"><a class="page-link" href="'.$temp.'='.$i.'#sanpham">'.$i.'</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link" href="'.$temp.'='.$i.'#sanpham">'.$i.'</a></li>';
                }
            }
            // kiểm tra lấy số page trên link xuống xem, nếu page bằng $sumpage(số page lớn nhất được tính) thì không next page sau được nửa nên disable nó đi
            if($sumpage == $currentPage){
                echo '<li class="page-item disabled"><a class="page-link" href="'.$temp.'='.($currentPage+1).'#sanpham">Next</a></li>';
            }else{
                echo '<li class="page-item"><a class="page-link" href="'.$temp.'='.($currentPage+1).'#sanpham">Next</a></li>';
            }
            echo '</ul>';
            echo '</div>';
    }
?>