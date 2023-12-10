<?php
include_once('./Controller/cModule.php');
$p = new controlModule();
$res = $p -> deleBook($_REQUEST['DelBook']);
if ($res) {
    echo "<script>alert('Xóa thành công')</script>";
} else {
    echo "<script>alert('Xóa thất bại')</script>";
}
echo '<script> window.location = "admin.php?pagesach=1"; </script>';

?>