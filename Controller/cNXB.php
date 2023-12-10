<?php
    include_once('Model/mNXB.php');
    class controlNXB{
        function getAllNXB(){
            $p = new modelNXB();
            $tblNXB = $p -> selectAllNXBHd();
            if (!$tblNXB) {
                return false;
            } else {
                if (mysql_num_rows($tblNXB) > 0)
                {
                    return $tblNXB;
                } else {
                    return 0;
                }
            }
        }

        // lấy tổng số nxb còn hoạt động
        function countNXB(){
            $p = new modelNXB();
            $tbl = $p->selectAllNXBHd();
            return mysql_num_rows($tbl);
        }
        
        function getNXBOnPage($page,$count){
            $p = new modelNXB();
            $tbl = $p->selectNXBOnPage(($page - 1)*$count,$count);
            return $tbl;
        }

        function addNXB($tennxb, $diachi, $namthanhlap){
            include_once('format.php');
            $p = new modelNXB();
            $tbl = $p->selectAllNXB();
            mysql_data_seek($tbl, 0);
            $row = mysql_fetch_assoc($tbl);
            $so = preg_replace("/[^0-9]/", "", $row['MaNXB']);
            $ma = $so+1;
            $identityVariable =  formatData('NXB',$ma);
            $ins = $p -> insertNXB($identityVariable, $tennxb, $diachi, $namthanhlap);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the insert
            }
        }

        function deleNXB($idNXB){
            $p = new modelNXB();
            $tbl = $p->viewSachOfNXB($idNXB);
            if (mysql_num_rows($tbl) > 0){
                return 0;
            } else {
                $ins = $p -> deleteNXB($idNXB);
                return 1;
            }
        }
        
        
        function updNXB($id, $name, $year, $address){
            $p = new modelNXB();
            $ins = $p -> updateNXB($id, $name, $year, $address);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the update
            }
        }

        function getAllNxbByName($name){
            $p = new modelNXB();
            $tblProduct = $p -> selectAllNxbByName($name);
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

        function getAllNxbById($id){
            $p = new modelNXB();
            $tblProduct = $p -> selectAllNxbById($id);
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
    }
?>