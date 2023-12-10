<?php
session_start();
$_SESSION['signup'] = false;

include_once('Model/connect.php');
include_once('Controller/format.php');

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {
    $con = new connect();
    $conn = null;

    if ($con->ConnectDB($conn)) {
        $HoTen = test_input($_POST["HoTen"]);
        $NgaySinh = test_input($_POST["NgaySinh"]);
        $Email = test_input($_POST["Email"]);
        $MatKhau = test_input($_POST["MatKhau"]);
        $SoDienThoai = test_input($_POST["SoDienThoai"]);

        //---------------------------------------------------------------------------------------------------
        $redirect = false;
        $chkName = false;
        $nameErr = "";
        // Ràng buộc tên
        if (empty($HoTen)) {
            $nameErr = "Vui lòng nhập tên";
        } if (!preg_match('/^[a-zA-Z\sÀ-ỹ]+$/u', $HoTen)) {
            echo '<script>alert("Chỉ được nhập chữ và không có ký tự đặc biệt!");</script>';
            $nameErr = "Chỉ được nhập chữ và không có ký tự đặc biệt!";
        } else {
            $chkName = true;
        }
        // Ràng buộc ngày sinh
        $currentYear = date("Y");
        $maxYear = $currentYear - 2015;
        list($day, $month, $year) = explode('/', $NgaySinh);
        if (empty($NgaySinh) || !checkdate($year, $month, $day) || $year >= 2015) {
            echo '<script>alert("Không hợp lệ (y/m/d - năm lớn hơn 2015)");</script>';
            $redirect = true;
        }
        // Ràng buộc email
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $Email)) {
            echo '<script>alert("Vui lòng nhập email hợp lệ (@gmail.com)");</script>';
            $redirect = true;
        }

        // Ràng buộc mật khẩu
        if (strlen($MatKhau) < 8) {
            echo '<script>alert("Mật khẩu phải có ít nhất 8 ký tự");</script>';
            $redirect = true;
        }

        // Ràng buộc số điện thoại
        if (empty($SoDienThoai) || !preg_match('/^\d{10}$/', $SoDienThoai)) {
            echo '<script>alert("Vui lòng nhập số điện thoại hợp lệ (10 chữ số)");</script>';
            $redirect = true;
        }

        //-----------------------------------------------------------------------------------------------
        if ($chkName && !$redirect) {
            $sql_check_exist = mysql_query("SELECT * FROM khachhang WHERE Email='$Email'", $conn);
            $string = 'select * from khachhang';
            $tbl = mysql_query($string, $conn);
            mysql_data_seek($tbl, mysql_num_rows($tbl) - 1);
            $row = mysql_fetch_assoc($tbl);
            $so = preg_replace("/[^0-9]/", "", $row['MaKH']);
            $ma = $so + 1;
            $identityVariable = formatData('KH', $ma);
            $MatKhau = sha1($MatKhau);

            if (mysql_num_rows($sql_check_exist) > 0) {
                echo '<script>alert("Email đã tồn tại. Vui lòng chọn một email khác.");</script>';
            } else {    
                $sql_insert = "INSERT INTO khachhang (MaKH, DiemTichLuy, MaLoaiKH, HoTen, NgaySinh, Email, MatKhau, SoDienThoai) VALUES ('$identityVariable', '0', 'LKH02', '$HoTen', '$NgaySinh', '$Email', '$MatKhau', '$SoDienThoai')";

                if (mysql_query($sql_insert, $conn)) {
                    $last_id = mysql_insert_id($conn);
                    echo '<script>alert("Đăng ký thành công");</script>';
                    echo '<script>window.location = "login.php";</script>';
                } else {
                    echo '<script>alert("Đăng ký thất bại: ' . mysql_error($conn) . '");</script>';
                }
            }
        }
        $con->CloseConnect($conn);
    } else {
        echo '<script>alert("Kết nối thất bại");</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <style>
    .bg {
        background-image: url('./image/login.png');
        width: 900px;
        height: 550px;
        background-origin: content-box;
        background-size: cover;
        margin-top: 70px;
    }

    .form {
        padding-top: 40px;
        margin-left: 500px;
        color: black;
    }

    .form table {
        margin-left: 114px;
    }

    .form input {
        width: 300px;
        padding: 8px;
        margin-top: 10px;
    }

    .form button {
        width: 300px;
        margin-top: 15px;
        padding: 8px;
        color: black;
        background-color: #00FF00;
        border: none;
    }

    .form td {
        padding-top: 10px;
        vertical-align: middle;
    }

    h2 {
        color: #66CC00;
        padding-top: 40px;
        margin-left: 140px;
    }
    </style>
</head>

<body>

    <center>
        <div class="bg">
            <div class="form">
                <form action="SignUp.php" method="post">
                    <table>
                        <h2>SIGN UP</h2>

                        <tr>
                            <td><input type="text" name="HoTen" placeholder="Full Name" required></td>
                        </tr>
                        <tr>
                            <td><input type="email" name="Email" placeholder="Email address" required></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="MatKhau" placeholder="Password" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="NgaySinh" placeholder="Date of birth" required></td>
                        </tr>
                        <tr>
                            <td><input type="tel" name="SoDienThoai" placeholder="Phone Number" required></td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="submit">Sign Up</button></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 20px">Nếu bạn đã có tài khoản, hãy <a href="login.php">Đăng Nhập</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </center>

</body>

</html>