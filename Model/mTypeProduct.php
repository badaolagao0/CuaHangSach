<?php
    include_once("connect.php");
    class modelAllType{
        function SelectAllType(){
            $conn;
            $p = new connect();
            $tbl = $p -> ConnectDB($conn);

            if($tbl){
                $query = "select * from loaisach";
                $result = mysql_query($query);

                $p -> CloseConnect($conn);
                return $result;
            }else{
                return false;
            }
        }
    }
?>