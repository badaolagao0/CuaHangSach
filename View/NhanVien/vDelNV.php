<?php
include_once('./Controller/cNV.php');
$p = new controlNV();
$res = $p -> deleNV($_REQUEST['DelNV']);
if ($res) {
    echo "<script>alert('Xóa thành công')</script>";
} else {
    echo "<script>alert('Xóa thất bại')</script>";
}
echo '<script> window.location = "admin.php?nv"; </script>';

?>
