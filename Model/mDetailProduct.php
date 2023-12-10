<?php 
    include_once("connect.php");
    
    class modelDetail{
        function SelectDetailProduct($maSach){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);
    
            if($result){
                $query = "SELECT *
                FROM sach_tacgia
                JOIN sach ON sach_tacgia.MaSach = sach.MaSach
                JOIN tacgia ON sach_tacgia.MaTacGia = tacgia.MaTacGia
                JOIN loaisach ON sach.MaLoai = loaisach.MaLoai
                JOIN nhaxuatban ON nhaxuatban.MaNXB = sach.MaNXB
                WHERE sach_tacgia.MaSach ='".$maSach."'";
                $tbl = mysql_query($query);
    
                $p -> CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        // Xem tất cả giỏ hàng
        function selectAllGh(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from giohang';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
        
        // Thêm sách vào giỏ hàng
        function insertSachToGh($idGh, $idSach, $idKh, $amount){
            $con;
            $p = new connect(); 
            if ($p -> ConnectDB($con)){
                // $string = "insert into giohang(MaGioHang, MaKH, SoLuongMua, MaSach) values ('$idGh', '$idKh', $amount, '$idSach');";
                $string = "insert into giohang(MaGioHang, MaKH, SoLuongMua, MaSach) values ('$idGh', '$idKh', $amount, '$idSach')";
                // print_r("Model: $idGh, $idSach, $idKh, $amount \n");
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function updateSachToGh($idGh, $amount){
            $con;
            $p = new connect(); 
            if ($p -> ConnectDB($con)){
                $string = "UPDATE giohang SET SoLuongMua=$amount where MaGioHang like '$idGh'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

    }
?>