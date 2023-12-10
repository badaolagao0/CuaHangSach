<?php
    include_once('connect.php');
    class modelNXB{
        // sắp xếp NXB theo id giảm dần, sau đó chọn 5(là $count) sản phẩm từ trên xuống bắt đầu từ limit
        function selectNXBOnPage($limit,$count){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM nhaxuatban where TrangThaiXoa=0 ORDER BY MaNXB DESC limit $limit,$count";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllNXBHd(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from nhaxuatban where TrangThaiXoa=0';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllNXB(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from nhaxuatban';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function insertNXB($ma, $tennxb, $diachi, $namthanhlap){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "insert into nhaxuatban(MaNXB, TenNXB, DiaChi, NamThanhLap) values";
                $string .= " ('".$ma."','".$tennxb."','".$diachi."',".$namthanhlap.")";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                if ($kq) {
                    return $kq;
                }
            } else {
                return false;
            }
        }

        function deleteNXB($idNXB){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "update nhaxuatban set TrangThaiXoa = 1 where MaNXB='$idNXB'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function viewSachOfNXB($idNXB){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from sach where MaNXB='$idNXB' and TrangThaiXoa = 0";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }
        
        function selectAllNxbByName($name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from nhaxuatban where TenNXB like '%".$name."%'";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function selectAllNxbById($idNXB){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from nhaxuatban where MaNXB like '".$idNXB."'";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function updateNXB($id, $name, $year, $address){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE nhaxuatban SET TenNXB = '$name', DiaChi = '$address', NamThanhLap = $year  WHERE MaNXB like '$id';";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }
    }
?>