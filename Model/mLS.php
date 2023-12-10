<?php
    include_once('connect.php');
    class modelLS{
        function selectAllLSHd(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from loaisach where TrangThaiXoa=0';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllLS(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from loaisach';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function insertLS($ma, $tenls){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "insert into loaisach(MaLoai, TenLoai) values";
                $string .= " ('".$ma."','".$tenls."')";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                if ($kq) {
                    return $kq;
                }
            } else {
                return false;
            }
        }

        function deleteLS($idLS){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "update loaisach set TrangThaiXoa = 1 where MaLoai='$idLS'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function viewSachOfLS($idLS){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from sach where MaLoai='$idLS'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }
        
        function selectAllLSByName($name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from loaisach where TenLoai like '%".$name."%'";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function selectAllLSById($idLS){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from loaisach where MaLoai like '".$idLS."'";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function updateLS($id, $name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE loaisach SET TenLoai = '$name' WHERE MaLoai like '$id';";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }
    }
?>