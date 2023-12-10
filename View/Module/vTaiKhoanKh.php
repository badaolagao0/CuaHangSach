<?php
include_once('Controller/cKH.php');
// lấy giá trị cũ
$p = new controlKH();
$tblKH = $p->getAllKHByID($_REQUEST["tk"]);
$makh = $_REQUEST["yk"];
while ($row = mysql_fetch_assoc($tblKH)) {
    $pName = $row['HoTen'];
    $pYear = $row['NgaySinh'];
    $Email = $row['Email'];
    $sdt = $row['SoDienThoai'];
    $diemtl = $row['DiemTichLuy'];
    $loaikh = $row['MaLoaiKH'];
    $password = $row['MatKhau'];
}

// hàm làm sạch dữ liệu đầu vào
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_REQUEST['btnsubmit'])) {
//    ten khach hang
    $khName = test_input($_POST["tenkh"]);
    if (empty($_POST["tenkh"])) {
        $nameErr = "Vui lòng điền tên khách hàng ";
    } elseif (!preg_match('/[a-zA-Z0-9\s]*/', $khName)) {
        $nameErr = "Gồm chữ và khoảng trắng! VD: 'Nguyen Van A'";
    } else {
        $chkName = true;
    }

//    ngay sinh
    $ngaysinh = test_input($_POST["ngaysinh"]);
    if (empty($_POST["ngaysinh"])) {
        $YearErr = "Vui lòng điền ngày sinh";
    }

//    email
    $email = test_input($_POST["email"]);
    if (empty($_POST["email"])) {
        $EmailErr = "Vui lòng điền email";
    }

//    sdt
    $sdt = test_input($_POST["sdt"]);
    if (empty($_POST["sdt"])) {
        $sdtErr = "Vui lòng điền số điện thoại";
    }


//    mat khau
    // $password = test_input($_POST["password"]);
    // if (empty($_POST["password"])) {
    //     $passwordErr = "Vui lòng điền mật khẩu";
    // }

    if ($khName && $ngaysinh && $email && $sdt && $diemtl && $loaikh) {
        $p = new controlKH();
        $result = $p->updKH($_REQUEST["kh"], $khName, $ngaysinh, $email, $sdt, $diemtl, $loaikh);
        if ($result == 1) {
            $_SESSION['ten'] = $khName;
            echo "<script>alert('Cập nhật tài khoản thành công')</script>";
            echo '<script> window.location = "vTkKh.php?kh='.$_REQUEST["kh"].'"; </script>';
        } else {
            echo "<script>alert('Cập nhật tài khoản thất bại')</script>";
            echo '<script> window.location = "vTkKh.php?kh='.$_REQUEST["kh"].'"; </script>';
        }
    } else {
        echo "<script>alert('Dữ liệu cập nhật chưa hợp lệ')</script>";
        echo '<script> window.location = "vTkKh.php?kh='.$_REQUEST["kh"].'"; </script>';
    }
}
?>

<div style="border: 1px solid #ccc; padding: 10px;" class="pd-t menu-item">
    <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
    <!-- <a style="color: #000;" href="#" class="link-sidebar">Tài khoản của tôi</a> -->
    <h1 style='text-align: center;'>Tài khoản của tôi</h1>

    <form class='form-group' action="#" method='post' enctype="multipart/form-data" style="padding-top:15px;">
        <fieldset style='margin-left: 10px; margin-bottom: 10px;'>
            <!--            ten khach hang-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Tên Khách Hàng</label>
                <div class="col-md-4">
                    <input id="tenkh" name="tenkh" placeholder="Nhập tên khách hàng" class="form-control input-md"
                        type="text" value="<?php echo $pName; ?>">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $nameErr; ?></span>
                </div>
            </div>

            <!--            ngày sinh-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Ngày sinh</label>
                <div class="col-md-4">
                    <input id="ngaysinh" name="ngaysinh" placeholder="Nhập ngày sinh" class="form-control input-md"
                        type="text" value="<?php echo $pYear; ?>">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $YearErr; ?></span>
                </div>
            </div>

            <!--            email-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" placeholder="Nhập email" class="form-control input-md" type="text"
                        value="<?php echo $Email; ?>">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $EmailErr; ?></span>
                </div>
            </div>

            <!--            sdt-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Số điện thoại</label>
                <div class="col-md-4">
                    <input id="sdt" name="sdt" placeholder="Nhập số điện thoại" class="form-control input-md"
                        type="text" value="<?php echo $sdt; ?>">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $sdtErr; ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <input type="submit" name="btnsubmit" value="Lưu" class=' btn btn-success'>
                    <input type="reset" value="Nhập lại" class='btn btn-danger'>
                </div>
            </div>
        </fieldset>
    </form>
</div>