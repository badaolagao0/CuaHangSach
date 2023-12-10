<?php
include_once('./Controller/cModule.php');
$p = new controlModule();
$res = $p -> deleBinhLuan($_REQUEST['DelBL']);
if ($res) {
    echo "<script>alert('Xóa thất bại')</script>";
} else {
    echo "<script>alert('Xóa thành công')</script>";
}
echo '<script> window.location = "admin.php?bl"; </script>';

?>