<?php
    include_once("connect.php");

    class modelProduct{
        // lấy tất cả sản phẩm về
        function SelectAllProduct(){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);

            if($result){
                $query = "select * from sach";
                $tbl = mysql_query($query);

                $p -> CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        // sắp xếp sản phẩm theo id giảm dần, sau đó chọn 12(là $count) sản phẩm từ trên xuống bắt đầu từ limit
        function selectpage($limit,$count){
            $conn;
            $p = new connect();
            if($p->ConnectDB($conn)){
                $sql = "select * from sach where TrangThaiXoa = 0 order by MaSach desc limit $limit,$count";
                // $sql = "select * from sach order by MaSach desc limit 0,13";
                $tbl = mysql_query($sql);
                $p->CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        function selectSachByLoai($idLoai){
            $conn;
            $p = new connect();
            if($p->ConnectDB($conn)){
                $sql = "select * from sach where MaLoai like '$idLoai' and TrangThaiXoa = 0 order by MaSach DESC";
                $tbl = mysql_query($sql);
                $p->CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        function SelectAllProductBySearch($key){
            $conn;
            $p = new connect();
            $result = $p -> ConnectDB($conn);

            if($result){
                $query = "select * from sach where TieuDe like'%".$key."%' and TrangThaiXoa = 0";
                $tbl = mysql_query($query);

                $p -> CloseConnect($conn);
                return $tbl;
            }else{
                return false;
            }
        }

        
        

    //Không có viết ngoài này :)) 
    }
?>