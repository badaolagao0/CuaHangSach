<?php
include_once('./Controller/cTG.php');
$p = new controlTG();
$res = $p -> deleTG($_REQUEST['DelTG']);
// print_r($_REQUEST['DelTG']);
if ($res) {
    echo "<script>alert('Xóa thành công')</script>";
}
echo '<script> window.location = "admin.php?tg"; </script>';
?>