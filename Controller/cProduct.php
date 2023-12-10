<?php
    include_once("Model/mProduct.php");
    class controlProduct{
        function getAllProduct(){
            $p = new modelProduct();
            $tbl = $p -> SelectAllProduct();
            return $tbl;
        }

        function getAllProductByLoai($idLoai){
            $p = new modelProduct();
            $tbl = $p -> selectSachByLoai($idLoai);
            return $tbl;
        }

            // đếm tổng số sản phẩm để phân trang
        function countProduct(){
            $p = new modelProduct();
            $tbl = $p->SelectAllProduct();
            return mysql_num_rows($tbl);
        }
            
        function getProductPage($page,$count){
            $p = new modelProduct();
            $tbl = $p->selectpage(($page - 1)*$count,$count);
            return $tbl;
        }

        function getAllProductBySearch($key){
            $p = new modelProduct();
            $tbl = $p -> SelectAllProductBySearch($key);
            return $tbl;
        }

        function getAllTypeProduct(){
            $p = new modelProduct();
            $tbl = $p -> SelectAllTypeProduct();
            return $tbl;
        }

        

    //không có viết ngoài này :))) 
    }


?>