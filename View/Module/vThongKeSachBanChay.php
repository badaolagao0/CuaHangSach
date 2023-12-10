<?php

include_once('./Controller/cModule.php');

include_once('View/Module/vDonDathangTuan.php');


class ViewThongKeSach
{
    function viewAllThongKeSach($startDT = null, $endDT = null, $startS = null, $endS = null)
    {
        $p = new controlModule();
        $tbl = $p->getAllThongKeSach($startS, $endS);

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
        <h1>Thống kê doanh thu sách bán được nhiều nhất</h1>
        <form action="#" method="post" class="d-flex align-items-center">
            <input type="date" name="startS" value=<?php printf($startS) ?> class="form-control me-2"
                style="width: 15%">
            -
            <input type="date" name="endS" value=<?php printf($endS) ?> class="form-control ms-2" style="width: 15%">
            <input type="date" hidden name="startDT" value=<?php printf($startDT) ?>>
            <input type="date" hidden name="endDT" value=<?php printf($endDT) ?>>
            <button class="btn btn-dark ms-2">Thống kê</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Tiêu đề sách</th>
                    <th>Tổng số lượng bán</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        if (!empty($tbl)) {
                            $tong = 0;
                            while ($row = mysql_fetch_assoc($tbl)) {
                                $tong += $row['TongDoanhThu'];
                        ?>
                <tr>
                    <td><?php echo $row['TieuDe']; ?></td>
                    <td><?php echo $row['TongSoLuong']; ?></td>
                    <td><?php echo $row['TongDoanhThu'] ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="2">Tổng doanh thu</td>
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