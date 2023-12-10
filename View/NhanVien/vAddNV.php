<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--    <link rel="stylesheet" href="css/stylekh.css">-->
</head>
<style>
.error {
    color: #FF0000;
}
</style>
<?php
include_once('Controller/cNV.php');
// hàm làm sạch dữ liệu đầu vào
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_REQUEST['btnsubmit'])) {
//    ten nhan vien
    $nvName = test_input($_POST["tennv"]);
    if (empty($_POST["tennv"])) {
        $nameErr = "Vui lòng điền tên nhân viên";
    } elseif (!preg_match('/[a-zA-Z0-9\s]*/', $nvName)) {
        $nameErr = "Gồm chữ và khoảng trắng! VD: 'Nguyen Van A'";
    } else {
        $chkName = true;
    }

//    ngay sinh
    $ngaysinh = test_input($_POST["ngaysinh"]);
    if (empty($_POST["ngaysinh"])) {
        $YearErr = "Vui lòng điền ngày sinh";
    } else {
        $chkYear = true;
    }

//    email
    $email = test_input($_POST["email"]);
    if (empty($_POST["email"])) {
        $emailErr = "Vui lòng điền email";
    } else {
        $chkEmail = true;
    }

//    sdt
    $sdt = test_input($_POST["sdt"]);
    if (empty($_POST["sdt"])) {
        $sdtErr = "Vui lòng điền số điện thoại";
    } else {
        $chkSdt = true;
    }

// //    mat khau
    $password = test_input($_POST["password"]);
    if (empty($_POST["password"])) {
        $passwordErr = "Vui lòng điền mật khẩu";
    } else {
        $chkPassword = true;
    }

//    luong
    $luong = test_input($_POST["luong"]);
    if (empty($_POST["luong"])) {
        $luongErr = "Vui lòng điền lương";
    } else {
        $chkLuong = true;
    }

    if ($chkName && $chkYear && $chkEmail && $chkSdt && $chkLuong && $password) {
        $p = new controlNV();
        $password = sha1($password);
        $result = $p->addNV($nvName, $ngaysinh, $email, $sdt, $password, $luong, $_POST['loainv'], $_POST['trangthai']);
        // $result = $p->addNV('nguyen van a', '2001-01-01', 'test@gmail.com', '0123456789', '123456', 1000000, 'LNV01', 1);
        if ($result == 1) {
            echo "<script>alert('Thêm thành công')</script>";
            echo '<script> window.location = "admin.php?nv"; </script>';
        } else {
            echo "<script>alert('Thêm thất bại')</script>";
        }
    } else {
        echo "<script>alert('Dữ liệu chưa hợp lệ')</script>";
    }

//    $birthDay = (string)$_POST('ngaysinh');
//    $birthDayFormat = DateTime::createFromFormat('d/m/Y', $birthDay)->format('Y-m-d');
//    echo $birthDayFormat;
}


?>

<body>
    <form class='form-group' action="#" method='post' enctype="multipart/form-data">
        <fieldset>
            <legend>
                <h2>QUẢN LÝ NHÂN VIÊN</h2>
            </legend>
            <div class="form-group row">
                <div class="col-md-4 control-label">
                    <button type="button" class="btn btn-secondary" onclick="quay_lai_trang_truoc()">Quay lại</button>
                </div>
                <div class="col-md-4">
                    <h2 class='form-title'>Thêm Nhân Viên</h2>
                </div>
            </div>

            <!--       Ho ten nhan vien -->
            <div class="form-group row">
                <label class="col-md-4 control-label">Họ tên <span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="text" name="tennv" class="form-control input-md" placeholder="Họ tên nhân viên">
                    <span class="error"><?php echo $nameErr; ?></span>
                </div>
            </div>

            <!--        Ngay sinh-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Ngày sinh <span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="date" name="ngaysinh" class="form-control input-md" placeholder="Ngày sinh">
                    <span class="error"><?php echo $YearErr; ?></span>
                </div>
            </div>

            <!--        Email-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Email <span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="email" name="email" class="form-control input-md" placeholder="Email">
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
            </div>

            <!--        Mat khau-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Mật khẩu <span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="password" name="password" class="form-control input-md" placeholder="Mật khẩu">
                    <span class="error"><?php echo $passwordErr; ?></span>
                </div>
            </div>

            <!--        So dien thoai-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Số điện thoại <span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="number" name="sdt" class="form-control input-md" placeholder="Số điện thoại">
                    <span class="error"><?php echo $sdtErr; ?></span>
                </div>
            </div>

            <!--        Luong-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Lương <span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="number" name="luong" class="form-control input-md" placeholder="Lương">
                    <span class="error"><?php echo $luongErr; ?></span>
                </div>
            </div>

            <!--        Loai nhan vien-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Loại nhân viên</label>
                <div class="col-md-4">
                    <select name="loainv" class="form-control input-md">
                        <?php
                    $p = new controlNV();
                    $tbl = $p->getAllLoaiNV();
                    while ($row = mysql_fetch_assoc($tbl)) {
                        echo "<option value='" . $row['MaLoaiNV'] . "'>" . $row['TenLoaiNV'] . "</option>";
                    }
                    ?>
                    </select>
                </div>
            </div>

            <!--        Trang thai hoat dong-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Trạng thái hoạt động</label>
                <div class="col-md-4">
                    <select name="trangthai" class="form-control input-md">
                        <option value="1">Đang làm việc</option>
                        <option value="0">Ngừng làm việc</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <input type="submit" name="btnsubmit" value="Thêm" class=' btn btn-success'>
                    <input type="reset" value="Nhập lại" class='btn btn-danger'>
                </div>
            </div>
        </fieldset>
    </form>
</body>
<script>
function quay_lai_trang_truoc() {
    history.back();
}
</script>

</html>