<?php
    include_once('connect.php');
    class modelModule{
        // Sach
        function selectAllSach(){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM sach where TrangThaiXoa=0 ORDER BY MaSach DESC";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllSach2(){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM sach ORDER BY MaSach DESC";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        // sắp xếp sản phẩm theo id giảm dần, sau đó chọn 5(là $count) sản phẩm từ trên xuống bắt đầu từ limit
        function selectSachOnPage($limit,$count){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM sach
                where sach.TrangThaiXoa=0
                ORDER BY Sach.MaSach DESC limit $limit,$count";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllSachOnPageByName($limit,$count,$name){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM sach where TrangThaiXoa=0 and TieuDe like '%".$name."%' ORDER BY MaSach DESC limit $limit,$count";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllSachLatest(){
            $con;   
            $p = new connect(); 
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM sach
                JOIN nhaxuatban ON sach.MaNXB = nhaxuatban.MaNXB
                JOIN loaisach ON loaisach.MaLoai = sach.MaLoai
                JOIN sach_tacgia ON sach.MaSach = sach_tacgia.MaSach
                JOIN tacgia ON tacgia.MaTacGia = sach_tacgia.MaTacGia
                where sach.TrangThaiXoa=0
                ORDER BY Sach.MaSach DESC";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }


        function insertBook($identityVariable, $name, $image, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "insert into sach(MaSach, TieuDe, HinhAnh, DonGia, SoLuong, MoTa, GhiChu, NamSanXuat, MaNXB, MaLoai, MaKho) values ('$identityVariable','$name','$image', $price, $amount,'$describe', '$note', $year, '$nxb', '$category', '$warehouse')";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                if ($kq) {
                    return 1;
                }
            } else {
                return 0;
            }
        }

        function updateBookHaveImage($id , $name, $image, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE sach SET TieuDe = '$name', HinhAnh = '$image', DonGia = $price, SoLuong = $amount, Mota='$describe', GhiChu = '$note', NamSanXuat = $year, MaNXB= '$nxb', MaLoai='$category', Makho='$warehouse' WHERE MaSach like '$id'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function updateBookNoImage($id , $name, $price, $amount, $describe, $note, $year, $nxb, $category, $warehouse){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE sach SET TieuDe = '$name', DonGia = $price, SoLuong = $amount, Mota='$describe', GhiChu = '$note', NamSanXuat = $year, MaNXB= '$nxb', MaLoai='$category', Makho='$warehouse' WHERE MaSach like '$id'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }

        function deleteBook($idBook){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "update sach set TrangThaiXoa = 1 where MaSach = '$idBook'";
                $kq = mysql_query($string);
                $p -> CloseConnect($con);
                return $kq;
            } else {
                return false;
            }
        }
        
        function selectAllBookByName($name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from sach where TieuDe like '%".$name."%' and TrangThaiXoa=0";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function selectAllBookById($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "        SELECT *
                FROM sach
                JOIN nhaxuatban ON sach.MaNXB = nhaxuatban.MaNXB
                JOIN loaisach ON loaisach.MaLoai = sach.MaLoai
                JOIN sach_tacgia ON sach.MaSach = sach_tacgia.MaSach
                JOIN tacgia ON tacgia.MaTacGia = sach_tacgia.MaTacGia
                Where sach.MaSach like '$id'";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        function selectBookByIdForDetail($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "        SELECT *
                FROM sach
                Where MaSach like '$id' and TrangThaiXoa = 0";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        // Sách - tác giả
        function selectAllDs(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from sach_tacgia ORDER BY MaDS ASC';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function insertDs($id, $idAuthor, $idBook){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "insert into sach_tacgia value('$id', '$idAuthor', '$idBook')";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function updateDs($id, $idAuthor){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE sach_tacgia SET MaTacGia = '$idAuthor' WHERE MaDS = '$id'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function deleteDs($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "delete from sach_tacgia where MaDS = '$id'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        // Tac gia
        function selectAllTacGia(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from tacgia where TrangThaiXoa =0';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        // Bình luận
        function selectAllBinhLuan(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from binhluan';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectAllBinhLuanOfBook($name){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from binhluan join sach on binhluan.MaSach = sach.MaSach where TieuDe like '%".$name."%' and sach.TrangThaiXoa=0";
                $table = mysql_query($string);  
                $p -> CloseConnect($con);
                return $table;  
            } else {
                return false;
            }
        }

        // sắp xếp BL theo id giảm dần, sau đó chọn 5(là $count) sản phẩm từ trên xuống bắt đầu từ limit
        function selectBinhLuanOnPage($limit,$count){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT *
                FROM binhluan ORDER BY MaBinhLuan DESC limit $limit,$count";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function deleteBinhLuan($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "delete from binhluan where MaBinhLuan like '$id'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
        
        // Nhan vien
        function selectAllNhanVien(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from nhanvien join loainv on nhanvien.MaLoaiNV = loainv.MaLoaiNV where TrangThaiXoa = 0';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
        
        function selectAllLoaiSach(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from loaisach where TrangThaiXoa = 0';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
        
        // kho hàng
        function selectAllKho(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from khohang';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function tinhTongSLTonKho(){
            $tbl = $this -> selectAllSach();
            $total = 0;
            if (mysql_num_rows($tbl) > 0) {
                while ($row = mysql_fetch_assoc($tbl)) {
                    $total += $row['SoLuong'];
                }
            }
            return $total;
        }
        
        function capNhatSLTonKho(){
            $con;
            $p = new connect();
            $total = $this -> tinhTongSLTonKho();
            if ($p -> ConnectDB($con)){
                $string = "UPDATE khohang SET SoLuongTonKho = $total WHERE MaKho = 'K01'";
                $res = mysql_query($string);
                $p -> CloseConnect($con);
                return $res;
            } else {
                return false;
            }
        }

        // đơn đặt hàng
        function selectAllDonDatHang(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'SELECT dondathang . * , khachhang.hoten AS hoten_khachhang, nhanvien.hoten AS hoten_nhanvien
                FROM dondathang
                JOIN khachhang ON dondathang.MaKH = khachhang.MaKH
                JOIN nhanvien ON dondathang.MaNhanVien = nhanvien.MaNhanVien;';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectDonDatHangOfKh($nameKh){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT dondathang . * , khachhang.hoten AS hoten_khachhang, nhanvien.hoten AS hoten_nhanvien
                FROM dondathang
                JOIN khachhang ON dondathang.MaKH = khachhang.MaKH
                JOIN nhanvien ON dondathang.MaNhanVien = nhanvien.MaNhanVien
                Where khachhang.hoten like '%$nameKh%'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function selectDonDatHangOnPage($limit,$count){
            $con;   
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT dondathang . * , khachhang.hoten AS hoten_khachhang, nhanvien.hoten AS hoten_nhanvien
                FROM dondathang
                JOIN khachhang ON dondathang.MaKH = khachhang.MaKH
                JOIN nhanvien ON dondathang.MaNhanVien = nhanvien.MaNhanVien
                ORDER BY dondathang.NgayGiao DESC limit $limit,$count";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }
        
        //
        function selectAllKH(){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = 'select * from khachhang';
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function getInfoKh($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "SELECT dondathang . * , khachhang.hoten AS hoten_khachhang
                FROM dondathang
                JOIN khachhang ON dondathang.MaKH = khachhang.MaKH
                WHERE khachhang.MaKH LIKE '$id'
                ORDER BY dondathang.NgayGiao DESC";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        // kiểm tra user
        function chkUserKH($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from khachhang where MaKH like '$id'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        function chkUserNV($id){
            $con;
            $p = new connect();
            if ($p -> ConnectDB($con)){
                $string = "select * from nhanvien where MaKH like '$id'";
                $table = mysql_query($string);
                $p -> CloseConnect($con);
                return $table;
            } else {
                return false;
            }
        }

        // ------------Tuân-----------------------

    function selectDonDatHang($id)
    {
        $con;
        $p = new connect();
        if ($p->ConnectDB($con)) {
            $string = "select * from dondathang where MaDonHang = '$id'";
            $table = mysql_query($string);
            $p->CloseConnect($con);
            return $table;
        } else {
            return false;
        }
    }

    function selectAllDonHangChoDuyet()
    {
        $con;
        $p = new connect();
        if ($p->ConnectDB($con)) {
            $string = "select * from dondathang d
                join khachhang k on d.MaKH = k.MaKH
                where TinhTrang = 0";
            $table = mysql_query($string);
            $p->CloseConnect($con);
            return $table;
        } else {
            return false;
        }
    }

    function updateStatusOrder($id)
    {
        $con;
        $p = new connect();
        if ($p->ConnectDB($con)) {
            $string = "UPDATE dondathang SET TinhTrang = 1  WHERE MaDonHang like '$id'";
            $kq = mysql_query($string);
            $p->CloseConnect($con);
            return $kq;
        } else {
            return false;
        }
    }

    
    function selectAllThongKeDoanhThu($start, $end)
    {
        $con;
        $p = new connect();

        if ($p->ConnectDB($con)) {
            $whereDate = "dh.NgayTiepNhan IS NOT NULL";

            //So sánh ngày bắt đầu và kết thúc so với hôm nay
            $today = date("Y-m-d");

            //Nếu lớn hơn ngày hôm nay thì cho là null
            if ($today < $start) {
                $start = null;
            }

            if ($today < $end) {
                $end = null;
            }

            //Nếu so sánh null hoặc không đưa giá trị vào thì không Where
            if ($start) {
                if (!$end) {
                    $whereDate = "dh.NgayTiepNhan >= '$start'";
                } else {
                    //Có start thì start phải nhỏ hơn hoặc bằng end
                    if ($start <= $end) {
                        $whereDate = "dh.NgayTiepNhan BETWEEN '$start' and '$end 12:00:00'";
                    }
                }
            } else {
                //Không có start mà có end thì lấy hết đến ngày end
                if ($end) {
                    $whereDate = "dh.NgayTiepNhan <= '$end'";
                }
            }

            $query = "Select dh.MaDonHang, kh.HoTen, dh.NgayTiepNhan, dh.NgayGiao, dh.TongTien
            from dondathang dh 
            left join khachhang kh on kh.MaKH = dh.MaKH 
            Where $whereDate And dh.TinhTrangDonHang = 1
            ORDER BY dh.NgayTiepNhan";

            $result = mysql_query($query);
            $p->CloseConnect($con);
            return $result;
        }

        return false;
    }

    function selectAllThongKeSach($start, $end)
    {
        $con;
        $p = new connect();

        if ($p->ConnectDB($con)) {
            $whereDate = "dh.NgayTiepNhan IS NOT NULL";

            //So sánh ngày bắt đầu và kết thúc so với hôm nay
            $today = date("Y-m-d");

            //Nếu lớn hơn ngày hôm nay thì cho là null
            if ($today < $start) {
                $start = null;
            }

            if ($today < $end) {
                $end = null;
            }

            //Nếu so sánh null hoặc không đưa giá trị vào thì không Where
            if ($start) {
                if (!$end) {
                    $whereDate = "dh.NgayTiepNhan >= '$start'";
                } else {
                    //Có start thì start phải nhỏ hơn hoặc bằng end
                    if ($start <= $end) {
                        $whereDate = "dh.NgayTiepNhan BETWEEN '$start' and '$end 12:00:00'";
                    }
                }
            } else {
                //Không có start mà có end thì lấy hết đến ngày end
                if ($end) {
                    $whereDate = "dh.NgayTiepNhan <= '$end'";
                }
            }

            $query = "Select s.TieuDe, Sum(dh.TongTien) as TongDoanhThu, Sum(dh.SoLuong) as TongSoLuong
            from dondathang dh 
            left join sach s on s.MaSach = dh.MaSach
            Where $whereDate And dh.TinhTrangDonHang = 1
            Group by dh.MaSach
            Order by TongSoLuong DESC, TongDoanhThu DESC
            Limit 0, 10";

            $result = mysql_query($query);
            $p->CloseConnect($con);
            return $result;
        }

        return false;
    }

    function deleteDonDatHang($id)
    {
        $con;
        $p = new connect();
        if ($p->ConnectDB($con)) {
            $string = "delete from dondathang where MaDonHang = '$id'";
            $kq = mysql_query($string);
            $p->CloseConnect($con);
            return $kq;
        } else {
            return false;
        }
    }

    function huyDonDatHang($id)
    {
        $con;
        $p = new connect();
        if ($p->ConnectDB($con)) {
            $string = "update dondathang set TinhTrang = -1 where MaDonHang = '$id'";
            $kq = mysql_query($string);
            $p->CloseConnect($con);
            return $kq;
        } else {
            return false;
        }
    }

    function __construct()
    {
        $db = new connect();
        $isConnected = $db->ConnectDB($this->conn);

        if (!$isConnected) {
            die("Connection failed: " . mysql_error());
        }
    }

    // Các phương thức khác của modelModule

    private function closeConnection()
    {
        $db = new connect();
        $db->CloseConnect($this->conn);
    }

    }
?>