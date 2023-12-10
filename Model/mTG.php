<?php
    include_once('connect.php');
    class modelTG{
        function selectAllTGHd(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from tacgia where TrangThaiXoa=0';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllTG(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from tacgia';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function insertTG($ma, $HoTen, $NgaySinh, $QuocTich, $NgheDanh){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "insert into tacgia(MaTacGia, HoTen, NgaySinh, QuocTich, NgheDanh) values";
                $string .= " ('".$ma."','".$HoTen."','".$NgaySinh."','".$QuocTich."','".$NgheDanh."')";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                if ($kq) {
                    return $kq;
                }
            } else {
                return false;
            }
        }

        function deleteTG($idTG){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "update tacgia set TrangThaiXoa = 1 where MaTacGia='$idTG'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function viewSachOfTG($idTG){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM sach
                JOIN sach_tacgia ON sach.MaSach = sach_tacgia.MaSach
                where sach_tacgia.MaTacGia='$idTG'";// v chỉnh lại sao huy .sao nó ra cái chữ
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }
        
        function selectAllTGByName($name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from tacgia where HoTen like '%".$name."%'";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function selectAllTGById($idTG){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from tacgia where MaTacGia like '".$idTG."'";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function updateTG($id, $HoTen, $NgaySinh, $QuocTich, $NgheDanh){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                // print_r($id.'; '.$HoTen.' ;'. $NgaySinh. ' ;'. $QuocTich.'; '. $NgheDanh); rồi
                $string = "UPDATE tacgia SET HoTen = '$HoTen', NgaySinh = '$NgaySinh', QuocTich = '$QuocTich', NgheDanh = '$NgheDanh' WHERE MaTacGia like '$id';";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        // Sách - tác giả
        function selectAllDs(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from sach_tacgia ORDER BY MaDS ASC';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function insertDs($id, $idAuthor, $idBook){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "insert into sach_tacgia value('$id', '$idAuthor', '$idBook')";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function updateDs($id, $idBook){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE sach_tacgia SET MaSach = '$idBook' WHERE MaDS = '$id'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function deleteDs($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "delete from sach_tacgia where MaDS = '$id'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
    }
?>