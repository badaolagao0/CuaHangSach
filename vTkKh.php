<?php
    session_start();
    $ma = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn đặt hàng</title>
    <link rel="stylesheet" href="../CuaHangSach/css/responAdmin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
.link-sidebar {
    text-decoration: none;
    color: #fff;
    margin-left: 1rem;
    transition: 0.2s linear;
}

.link-sidebar:hover {
    color: #3bba9c;
}

.content-menu {
    /* background-color: #ccc; */
}

.link-nav {
    font-weight: 400;
    color: #000;
}

.box {
    border: 1px solid #000;
    margin-top: 1rem;
}

.box-children {
    display: flex;
    margin-top: 1rem;
}

.adj-box-children {
    justify-content: space-between;
    margin: 0 1rem 0 1rem;
}

.adj-box-children p {
    margin: 10px 0 8px 0;
}

.form-group {
    margin-bottom: 15px;
}
</style>

<body>
    <?php 
    include_once("View/headerTkKh.php");
    if (isset($_REQUEST['dx'])){
        session_destroy();
    }
    ?>

    <div class="menu-toggle">
        <div class="hamburger">
            <span></span>
        </div>
    </div>
    <div class="app">
        <aside class="sidebar" style='margin: 0;'>
            <nav class="menu" id="menu">
                <!-- <div class="pd-t menu-item">
                    <i class="fa fa-heart" style='color: #fff' aria-hidden="true"></i>
                    <a href="#" class="link-sidebar">Hồ sơ</a>
                </div> -->
                <div class="pd-t menu-item">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <a href="vTkKh.php?tk=<?php echo $ma;?>" class="link-sidebar">Tài khoản của tôi</a>
                </div>
                <div class="pd-t menu-item">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <a href="vTkKh.php?kh=<?php echo $ma;?>" class="link-sidebar">Đơn mua</a>
                </div>
                <div class="pd-t menu-item">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                    <a href="vTkKh.php?mkkh=<?php echo $ma;?>" class="link-sidebar">Đổi mật khẩu</a>
                </div>
                <div class="pd-t menu-item">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <a href="indexKh.php?dx" class="link-sidebar">Đăng xuất</a>
                </div>
            </nav>
        </aside>

        <main class="content">
            <!-- <h1 style='text-align: center;'>Đơn mua</h1> -->
            <?php 
                    if (isset($_REQUEST['kh'])) {
                        include_once('View/Module/VDonDatHangTuan.php');
                        $p = new viewDonDatHang();
                        $p -> viewAllDonDatHangByKh($_REQUEST['kh']); 
                    } elseif(isset($_REQUEST['huyDon'])){
                        include_once('Controller/cModule.php');
                        $p = new controlModule();
                        if ($p -> huyDonDatHang($_REQUEST['huyDon'])) {
                            echo '<script>alert("Hủy đơn hàng thành công!")</script>';
                        } else {
                            echo '<script>alert("Hủy đơn hàng thất bại!")</script>';
                        }
                        echo '<script> window.location = "vTkKh.php?kh='.$ma.'"; </script>';
                    } elseif(isset($_REQUEST['tk'])){
                        include_once('View/Module/vTaiKhoanKh.php');
                    } elseif(isset($_REQUEST['mkkh'])){
                        include_once('View/Module/vDoiMatKhau.php');
                    }
                ?>
        </main>
    </div>


    <?php include_once("View/footer.php"); ?>
    <script>
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</body>

</html>