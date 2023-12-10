<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../CuaHangSach/css/styleNXB.css">
</head>
<style>
.error {
    color: #FF0000;
}
</style>
<?php
include_once('Controller/cTG.php');
// Hàm làm sạch dữ liệu đầu vào
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_REQUEST['btnsubmit'])) {
    // Ràng buộc tên 
    $HoTen = test_input($_POST["tgName"]);
    if (empty($_POST["tgName"])) {
        $nameErr = "Vui lòng điền tên tác giả ";
    } elseif (!preg_match('/^[a-zA-Z\sÀ-ỹ]+$/u', $HoTen)) { 
        echo '<script>alert("Gồm chữ và không có ký tự đặc biệt! VD: Xuân Hùng");</script>';
        $nameErr = "Gồm chữ và không có ký tự đặc biệt! VD: 'Xuân Hùng'";
    } else {
        $chkName = true;
    }
    // Ràng buộc ngày sinh
    $tgYear = test_input($_POST["tgYear"]);
    $date_parts = explode('-', $tgYear);

    if (empty($tgYear) || count($date_parts) !== 3 || !checkdate($date_parts[1], $date_parts[2], $date_parts[0]) || (int)$date_parts[0] >= 2010) {
        echo '<script>alert("Không đúng định dạng Y-m-d hoặc năm sinh phải lớn hơn 2010");</script>';
        $yearErr = "Vui lòng điền ngày sinh";
        $redirect = true;
    } else {
        $chkYear = true;
    }
    // Ràng buộc quốc tịch   
    $QuocTich = test_input($_POST["tgQuocTich"]);
    if (empty($QuocTich) || !preg_match('/^[a-zA-Z\sÀ-ỹ]+$/u', $QuocTich)) {
        $QuocTich = "Vui lòng điền quốc tịch ";
        echo '<script>alert("Quốc tịch không có số và ký tự đặc biệt!");</script>';
        $redirect = true;
    }

    // Ràng buộc nghệ danh
    $NgheDanh = test_input($_POST["tgNgheDanh"]);
    if (empty($NgheDanh)) {
        $NgheDanh = "Vui lòng điền nghệ danh ";
        echo '<script>alert("Vui lòng nhập nghệ danh");</script>';
        $redirect = true;
    }
    if ($chkName && $chkYear && !$redirect) {
        $p = new controlTG();
        $result = $p->addTG($HoTen, $tgYear, $QuocTich, $NgheDanh);
        if ($result == 1) {
            echo "<script>alert('Thêm thành công')</script>";
            echo '<script>window.location = "admin.php?tg";</script>';
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
                <h2>QUẢN LÝ TÁC GIẢ</h2>
            </legend>
            <div class="form-group row">
                <div class="col-md-4 control-label">
                    <button type="button" class="btn btn-secondary" onclick="quay_lai_trang_truoc()">Quay lại</button>
                </div>
                <div class="col-md-4">
                    <h2 class='form-title'>Thêm Tác Giả</h2>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">Tên Tác Giả:</label>
                <div class="col-md-4">
                    <input id="tgName" name="tgName" placeholder="Nhập tên tác giả" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $nameErr;?></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">Ngày Sinh:</label>
                <div class="col-md-4">
                    <input id="tgYear" name="tgYear" placeholder="Nhập ngày sinh" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $yearErr;?></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">Quốc Tịch:</label>
                <div class="col-md-4">
                    <input id="tgQuocTich" name="tgQuocTich" placeholder="Nhập quốc tịch" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $QuocTich;?></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 control-label">Nghệ Danh:</label>
                <div class="col-md-4">
                    <input id="tgNgheDanh" name="tgNgheDanh" placeholder="Nhập nghệ danh" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $NgheDanh;?></span>
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