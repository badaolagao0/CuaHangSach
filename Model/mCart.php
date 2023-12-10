<?php
    include_once("connect.php");
    class ModelCart{
        function Cart($ma){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);

            if($result){
                $query = "SELECT *
                FROM giohang
                JOIN sach ON giohang.MaSach = sach.MaSach
                JOIN khachhang ON giohang.MaKH = khachhang.MaKH 
                where giohang.MaKH = '$ma'";
                $tbl = mysql_query($query);

                $p -> CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        function DeleteProductInCart($ma){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);

            if($result){
                $query = "DELETE 
                FROM giohang
                where MaGioHang = '$ma'";
                $tbl = mysql_query($query);

                $p -> CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        function InfoVanChuyen($ma){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);

            if($result){
                    $query = "SELECT DISTINCT NoiGiao, SoDienThoai, HoTen
                    FROM dondathang
                    JOIN khachhang ON dondathang.MaKH = khachhang.MaKH
                    where dondathang.MaKH = '$ma'";
                $tbl = mysql_query($query);

                $p -> CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }
        
        function InfoVanChuyenNew($ma){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);

            if($result){
                    $query = "SELECT SoDienThoai, HoTen
                    FROM khachhang 
                    where MaKH = '$ma'";
                $tbl = mysql_query($query);

                $p -> CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        function AddDonHang($makh,$noigiao,$tongtien,$products,$idCart){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);
            if($result){
                // lấy tất cả donhang
                $donhang = mysql_query("select * from dondathang");
                $max=0;//tìm mã đơn hàng lớn nhất để cộng thêm 1
                if(mysql_num_rows($donhang) > 0){
                    while($row = mysql_fetch_assoc($donhang)){
                        // Tách chữ, chỉ giữ lại số
                        $so = preg_replace("/[^0-9]/", "", $row['MaDonHang']);
                        if($so > $max){ 
                            $max = $so; 
                        }
                    }
                }
                $madh = $max+1;
                $identityVariable =  "DH"."$madh";
                //xử lý chuỗi ID sách và số lượng sách
                $IDSach='';
                $soluongsach='';
                foreach ($products as $product) {
                    $IDSach .= $product["productId"] . ' ';
                    $soluongsach .= $product["quantity"]  . ' '; 
                }


                $query = "INSERT INTO dondathang(MaNhanVien,
                    MaDonHang ,
                    MaKH ,
                    MaSach ,
                    NgayGiao ,
                    SoLuong ,
                    GhiChu ,
                    NoiGiao ,
                    TongTien ,
                    ChiTietDonHang ,
                    ChiTietSoLuong,
                    TinhTrang
                    )
                    VALUES (
                        'NV01',
                    '$identityVariable', '$makh', 'S01', '0000-00-00' , '1', NULL , '$noigiao', '$tongtien', '$IDSach', '$soluongsach',0
                    );";
                $kq = mysql_query($query);
                // update số lượng sách trong database
                foreach ($products as $product) {
                    $masachmua = $product["productId"];
                    $soluongmua = $product["quantity"]; //số lượng sách mua
                    $soluongmua = intval($soluongmua);
                    $tblsoluong =  mysql_query("select SoLuong from sach where MaSach='$masachmua'");
                    $rowSoLuong = mysql_fetch_assoc($tblsoluong);
                    $Tongsoluong = $rowSoLuong["SoLuong"];

                    mysql_query("UPDATE sach SET SoLuong = ( $Tongsoluong - $soluongmua) WHERE MaSach = '$masachmua'");
                }

                // xóa giỏ hàng theo mã đã đặt
                for ($i = 0; $i < count($idCart); $i++) {
                    mysql_query("DELETE 
                    FROM giohang
                    where MaGioHang = '".$idCart[$i]."'");;// gọi hàm xóa đã viết ở trên để xóa giỏ hàng đã đặt
                }

                $p -> CloseConnect($conn);
                return $kq;
            }else{
                return false;
            }
        }

        // function lấy tống số lượng sách trong kho theo mã
        function TongSLByMaSach($ma){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);

            if($result){
                $tblsoluong =  mysql_query("select SoLuong from sach where MaSach='$ma'");
                $rowSoLuong = mysql_fetch_assoc($tblsoluong);
                $Tongsoluong = $rowSoLuong["SoLuong"];
                return $Tongsoluong;
            }else{
                return false;
            }
        }

        // thêm vào giỏ hàng
        function AddCart($masach, $soluong, $makh){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);
            if($result){
                // lấy tất cả giỏ
                $donhang = mysql_query("select * from giohang");
                $max=0;//tìm mã giỏ hàng lớn nhất để cộng thêm 1
                if(mysql_num_rows($donhang) > 0){
                    while($row = mysql_fetch_assoc($donhang)){
                        // Tách chữ, chỉ giữ lại số
                        $so = preg_replace("/[^0-9]/", "", $row['MaGioHang']);
                        if($so > $max){ 
                            $max = $so; 
                        }
                    }
                }
                $madh = $max+1;
                $identityVariable =  "GH"."$madh";
                //xử lý chuỗi ID sách và số lượng sách

                $query = "INSERT INTO giohang(
                    MaGioHang ,
                    MaKH ,
                    SoLuongMua ,
                    MaSach 
                    )
                    VALUES (
                    '$identityVariable', '$makh', $soluong,'$masach');";
                $kq = mysql_query($query); 

                $p -> CloseConnect($conn);
                return $kq;
            }else{
                return false;
            }
        }

        // cập nhật số lượng sách trong giỏ hàng
        function UpdateCart($masach, $soluong, $makh){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);
            if($result){
                // lấy tất cả giỏ
                $query = mysql_query("UPDATE giohang 
                                    SET SoLuongMua = $soluong
                                    WHERE MaKH = '$makh' AND MaSach = '$masach'");
                
                $kq = mysql_query($query); 

                $p -> CloseConnect($conn);
                return $kq;
            }else{
                return false;
            }
        }
    }

?>