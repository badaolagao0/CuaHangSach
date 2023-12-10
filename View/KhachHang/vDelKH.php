<?php
include_once('./Controller/cKH.php');
$p = new controlKH();
$res = $p -> deleKH($_REQUEST['DelKH']);
if ($res) {
    echo "<script>alert('Xóa thành công')</script>";
} else {
    echo "<script>alert('Xóa thất bại')</script>";
}
echo '<script> window.location = "admin.php?kh"; </script>';

?>
