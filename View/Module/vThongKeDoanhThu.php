<?php

include_once('./Controller/cModule.php');
include_once('View/Module/vDonDathangTuan.php');
include_once('View/Module/vThongKeSachBanChay.php');
class ViewThongKeDoanhThu
{
    function viewAllthongKeDoanhThu($startDT = null, $endDT = null, $startS = null, $endS = null)
    {
        //Hiển thị thống kê sách ở trên thống kê doanh thu luôn
        $v = new ViewThongKeSach();
        $v->viewAllThongKeSach($startDT, $endDT, $startS, $endS);

        //Hiển thị thống kê doanh thu
        $p = new controlModule();
        $tbl = $p->getAllThongKeDoanhThu($startDT, $endDT);

        $location = 'admin.php';
        $this->display($startDT, $endDT, $startS, $endS, $tbl, $location);
    }

    function display($startDT, $endDT, $startS, $endS, $tbl, $location)
    {



?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Thống kê doanh thu sách bán được nhiều nhất</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}





nav a {
    color: #fff;
    text-decoration: none;
}

main {
    margin: 20px;
}

h1 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}
</style>

<body>

    <main>
        <h1>Thống kê doanh thu</h1>
        <form action="#" method="post" class="d-flex align-items-center">
            <!-- Ngày bắt đầu và kết thúc thống kê của Doanh thu và Sách
                        Lưu cả 2 vì khi thay đổi Doanh thu thì Sách vẫn giữ nguyên và ngược lại
                    -->
            <input type="date" name="startDT" value=<?php printf($startDT) ?> class="form-control me-2"
                style="width: 15%">
            -
            <input type="date" name="endDT" value=<?php printf($endDT) ?> class="form-control ms-2" style="width: 15%">
            <input type="date" hidden name="startS" value=<?php printf($startS) ?>>
            <input type="date" hidden name="endS" value=<?php printf($endS) ?>>
            <button class="btn btn-primary ms-2">Thống kê</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Mã HĐ</th>
                    <th>Khách hàng</th>
                    <th>Ngày tiếp nhận</th>
                    <th>Ngày giao hàng</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        if (!empty($tbl)) {
                            $tong = 0;
                            while ($row = mysql_fetch_assoc($tbl)) {
                                $tong += $row['TongTien'];
                        ?>
                <tr>
                    <td><?php echo $row['MaDonHang']; ?></td>
                    <td><?php echo $row['HoTen']; ?></td>
                    <td><?php echo $row['NgayTiepNhan'] ?></td>
                    <td><?php echo $row['NgayGiao'] ?></td>
                    <td><?php echo $row['TongTien'] ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="4">Tổng doanh thu</td>
                    <td><?php echo $tong ?></td>
                </tr>
                <?php
                        } else {
                            // Hiển thị thông báo khi không có dữ liệu
                        ?>
                <tr>
                    <td colspan="3">Không có dữ liệu thống kê doanh thu.</td>
                </tr>
                <?php
                        }
                        ?>

            </tbody>
        </table>
    </main>

</body>

</html>

<?php
    }
}
?>