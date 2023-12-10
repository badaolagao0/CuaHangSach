<?php
    include_once('Controller/cNV.php');
    // lấy giá trị cũ
    $p = new controlNV();
    $tblKH = $p->getAllNVByID($_REQUEST["mknv"]);
    while ($row = mysql_fetch_assoc($tblKH)) {
        $password = $row['MatKhau'];
    }
    if (isset($_REQUEST['btnsubmitNv'])){
        if (empty($_POST["oldPassword"])) {
            $passwordErrOld = "Vui lòng điền mật khẩu";
        }elseif (sha1($_POST["oldPassword"]) != $password){
            $passwordErrOld = "Sai mật khẩu";
        } elseif (empty($_POST["newPassword"])){
            $passwordErrNew = "Vui lòng điền mật khẩu";
        }  elseif (strlen($_POST["newPassword"]) < 8) {
            $passwordErrNew = "Mật khẩu phải có ít nhất 8 ký tự";
        } elseif ($_POST["newPasswordAgain"] != $_POST["newPassword"]){
            $passwordErrAgain = "Mật khẩu không khớp";
        } else {
            $matkhau = sha1($_POST["newPasswordAgain"]);
            $result = $p -> updMatkhauNv($_REQUEST["mknv"], $matkhau);
            if ($result) {
                echo '<script>alert("Đổi mật khẩu thành công !")</script>;';
            } else {
                echo '<script>alert("Đổi mật khẩu thất bại !")</script>;';
            }
        }
    }
        
?>

<form class='form-group' action="#" method='post' enctype="multipart/form-data" style="padding-top:15px;">
    <h1 style='text-align: center;'>Đổi mật khẩu</h1>
    <!--            password-->
    <div class="form-group row">
        <label class="col-md-4 control-label">Mật khẩu hiện tại: </label>
        <div class="col-md-4">
            <input id="password" name="oldPassword" placeholder="Nhập mật khẩu hiện tại" class="form-control input-md"
                type="password">
        </div>
        <div class="col-md-4">
            <span class="error">* <?php echo $passwordErrOld; ?></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 control-label">Mật khẩu mới:</label>
        <div class="col-md-4">
            <input id="password" name="newPassword" placeholder="Nhập mật khẩu mới" class="form-control input-md"
                type="password">
        </div>
        <div class="col-md-4">
            <span class="error">* <?php echo $passwordErrNew; ?></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 control-label">Nhập lại mật khẩu:</label>
        <div class="col-md-4">
            <input id="password" name="newPasswordAgain" placeholder="Nhập lại mật khẩu mới"
                class="form-control input-md" type="password">
        </div>
        <div class="col-md-4">
            <span class="error">* <?php echo $passwordErrAgain; ?></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
            <input type="submit" name="btnsubmitNv" value="Lưu" class=' btn btn-success'>
            <input type="reset" value="Nhập lại" class='btn btn-danger'>
        </div>
    </div>
</form>