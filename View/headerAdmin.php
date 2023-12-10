<!-- header -->
<?php
    session_start();
    $usName = $_SESSION['ten'];  
?>
<div class="header container-fluid">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-1 col-md-1 col-sm-3 col-3">
                <a href="indexKh.php" style="">
                    <img style="width:70%; min-width: 50px;" class="rounded-circle" src="./image/logo.png" alt="logo">
                </a>
            </div>
            <div class="col-lg-2 col-md-2 re-767 text-header">
                <a href="indexKh.php" class="">Trang chủ</a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                <form class="d-flex sua-tim-kiem">
                    <input class="form-control rounded-pill" type="search" style="width:100%" placeholder="Search"
                        aria-label="Search" style="width:500px">
                    <button class="btn btn-outline-success rounded-pill sua-tim" type="submit"><i class="fas fa-search"
                            class="icon-search"></i></button>
                </form>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                <div class="container-fluid px-0">
                    <div class="row flex-column">
                        <a href="" class="text-center">
                            <i class="fas fa-bell" style="font-size:24px"></i>
                        </a>
                        <a href="#" class="text-center text-header"
                            style="line-height: 19px; white-space: nowrap;">Thông báo</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                <div class="container-fluid px-0">
                    <div class="row flex-column">
                        <a href="" class="text-center">
                            <i class="fas fa-user text-center" style="font-size:24px"></i>
                        </a>
                        <a href="#" class="text-center text-header"
                            style="line-height: 19px; white-space: nowrap;"><?php echo $usName;?></a>
                        <!-- <a href="indexKh.php?dx" class="text-center text-header"
                            style="line-height: 19px; white-space: nowrap; text-decoration: underline">
                            Đăng xuất
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>