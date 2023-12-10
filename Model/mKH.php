<?php
    include_once('connect.php');
    class modelKH{
        function selectAllKH(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from khachhang join loaikhachhang on khachhang.MaLoaiKH = loaikhachhang.MaLoaiKH where TrangThaiXoa = 0';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
        function selectAllKH_ForID(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from khachhang';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function insertKH($ma, $hotenKH, $ngaysinh, $email, $sdt, $password, $diemtichluy, $maloaiKH){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'insert into khachhang(MaKH, HoTen, NgaySinh, Email, SoDienThoai, MatKhau, DiemTichLuy, MaLoaiKH) values';
                $string .= "('". $ma ."','".$hotenKH."','".$ngaysinh."','".$email."','".$sdt."','".$password."','".$diemtichluy."','".$maloaiKH."')";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                if ($kq) {
                    return $kq;
                }
            } else {
                return false;
            }
        }

        function deleteKH($idKH){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                // $string = "delete from khachhang where MaKH = '".$idKH."'";
                $string = "update khachhang set TrangThaiXoa = '1' where MaKH = '" . $idKH . "'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function selectAllKHByName($name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from khachhang where HoTen like '%".$name."%'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllKHById($idKH){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from khachhang where MaKH like '".$idKH."'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function updateKH($ma, $hotenKH, $ngaysinh, $email, $sdt, $diemtichluy, $maloaiKH, $password){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE khachhang SET HoTen = '$hotenKH',NgaySinh = '$ngaysinh',Email = '$email',SoDienThoai = '$sdt', MatKhau = '$password',DiemTichLuy = '$diemtichluy', MaLoaiKH = '$maloaiKH' WHERE MaKH = '$ma' ";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function updateMatKhau($ma, $matkhau){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE khachhang SET MatKhau = '$matkhau' WHERE MaKH = '$ma' ";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

         // get all loai khach hang
        function selectAllLoaiKH(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from loaikhachhang';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
    }
?>