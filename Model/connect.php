<?php
    class connect{
        function ConnectDB(& $conn){
            $conn = mysql_connect("localhost", "peak", "123456");
            mysql_set_charset("utf8");
            if($conn){
                return mysql_select_db("cuahangsach");
            }else{
                return false;
            }
        }

        function CloseConnect($conn){
            mysql_close($conn);
        }
    }
?>