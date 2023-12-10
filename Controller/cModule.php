<?php
    include_once('Model/mModule.php');
    include_once('Controller/format.php');
    class controlModule{
        // sách
        function getAllSach(){
            $p = new modelModule();
            $tbl = $p -> selectAllSach();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }
        
        // lấy tổng số sách
        function countProduct(){
            $p = new modelModule();
            $tbl = $p->selectAllSach();
            return mysql_num_rows($tbl);
        }
        
        function getProductOnPage($page,$count){
            $p = new modelModule();
            $tbl = $p->selectSachOnPage(($page - 1)*$count,$count);
            return $tbl;
        }

        // phân trang khi tìm theo tên
        function countProductByName(){
            $p = new modelModule();
            $tbl = $p->selectAllBookByName();
            return mysql_num_rows($tbl);
        }
        
        function getAllSachOnPageByName($page,$count, $name){
            $p = new modelModule();
            $tbl = $p->selectAllSachOnPageByName(($page - 1)*$count,$count, $name);
            return $tbl;
        }

        
        function getAllSachLatest(){
            $p = new modelModule();
            $tbl = $p -> selectAllSachLatest();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function getAllBookByName($name){
            $p = new modelModule();
            $tblProduct = $p -> selectAllBookByName($name);
            if (!$tblProduct){
                return false;
            } else {
                if (mysql_num_rows($tblProduct)>0) {
                    return $tblProduct;
                } else {
                    return 0;
                }
            }
        } 

        function getAllBookById($id){
            $p = new modelModule();
            $tblProduct = $p -> selectAllBookById($id);
            if (!$tblProduct){
                return false;
            } else {
                if (mysql_num_rows($tblProduct)>0) {
                    return $tblProduct;
                } else {
                    return 0;
                }
            }
        }

        function getAllBookByIdForDetail($id){
            $p = new modelModule();
            $tblProduct = $p -> selectBookByIdForDetail($id);
            if (!$tblProduct){
                return false;
            } else {
                if (mysql_num_rows($tblProduct)>0) {
                    return $tblProduct;
                } else {
                    return 0;
                }
            }
        } 

        function addBook($name, $anh, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse, $author){
            include_once('format.php');
            $p = new modelModule();
            // insert sach
            $tbl = $p->selectAllSach2();
            if(mysql_num_rows($tbl) > 0) {
                // di chuyển trỏ chuột lên dòng đầu tiên
                mysql_data_seek($tbl, 0);
                $row = mysql_fetch_assoc($tbl);
                $so = preg_replace("/[^0-9]/", "", $row['MaSach']);
                $ma = $so+1;
                $identityVariable =  formatData('S',$ma);
                $nameAnh = $anh['name'];
                if (move_uploaded_file($anh['tmp_name'],"image/$nameAnh")){
                    $ins = $p -> insertBook($identityVariable ,$name, $nameAnh, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse);
                    $this -> tinhSoLuongTon();
                    if ($ins) {
                            for ($i = 0; $i < count($author); $i++) {
                                $res = $this -> insertSachTacGia($author[$i], $identityVariable);
                            }
                            return 1;
                        } else {
                            return 0; //Khong the insert sach
                        }
                } else {
                    return -1; //$imageErr = 'Không lưu được ảnh!';
                }
            } else {
                $ins = $p -> insertBook('S01' ,$name, $nameAnh, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse);
                $this -> tinhSoLuongTon();
                if ($ins) {
                    for ($i = 0; $i < count($author); $i++) {
                        $res = $this -> insertSachTacGia($author[$i], $identityVariable);
                    }
                    return 1;
                } else {
                    return 0; //Khong the insert sach
                }
            }
        }

        function deleBook($idBook){
            $p = new modelModule();
            $ins = $p -> deleteBook($idBook);
            $this -> tinhSoLuongTon();
            if ($ins) {
                return 1;
            } else {
                return 0;
            }
        }
        
        function updBookHaveImage($id, $name, $anh, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse, $author, $idDS){
            $p = new modelModule();
            $nameAnh = $anh['name'];
            if (move_uploaded_file($anh['tmp_name'],"image/$nameAnh")){
                    $ins = $p -> updateBookHaveImage($id, $name, $nameAnh, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse);
                    $this -> tinhSoLuongTon();
                    if ($ins) {
                        $this -> xulyUpdateSach($author, $idDS, $id);
                        return 1;
                    } else {
                        return 0; //Khong the update
                    }
            } else {
                return -1; //$imageErr = 'Không lưu được ảnh!';
            }
        }

        function updBookNoImage($id, $name, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse, $author, $idDS){
            $p = new modelModule();
            $ins = $p -> updateBookNoImage($id, $name, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse);
            $this -> tinhSoLuongTon();
            if ($ins) {
                $this -> xulyUpdateSach($author, $idDS, $id);
                return 1;
            } else {
                return 0; //Khong the update
            }

        }

        // sách - tác giả
        function insertSachTacGia($idAuthor, $idBook){
            $p = new modelModule();
                $tblAuthor = $p ->selectAllDs();
                if(mysql_num_rows($tblAuthor) > 0) {
                    mysql_data_seek($tblAuthor, mysql_num_rows($tblAuthor)-1);
                    $rowDs = mysql_fetch_assoc($tblAuthor);
                    $soDs = preg_replace("/[^0-9]/", "", $rowDs['MaDS']);
                    $maDs = $soDs+1;
                    $idDs =  formatData('DS',$maDs);
                    $insDs = $p -> insertDs($idDs, $idAuthor, $idBook);
                } else {
                    $insDs = $p -> insertDs('DS01', $idAuthor, $idBook);
                }
        }

        function updateSachTacGia($idDS, $idAuthor){
            $p = new modelModule();
            $result = $p->updateDs($idDS, $idAuthor);
        }

        function deleteSachTacGia($id){
            $p = new modelModule();
            $result = $p->deleteDs($id);
        }

        function xulyUpdateSach($author, $idDS, $id){
            $dem = count($author) - count($idDS);
                if ($dem == 0) {
                    for ($i = 0; $i < count($author); $i++) {
                        for ($j = $i; $j < count($idDS); $j++) {
                            $this -> updateSachTacGia($idDS[$j], $author[$i]);
                            break;
                        }
                    }
                } elseif ($dem > 0){
                        for ($i = count($idDS); $i < count($author); $i++) {
                            $this -> insertSachTacGia($author[$i], $id);
                        }
                        for ($k = 0; $k < count($author); $k++) {
                            for ($j = $k; $j < count($idDS); $j++) {
                                $this -> updateSachTacGia($idDS[$j], $author[$k]);
                                break;
                            }
                        }
                    } else {
                        $soDem = abs($dem);
                        for ($i = count($idDS)-1; $i >= 0 ; $i--) {
                            if ($soDem>0) {
                                $this -> deleteSachTacGia($idDS[$i]);
                                $soDem--;
                            }
                        }
                        for ($k = 0; $k < count($author); $k++) {
                            for ($j = $k; $j < count($idDS); $j++) {
                                $this -> updateSachTacGia($idDS[$j], $author[$k]);
                                break;
                            }
                        }
                }
        }

        // đơn đặt hàng
        function getAllDonDatHang(){
            $p = new modelModule();
            $tbl = $p -> selectAllDonDatHang();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function getDonDatHangOfKh($nameKh){
            $p = new modelModule();
            $tbl = $p -> selectDonDatHangOfKh($nameKh);
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function getDonDatHangOnPage($page,$count){
            $p = new modelModule();
            $tbl = $p -> selectDonDatHangOnPage(($page - 1)*$count,$count);
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function countDonDatHang(){
            $p = new modelModule();
            $tbl = $p->selectAllDonDatHang();
            return mysql_num_rows($tbl);
        }

        // kho sách
        function getAllKho(){
            $p = new modelModule();
            $tbl = $p -> selectAllKho();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function tinhSoLuongTon(){
            $p = new modelModule();
            $tbl = $p -> capNhatSLTonKho();
            return 0;
        } 
        
        // thể loại
        function getAllLoaiSach(){
            $p = new modelModule();
            $tbl = $p -> selectAllLoaiSach();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function getAllNhanVien(){
            $p = new modelModule();
            $tbl = $p -> selectAllNhanVien();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }
        
        function getAllProduct(){
            $p = new modelModule();
            $tbl = $p -> SelectAllProduct();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function getAllTacGia(){
            $p = new modelModule();
            $tbl = $p -> SelectAllTacGia();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }
        
        // Khách hàng
        function getAllKH(){
            $p = new modelModule();
            $tbl = $p -> SelectAllKH();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function getInfoKh($id){
            $p = new modelModule();
            $tbl = $p -> getInfoKh($id);
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        
        
        // Bình luận
        function getAllBL(){
            $p = new modelModule();
            $tbl = $p -> selectAllBinhLuan();
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        function getAllBinhLuanByBookName($name){
            $p = new modelModule();
            $tbl = $p -> selectAllBinhLuanOfBook($name);
            if (!$tbl){
                return false;
            } else {
                if (mysql_num_rows($tbl)>0) {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        } 
        
        // lấy tổng số Binh Luan
        function countBinhluan(){
            $p = new modelModule();
            $tbl = $p->selectAllBinhLuan();
            return mysql_num_rows($tbl);
        }
        
        function getBinhluanOnPage($page,$count){
            $p = new modelModule();
            $tbl = $p->selectBinhLuanOnPage(($page - 1)*$count,$count);
            return $tbl;
        }

        function deleBinhLuan($id){
            $p = new modelModule();
            $tbl = $p -> deleteBinhLuan($id);
            if (!$tbl) {
                return false;
            } else {
                if (mysql_num_rows($tbl) > 0)
                {
                    return $tbl;
                } else {
                    return 0;
                }
            }
        }

        // Lấy thông tin user
        function getUser($id){
            $p = new modelModule();
            $tblKh = $p -> chkUserKH($id);
            $tblNv = $p -> chkUserNv($id);
            if (!$tblKh) {
                if (!$tblNv){
                    return false;
                } else {
                    if (mysql_num_rows($tblNv) > 0)
                    {
                        return $tblNv;
                    } else {
                        return 0;
                    }
                }
            } else {
                if (mysql_num_rows($tblKh) > 0)
                {
                    return $tblKh;
                } else {
                    return 0;
                }
            }
        }

        // Tuân
        
    function getAllDonHangChoDuyet()
    {
        $p = new modelModule();
        $tbl = $p->selectAllDonHangChoDuyet();
        if (!$tbl) {
            return false;
        } else {
            if (mysql_num_rows($tbl) > 0) {
                $data;
                while ($row = mysql_fetch_assoc($tbl)) {
                    $maSachs = explode(" ", trim($row['ChiTietDonHang']));
                    $SoLuongs = explode(" ", trim($row['ChiTietSoLuong']));
                    $dataRow = $row;
                    foreach ($maSachs as $key => $maSach) {
                        $sachSelect = $p->selectAllBookById($maSach);
                        $sach = mysql_fetch_assoc($sachSelect);
                        $dataRow['sachs'][$key]['sach'] = $sach;
                        $dataRow['sachs'][$key]['soluong'] = $SoLuongs[$key];
                    }
                    $data[] = $dataRow;
                }
                return $data;
            } else {
                return 0;
            }
        }
    }

    function doiTrangThaiDonHang($id)
    {
        $p = new modelModule();
        $upd = $p->updateStatusOrder($id);
        if ($upd) {
            return 1;
        } else {
            return 0; //Khong the update
        }
    }
    
    function getAllThongKeDoanhThu($start, $end)
    {
        $p = new modelModule();
        $tbl = $p->selectAllThongKeDoanhThu($start, $end);
        if (!$tbl) {
            return false;
        } else {
            if (mysql_num_rows($tbl) > 0) {
                return $tbl;
            }

            return false;
        }
    }
    function getAllThongKeSach($start, $end)
    {
        $p = new modelModule();
        $tbl = $p->selectAllThongKeSach($start, $end);
        if (!$tbl) {
            return false;
        } else {
            if (mysql_num_rows($tbl) > 0) {
                return $tbl;
            }

            return false;
        }
    }

    function getDonDatHang($id)
    {
        $p = new modelModule();
        $tbl = $p->selectAllDonDatHang($id);
        if (!$tbl) {
            return false;
        } else {
            if (mysql_num_rows($tbl) > 0) {
                return $tbl;
            } else {
                return 0;
            }
        }
    }

    function huyDonDatHang($id)
    {
        $p = new modelModule();
        $dlt = $p->huyDonDatHang($id);
        if ($dlt) {
            return 1;
        } else {
            return 0; //Khong the update
        }
    }
    }
?>