<?php
    include_once('Model/mTG.php');
    class controlTG{
        function getAllTG(){
            $p = new modelTG();
            $tblTG = $p -> selectAllTGHd();
            if (!$tblTG) {
                return false;
            } else {
                if (mysql_num_rows($tblTG) > 0)
                {
                    return $tblTG;
                } else {
                    return 0;
                }
            }
        }

        function addTG($HoTen, $NgaySinh, $QuocTich, $NgheDanh){
            include_once('format.php');
            $p = new modelTG();
            $tbl = $p->selectAllTG();
            mysql_data_seek($tbl, mysql_num_rows($tbl)-1);
            $row = mysql_fetch_assoc($tbl);
            // print_r($row);
            $so = preg_replace("/[^0-9]/", "", $row['MaTacGia']);
            $ma = $so+1;
            $identityVariable =  formatData('TG',$ma);
            $ins = $p -> insertTG($identityVariable, $HoTen,  $NgaySinh, $QuocTich, $NgheDanh);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the insert
            }
        }

        function deleTG($idTG){
            $p = new modelTG();
            $tbl = $p->viewSachOfTG($idTG);
            if (mysql_num_rows($tbl) > 0){
                return 0;
            } else {
                $ins = $p -> deleteTG($idTG);
                return 1;
            }
        }
        
        
        function updTG($id, $HoTen, $NgaySinh, $QuocTich, $NgheDanh){
            $p = new modelTG();
            $ins = $p -> updateTG($id, $HoTen, $NgaySinh, $QuocTich, $NgheDanh);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the update
            }
        }

        function getAllTGByName($name){
            $p = new modelTG();
            $tblProduct = $p -> selectAllTGByName($name);
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

        function getAllTGById($id){
            $p = new modelTG();
            $tblProduct = $p -> selectAllTGById($id);
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