<?php
    include_once('Model/mLS.php');
    class controlLS{
        function getAllLS(){
            $p = new modelLS();
            $tblLS = $p -> selectAllLSHd();
            if (!$tblLS) {
                return false;
            } else {
                if (mysql_num_rows($tblLS) > 0)
                {
                    return $tblLS;
                } else {
                    return 0;
                }
            }
        }

        function addLS($tenls){
            include_once('format.php');
            $p = new modelLS();
            $tbl = $p->selectAllLS();
            mysql_data_seek($tbl, mysql_num_rows($tbl)-1);
            $row = mysql_fetch_assoc($tbl);
            // print_r($row);
            $so = preg_replace("/[^0-9]/", "", $row['MaLoai']);
            $ma = $so+1;
            $identityVariable =  formatData('LS',$ma);
            $ins = $p -> insertLS($identityVariable, $tenls);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the insert
            }
        }

        function deleLS($idLS){
            $p = new modelLS();
            $tbl = $p->viewSachOfLS($idLS);
            if (mysql_num_rows($tbl) > 0){
                return 0;
            } else {
                $ins = $p -> deleteLS($idLS);
                return 1;
            }
        }
        
        
        function updLS($id, $name){
            $p = new modelLS();
            $ins = $p -> updateLS($id, $name);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the update
            }
        }

        function getAllLSByName($name){
            $p = new modelLS();
            $tblProduct = $p -> selectAllLSByName($name);
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

        function getAllLSById($id){
            $p = new modelLS();
            $tblProduct = $p -> selectAllLSById($id);
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