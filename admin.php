<?php
    session_start();
    $idNhanVien = $_SESSION['id'];
    $_SESSION['TaiKhoan'] = false;
    if (!$_SESSION['login'] || $_SESSION['type'] != 'LNV01'){
            echo '<script>alert("Bạn không được phép truy cập")</script>';
            echo '<script>window.location = "index.php";</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>Admin</title>
    <link rel="stylesheet" href="../CuaHangSach/css/responAdmin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/popupDonDatHang.css">
</head>

<style>
.btn-adj {
    border: 2px solid #ccc;
    color: #000;
}

.btn-adj:hover {
    /* background-color: #cccccc47; */
    opacity: 0.8;
    color: #000;
}

.btn-search {
    margin-left: -3px;
    WIDTH: 28px;
    height: 28px;
    border: none;
    background-color: #ccc;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
    color: #00000073;
    border: 1px solid;
    border-left: 0;
}

.btn-search:hover {
    color: #00000096;
}

.form-group {
    margin-bottom: 15px;
}
</style>
<?php
    $chkSearch = false;
?>

<body>
    <?php include_once("View/headerAdmin.php"); ?>
    <div class="menu-toggle">
        <div class="hamburger">
            <span></span>
        </div>
    </div>

    <div class="app">
        <aside class="sidebar" style='margin: 0;'>
            <h2>Menu</h2>
            <nav class="menu" id="menu">
                <a href="admin.php?UpdNVSelf=<?php echo $idNhanVien;?>" class="menu-item pd-t">Tài khoản của tôi</a>
                <a href="admin.php?mknv=<?php echo $idNhanVien;?>" class="menu-item pd-t">Đổi mật khẩu</a>
                <a href="admin.php?pagesach=1" class="menu-item pd-t">Sách</a>
                <a href="admin.php?ls" class="menu-item pd-t">Loại Sách</a>
                <a href="admin.php?pagenxb=1" class="menu-item pd-t">Nhà Xuất
                    Bản</a>
                <a href="admin.php?tg" class="menu-item pd-t">Tác giả</a>
                <a href="admin.php?kh" class="menu-item pd-t">Khách Hàng</a>
                <a href="admin.php?nv" class="menu-item pd-t">Nhân Viên</a>
                <a href="admin.php?kho" class="menu-item pd-t">Kho Sách</a>
                <a href="admin.php?pagedondathang=1" class="menu-item pd-t">Đơn dặt hàng</a>
                <a href="admin.php?pagebinhluan=1" class="menu-item pd-t">Bình luận</a>
                <a href="admin.php?thongkedoanhthu" class="menu-item pd-t">Thống kê doanh thu</a>
                <a href="indexKh.php?dx" class="menu-item pd-t">Đăng xuất</a>
            </nav>

        </aside>

        <main class="content">
            </form>
            <?php
                    if (isset($_REQUEST['rAddNXB'])) { // Thêm NXB
                        include_once('View/NXB/vAddNXB.php');
                    }elseif (isset($_REQUEST['rAddSach'])) { // Thêm sách
                        include_once('View/Module/vAddSach.php');
                    }elseif (isset($_REQUEST['DelNXB'])) { // Xóa NXB
                        include_once('View/NXB/vDelNXB.php');
                    }elseif (isset($_REQUEST['DelBook'])) { // xóa sách
                        include_once('View/Module/vDelSach.php');
                    }elseif (isset($_REQUEST['DelBL'])) { // Xóa bình luận
                        include_once('View/Module/vDelBL.php');
                    }elseif (isset($_REQUEST['UpdNXB']) ) { // cập nhật NXB
                        include_once('View/NXB/vUpdNXB.php');
                    }elseif (isset($_REQUEST['UpdBook']) ) { // cập nhật Sách
                        include_once('View/Module/vUpdSach.php');
                    }elseif (isset($_REQUEST['pagenxb'])){ // view nxb
                        include_once('View/NXB/vNXB.php');  
                    }elseif (isset($_REQUEST['pagebinhluan'])){ // view bình luận
                        include_once('View/Module/vBinhLuan.php');  
                    }elseif (isset($_REQUEST['kh'])){ // view Khách hàng
                        include_once('View/KhachHang/vKH.php');  
                        $p = new viewKH();
                        $p -> viewAllKH();
                    } elseif (isset($_REQUEST['rAddKH'])) { // Thêm kh
                        include_once('View/KhachHang/vAddKH.php');
                    } elseif (isset($_REQUEST['UpdKH'])) { // cập nhật kh
                        include_once('View/KhachHang/vUpdKH.php');
                    } elseif (isset($_REQUEST['DelKH'])) { // Xóa kh
                        include_once('View/KhachHang/vDelKH.php');
                    }elseif (isset($_REQUEST['pagedondathang'])){ // view đơn đặt hàng
                        include_once('View/Module/vDonDatHang.php');  
                    }elseif (isset($_REQUEST['pagesach'])){ // view sách
                        include_once('View/Module/vSach.php');  
                    }elseif (isset($_REQUEST['searchNameLS'])) { // Tìm LS
                        include_once('View/LS/vLS.php');
                        $p = new viewLS();
                        $chkSearchLS = true;
                        $p -> viewLSByName($_REQUEST['searchNameLS']);
                    }elseif (isset($_REQUEST['rAddLS'])) { // Thêm LS
                        include_once('View/LS/vAddLS.php');
                    }elseif (isset($_REQUEST['DelLS'])) { // Xóa LS
                        include_once('View/LS/vDelLS.php');
                    }elseif (isset($_REQUEST['UpdLS']) ) { // cập nhật LS
                        include_once('View/LS/vUpdLS.php');
                    } elseif (isset($_REQUEST['ls'])){ // view ls
                        include_once('View/LS/vLS.php');  
                        $p = new viewLS();
                        $p -> viewAllLS();
                    }elseif (isset($_REQUEST['searchNameTG'])) { // Tìm TG
                        include_once('View/TG/vTG.php');
                        $p = new viewTG();
                        $chkSearchLS = true;
                        $p -> viewTGByName($_REQUEST['searchNameTG']);
                    }elseif (isset($_REQUEST['tg'])){ // view tg
                        include_once('View/TG/vTG.php');  
                        $p = new viewTG();
                        $p -> viewAllTG();
                    }elseif (isset($_REQUEST['DelTG'])) { // xóa tác giả
                        include_once('View/TG/vDelTG.php');
                    }elseif (isset($_REQUEST['UpdTG']) ) { // cập nhật tác giả
                        include_once('View/TG/vUpdTG.php');
                    }elseif (isset($_REQUEST['rAddTG'])) { // Thêm tg
                        include_once('View/TG/vAddTG.php');
                    }elseif (isset($_REQUEST['nv'])){ //view nhân viên
                        include_once('View/Module/vNhanVien.php');  
                        $p = new viewNV();
                        $p -> viewAllNV();
                    } elseif (isset($_REQUEST['rAddNV'])) { // Thêm nhân viên
                        include_once('View/NhanVien/vAddNV.php');
                    } elseif (isset($_REQUEST['UpdNV'])) { // cập nhật nhân viên
                        include_once('View/NhanVien/vUpdNV.php');
                    } elseif (isset($_REQUEST['UpdNVSelf'])) { // cập nhật nhân viên Self
                        $_SESSION['TaiKhoan'] = true;
                        include_once('View/NhanVien/vUpdNV.php');
                    } elseif (isset($_REQUEST['DelNV'])) { // Xóa nhân viên
                        include_once('View/NhanVien/vDelNV.php');
                    }elseif (isset($_REQUEST['kho'])){ // view kho sách
                        include_once('View/Module/vKhoSach.php');  
                        $p = new viewKho();
                        $p -> viewAllKho();
                    } elseif (isset($_REQUEST['doitrangthaidonhang'])) { // view Đổi trạng thái đơn hàng
                        include_once('View/Module/vDoiTrangThaiDonHang.php');
                    } elseif (isset($_REQUEST['thongkedoanhthu'])) { // view Thống kê doanh thu
                        include_once('View/Module/vThongKeDoanhThu.php');
                        $p = new viewThongKeDoanhThu();
                        $startDT = isset($_POST['startDT']) ? $_POST['startDT'] : null;
                        $endDT = isset($_POST['endDT']) ? $_POST['endDT'] : null;
                        $startS = isset($_POST['startS']) ? $_POST['startS'] : null;
                        $endS = isset($_POST['endS']) ? $_POST['endS'] : null;
                        $p->viewAllThongKeDoanhThu($startDT, $endDT, $startS, $endS);
                    }elseif(isset($_REQUEST['tk'])){
                        include_once('View/Module/vTaiKhoanKh.php');
                    }elseif(isset($_REQUEST['mknv'])){
                        include_once('View/Module/vDoiMatKhauNhanVien.php');
                    }else {
                        echo "<h1>TRANG DÀNH CHO ADMIN</h1>";
                    }
                    ?>
        </main>
    </div>

    <script>
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    });
    </script>
    <?php include_once("View/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- <script src="./js/popupDonDatHang.js"></script> -->
    <script src='./js/popup.js'></script>


</body>

</html>