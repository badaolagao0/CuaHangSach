<?php
    include_once('connect.php');
    class modelNV{
        function selectAllNV(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from nhanvien where TrangThaiXoa = "0"';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllNV_ForID(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from nhanvien';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function insertNV($ma, $hotenNV, $ngaysinh, $email, $sdt, $password, $luong, $maloaiNV, $trangThaiHD){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'insert into nhanvien(MaNhanVien, HoTen, Email, SoDienThoai, MatKhau, Luong, NgaySinh, TrangThaiHD, MaLoaiNV) values';
                $string .= "('$ma','$hotenNV','$email','$sdt','$password','$luong','$ngaysinh','$trangThaiHD','$maloaiNV')";
            // print_r($identityVariable.'; '.$hotenNV.'; '.$ngaysinh.'; '.$email.'; '.$sdt.'; '.$password.'; '.$luong.'; '.$maloaiNV.'; '.$trangThaiHD);
                // print_r($string);
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                if ($kq) {
                    return $kq;
                }
            } else {
                return false;
            }
        }

        function deleteNV($idNV){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                // $string = "delete from nhanvien where MaNhanVien = '".$idNV."'";
                $string = "update nhanvien set TrangThaiXoa='1' where MaNhanVien = '" . $idNV . "'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function selectAllNVByName($name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from nhanvien where HoTen like '%".$name."%'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllNVById($idNV){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from nhanvien where MaNhanVien like '".$idNV."'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function updateNV($ma, $hotenNV, $ngaysinh, $email, $sdt, $password, $luong, $maloaiNV, $trangThaiHD){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE nhanvien SET HoTen = '".$hotenNV."', Email = '".$email."', SoDienThoai = '".$sdt."', MatKhau = '$password' ,Luong = '".$luong."', NgaySinh = '".$ngaysinh."', TrangThaiHD = '".$trangThaiHD."', MaLoaiNV = '".$maloaiNV."' WHERE MaNhanVien = '".$ma."'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function updateMatKhauNv($ma, $matkhau){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE nhanvien SET MatKhau = '$matkhau' WHERE MaNhanVien = '$ma' ";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function selectAllLoaiNV(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from loainv';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
    }
?>