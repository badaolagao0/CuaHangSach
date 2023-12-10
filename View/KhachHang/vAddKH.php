<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
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
include_once('Controller/cKH.php');
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
        $nameErr = "Vui lòng điền tên khách hàng";
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
        $emailErr = "Vui lòng điền email";
    }

//    sdt
    $sdt = test_input($_POST["sdt"]);
    if (empty($_POST["sdt"])) {
        $sdtErr = "Vui lòng điền số điện thoại";
    }

//    diem tich luy
    $diemtl = test_input($_POST["diemtl"]);
    if (empty($_POST["diemtl"])) {
        $diemtlErr = "Vui lòng điền điểm tích lũy";
    }

//    loai khach hang
    $loaikh = test_input($_POST["loaikh"]);
    if (empty($_POST["loaikh"])) {
        $loaiErr = "Vui lòng điền loại khách hàng";
    }

//    mat khau
    $password = test_input($_POST["password"]);
    if (empty($_POST["password"])) {
        $passwordErr = "Vui lòng điền mật khẩu";
    }

//    echo $khName . " " . $ngaysinh . " " . $email . " " . $sdt . " " . $diemtl . " " . $loaikh . " " . $password;
//    die();


    if ($khName && $ngaysinh && $email && $sdt && $diemtl && $loaikh && $password) {
        $p = new controlkh();
        $password = sha1($password);
        $result = $p->addKH($khName, $ngaysinh, $email, $sdt, $diemtl, $loaikh, $password);
//        $result = $p->addkh("nguyen van a", "1999-01-01", "test@gmail.com", "0123456789", "0", "LKH01", "123456");
        if ($result == 1) {
            echo "<script>alert('Thêm thành công')</script>";
            echo '<script> window.location = "admin.php?kh"; </script>';
        } else {
            echo "<script>alert('Thêm thất bại')</script>";
        }
    } else {
        echo "<script>alert('Dữ liệu chưa hợp lệ')</script>";
    }
}
?>

<body>
    <form class='form-group' action="#" method='post' enctype="multipart/form-data">
        <fieldset>
            <legend>
                <h2>QUẢN LÝ KHÁCH HÀNG</h2>
            </legend>
            <div class="form-group row">
                <div class="col-md-4 control-label">
                    <button type="button" class="btn btn-secondary" onclick="quay_lai_trang_truoc()">Quay lại</button>
                </div>
                <div class="col-md-4">
                    <h2 class='form-title'>Thêm Khách Hàng</h2>
                </div>
            </div>

            <!--            ten khach hang-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Tên Khách Hàng</label>
                <div class="col-md-4">
                    <input id="tenkh" name="tenkh" placeholder="Nhập tên khách hàng" class="form-control input-md"
                        type="text">
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
                        type="date">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $YearErr; ?></span>
                </div>
            </div>

            <!--            email-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" placeholder="Nhập email" class="form-control input-md" type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $emailErr; ?></span>
                </div>
            </div>

            <!--            sdt-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Số điện thoại</label>
                <div class="col-md-4">
                    <input id="sdt" name="sdt" placeholder="Nhập số điện thoại" class="form-control input-md"
                        type="number">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $sdtErr; ?></span>
                </div>
            </div>
            <!--            diem tich luy-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Điểm tích lũy</label>
                <div class="col-md-4">
                    <input id="diemtl" name="diemtl" placeholder="Nhập điểm tích lũy" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $diemtlErr; ?></span>
                </div>
            </div>
            <!--            loai khach hang-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Loại khách hàng</label>
                <div class="col-md-4">
                    <!-- <input id="loaikh" name="loaikh" placeholder="Nhập loại khách hàng" class="form-control input-md"
                       type="text"> -->
                    <select name="loaikh" class="form-control input-md">
                        <?php
                    $p = new controlKH();
                    $tbl = $p->getAllLoaiKH();
                    while ($row = mysql_fetch_assoc($tbl)) {
                        echo "<option value='" . $row['MaLoaiKH'] . "'>" . $row['TenLoaiKH'] . "</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $loaiErr; ?></span>
                </div>
            </div>
            <!--            mat khau-->
            <div class="form-group row">
                <label class="col-md-4 control-label">Mật khẩu</label>
                <div class="col-md-4">
                    <input id="password" name="password" placeholder="Nhập mật khẩu" class="form-control input-md"
                        type="password">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $passwordErr; ?></span>
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