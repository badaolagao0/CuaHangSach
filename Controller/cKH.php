<?php
    include_once('Model/mKH.php');
    class controlKH{
        function getAllKH(){
            $p = new modelKH();
            $tblKH = $p -> selectAllKH();
            if (!$tblKH) {
                return false;
            } else {
                if (mysql_num_rows($tblKH) > 0)
                {
                    return $tblKH;
                } else {
                    return 0;
                }
            }
        }

        function addKH($khName, $ngaysinh, $email, $sdt, $diemtl, $loaikh, $password){
            include_once('format.php');
            $p = new modelKH();
            $tbl = $p->selectAllKH_ForID();
            mysql_data_seek($tbl, mysql_num_rows($tbl)-1);
            $row = mysql_fetch_assoc($tbl);
            // print_r($row);
            $so = preg_replace("/[^0-9]/", "", $row['MaKH']);
            $ma = $so+1;
            $identityVariable =  formatData('KH',$ma);
            $ins = $p -> insertKH($identityVariable, $khName, $ngaysinh, $email, $sdt, $password, $diemtl, $loaikh);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the insert
            }
        }

        function deleKH($idKH){
            $p = new modelKH();
            $ins = $p -> deleteKH($idKH);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the insert
            }
        }

        function updKH($id ,$khName, $ngaysinh, $email, $sdt, $diemtl, $loaikh, $password){
            $p = new modelKH();
            $ins = $p -> updateKH($id, $khName, $ngaysinh, $email, $sdt, $diemtl, $loaikh, $password);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the update
            }
        }

        function updMatkhau($id , $matkhau){
            $p = new modelKH();
            $ins = $p -> updateMatKhau($id, $matkhau);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the update
            }
        }

        function getAllKHByName($name){
            $p = new modelKH();
            $tblProduct = $p -> selectAllKHByName($name);
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

        function getAllKHById($id){
            $p = new modelKH();
            $tblProduct = $p -> selectAllKHById($id);
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
        // get all loai khach hang
        function getAllLoaiKH(){
            $p = new modelKH();
            $tblProduct = $p -> selectAllLoaiKH();
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