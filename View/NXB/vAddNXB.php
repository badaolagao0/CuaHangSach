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
    include_once('Controller/cNXB.php');
    // hàm làm sạch dữ liệu đầu vào
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    if (isset($_REQUEST['btnsubmit'])){
        $nxbName = test_input($_POST["nxbName"]);
        if (empty($_POST["nxbName"])) {
            $nameErr = "Vui lòng điền tên nhà xuất bản ";
        } elseif (!preg_match('/[a-zA-Z0-9\s]*/',$nxbName)){
            $nameErr = "Gồm chữ và khoảng trắng! VD: 'Kim đồng'";
        } else {
            $chkName = true;
        }
        
        $Year = test_input($_POST["nxbYear"]);
        $getYear = date("Y");
        $yInput = (int)$Year;
        $currentYear = (int)$getYear;
        if (empty($_POST["nxbYear"])) {
            $YearErr = "Vui lòng điền năm thành lập";
        } elseif (!preg_match("/^[0-9-' ]*$/",$Year) || ($yInput < 1500) || ($yInput > $currentYear)){
            $YearErr = "Gồm các số 0-9 và tối thiểu là từ năm 1500 đến năm hiện tại!";
        } else {
            $chkYear = true;
        }

        $nxbAddress = test_input($_POST["nxbAddress"]);
        if (empty($_POST["nxbAddress"])) {
            $AddressErr = "Vui lòng điền địa chỉ";
        } elseif (!preg_match('/[a-zA-Z0-9\s\/\.\,]*/',$Address)) {
            $AddressErr = "Địa chỉ không hợp lệ!/";
        } else {
            $chkAddress = true;
        }

        if ($chkName && $chkAddress && $chkYear) {            
            $p = new controlNXB();
            $result = $p -> addNXB($nxbName, $nxbAddress, $yInput);
            if ($result==1) {
                echo "<script>alert('Thêm thành công')</script>"; 
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
                <h2>QUẢN LÝ NHÀ XUẤT BẢN</h2>
            </legend>
            <div class="form-group row">
                <div class="col-md-4 control-label">
                    <button type="button" class="btn btn-secondary" onclick="quay_lai_trang_truoc()">Quay lại</button>
                </div>
                <div class="col-md-4">
                    <h2 class='form-title'>Thêm Nhà Xuất Bản</h2>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">Tên Nhà Xuất Bản</label>
                <div class="col-md-4">
                    <input id="nxbName" name="nxbName" placeholder="Nhập tên nhà xuất bản" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $nameErr;?></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">Năm thành lập</label>
                <div class="col-md-4">
                    <input id="nxbYear" name="nxbYear" placeholder="Nhập năm thành lập" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $YearErr;?></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">Địa chỉ:</label>
                <div class="col-md-4">
                    <input id="nxbAddress" name="nxbAddress" placeholder="Nhập địa chỉ" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $AddressErr;?></span>
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