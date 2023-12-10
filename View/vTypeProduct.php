<?php
    session_start();
    include_once("Controller/cTypeProduct.php");
    $p = new controlAllType();
    $tblComp = $p -> getAllType();
    if (!$_SESSION['login']){
        $temp = 'index.php';
    } else {
        $temp = 'indexKh.php';
    }
    if(!$tblComp){
        echo "Error!";
    }elseif(mysql_num_rows($tblComp) == 0){
        echo "0 result!";
    }else{
        echo "<div class='sub-menu'>";
        while($row = mysql_fetch_assoc($tblComp)){
            echo "<a href='".$temp."?loaisach=".$row['MaLoai']."' class='sub-item'>".$row["TenLoai"]."</a>";
        }
        echo "</div>";

    }
?>