<?php
    include_once('./Controller/cModule.php');
    
    $p = new controlModule();

    if (isset($_REQUEST['id'])) {
        $kq = $p -> doiTrangThaiDonHang($_REQUEST['id']);

        if ($kq == 1) {
            echo "<script>alert('Xác nhận đơn hàng thành công')</script>";
            echo '<script>window.location = "admin.php?pagedondathang=1";</script>';
        }
        echo "<script>alert('Xác nhận đơn hàng thất bại')</script>";
    } else {
        echo "<script>alert('Thiếu id')</script>";
        echo '<script>window.location = "admin.php?tiepnhandonhang";</script>';
    }
    
?>