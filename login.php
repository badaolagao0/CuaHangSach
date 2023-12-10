<?php
    session_start();
    $_SESSION['login'] = false;
?>
<meta charset="utf-8">
<html>
<style>
.bg {
    background-image: url('./image/login.png');
    width: 900px;
    height: 450px;
    background-origin: content-box;
    background-size: cover;
    margin-top: 70px;
}
</style>
<center>
    <div class="bg">
        <div class="form">
            <form action="#" method="post" align="left" style="margin-left:500px; padding-top:40px">
                <table>
                    <h2 style="margin-left:114px; color:#66CC00">SIGN IN</h2>
                    <tr>
                        <td></td>
                        <td><input type="text" name="Email" value="vanty01@gmail.com" placeholder="Email address"
                                style="width: 300px; padding-top:8px; padding-bottom:8px" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="password" value="0001" name="MatKhau" placeholder="Password"
                                style="width: 300px; margin-top:15px; padding-top:8px; padding-bottom:8px" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="checkbox" name="remember" style="margin-top:15px">Remember me &nbsp; <a
                                href="#" style="margin-left:60px">Forgot password</a></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" name="submit"
                                style="width: 300px; margin-top:15px; padding-top:8px; padding-bottom:8px; color:black; background-color:#00FF00;border:none">Sign
                                In</button></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-top:20px">Nếu bạn chưa có tài khoản hãy nhấn vào <a href="SignUp.php">Đăng
                                Ký</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</center>

</html>


<?php
include_once('Model/connect.php');

if (isset($_REQUEST['submit'])) {
    $con;
    $p = new connect();
    if ($p->ConnectDB($con)) {
        $username = $_POST["Email"];
        $password = sha1($_POST["MatKhau"]);
        // $password = $_POST["MatKhau"];

        $sql_nhanvien = "SELECT * FROM nhanvien WHERE Email='$username' AND MatKhau='$password'";
        $result_nhanvien = mysql_query($sql_nhanvien);

        $sql_khachhang = "SELECT * FROM khachhang WHERE Email='$username' AND MatKhau='$password'";
        $result_khachhang = mysql_query($sql_khachhang);

        $p->CloseConnect($con);

        if ($result_nhanvien && mysql_num_rows($result_nhanvien) > 0) {
            while ($row = mysql_fetch_assoc($result_nhanvien)) {
                $_SESSION['id'] = $row['MaNhanVien'];
                $_SESSION['ten'] = $row['HoTen'];
                $_SESSION['TrangThai'] = $row['TrangThaiHD'];
                $_SESSION['type'] = $row['MaLoaiNV'];
                $_SESSION['login'] = true;
                if ($_SESSION['type'] == 'LNV01') {
                    echo '<script>window.location = "admin.php";</script>';
                } else {
                    echo '<script>window.location = "nhanvien.php";</script>';
                }
            }
        } elseif ($result_khachhang && mysql_num_rows($result_khachhang) > 0) {
            while ($row = mysql_fetch_assoc($result_khachhang)) {
                $_SESSION['id'] = $row['MaKH'];
                $_SESSION['ten'] = $row['HoTen'];
                $_SESSION['type'] = 'khachhang';
                $_SESSION['login'] = true;
                echo '<script>window.location = "indexKh.php";</script>';
            }
        } else {
            header("location:login.php");
        }
    } else {
        echo '<script>alert("Kết nối thất bại");</script>';
    }
}
?>