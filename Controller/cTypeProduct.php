<?php
    include_once("Model/mTypeProduct.php");
    class controlAllType{
        function getAllType(){
            $p = new modelAllType();
            $tblComp = $p -> SelectAllType();
            return $tblComp;
        }
    }
?>