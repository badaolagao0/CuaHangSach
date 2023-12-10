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
    include_once('Controller/cLS.php');
    // hàm làm sạch dữ liệu đầu vào
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    // Ràng buộc tên
    if (isset($_REQUEST['btnsubmit'])){
        $lsName = test_input($_POST["lsName"]);
        if (empty($_POST["lsName"])) {
            $nameErr = "Vui lòng điền tên loại sách ";
        } elseif (!preg_match('/^[a-zA-Z\sÀ-ỹ]+$/u',$lsName)){
            echo '<script>alert("Gồm chữ và không có ký tự đặc biệt! VD: Văn Học");</script>';
            $nameErr = "Gồm chữ và không có ký tự đặc biệt! VD: 'Văn Học'";
        } else {
            $chkName = true;
        }
        
        if ($chkName) {            
            $p = new controlLS();
            $result = $p -> addLS($lsName);
            if ($result==1) {
                echo "<script>alert('Thêm thành công')</script>"; 
                echo '<script>window.location = "admin.php?ls";</script>';
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
                <h2>QUẢN LÝ LOẠI SÁCH</h2>
            </legend>
            <div class="form-group row">
                <div class="col-md-4 control-label">
                    <button type="button" class="btn btn-secondary" onclick="quay_lai_trang_truoc()">Quay lại</button>
                </div>
                <div class="col-md-4">
                    <h2 class='form-title'>Thêm Loại Sách</h2>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">Tên Loại Sách</label>
                <div class="col-md-4">
                    <input id="lsName" name="lsName" placeholder="Nhập tên loại sách" class="form-control input-md"
                        type="text">
                </div>
                <div class="col-md-4">
                    <span class="error">* <?php echo $nameErr;?></span>
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