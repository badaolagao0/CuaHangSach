<?php
include_once('./Controller/cLS.php');
$p = new controlLS();
$res = $p -> deleLS($_REQUEST['DelLS']);
// print_r('LS: '.$_REQUEST['DelLS']);
if ($res) {
    echo "<script>alert('Xóa thành công')</script>";
} else {
    echo "<script>alert('Xóa thất bại, còn sách thuộc LS này!')</script>";
}
echo '<script> window.location = "admin.php?ls"; </script>';
?>