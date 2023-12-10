<?php
    include_once('Model/mNV.php');
    class controlNV{
        function getAllNV(){
            $p = new modelNV();
            $tblNV = $p -> selectAllNV();
            if (!$tblNV) {
                return false;
            } else {
                if (mysql_num_rows($tblNV) > 0)
                {
                    return $tblNV;
                } else {
                    return 0;
                }
            }
        }

        function getAllLoaiNV(){
            $p = new modelNV();
            $tblLoaiNV = $p -> selectAllLoaiNV();
            if (!$tblLoaiNV) {
                return false;
            } else {
                if (mysql_num_rows($tblLoaiNV) > 0)
                {
                    return $tblLoaiNV;
                } else {
                    return 0;
                }
            }
        }

        function addNV($hotenNV, $ngaysinh, $email, $sdt, $password, $luong, $maloaiNV, $trangThaiHD){
            include_once('format.php');
            $p = new modelNV();
            $tbl = $p->selectAllNV_ForID();
            mysql_data_seek($tbl, mysql_num_rows($tbl)-1);
            $row = mysql_fetch_assoc($tbl);
            // print_r($row);
            $so = preg_replace("/[^0-9]/", "", $row['MaNhanVien']);
            $ma = $so+1;
            $identityVariable =  formatData('NV',$ma);
            $ins = $p -> insertNV($identityVariable, $hotenNV, $ngaysinh, $email, $sdt, $password, $luong, $maloaiNV, $trangThaiHD);
            if ($ins) {
                return 1;
            } else {
                return 0; //NVong the insert
            }
        }

        function deleNV($idNV){
            $p = new modelNV();
            $ins = $p -> deleteNV($idNV);
            if ($ins) {
                return 1;
            } else {
                return 0; //NVong the insert
            }
        }

        function updNV($ma, $hotenNV, $ngaysinh, $email, $sdt, $password, $luong, $maloaiNV, $trangThaiHD){
            $p = new modelNV();
            $ins = $p -> updateNV($ma, $hotenNV, $ngaysinh, $email, $sdt, $password, $luong, $maloaiNV, $trangThaiHD);
            if ($ins) {
                return 1;
            } else {
                return 0; //NVong the update
            }
        }

        function updMatkhauNv($id, $matkhau){
            $p = new modelNV();
            $ins = $p -> updateMatKhauNv($id, $matkhau);
            if ($ins) {
                return 1;
            } else {
                return 0; //Khong the update
            }
        }

        function getAllNVByName($name){
            $p = new modelNV();
            $tblProduct = $p -> selectAllNVByName($name);
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

        function getAllNVById($id){
            $p = new modelNV();
            $tblProduct = $p -> selectAllNVById($id);
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