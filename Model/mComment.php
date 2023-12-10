<?php
include_once("connect.php");

class mComment
{
	function SelectComment($maSach)
	{
		$conn;
		$p = new connect();
		$result = $p -> ConnectDB($conn);

		if($result){
			$query = "SELECT binhluan.*, khachhang.HoTen
			FROM binhluan
			LEFT JOIN khachhang ON binhluan.MaKH = khachhang.MaKH
			WHERE binhluan.MaSach = '$maSach'";
			$tbl = mysql_query($query);

			$p -> CloseConnect($conn);
			return $tbl;
		}else{
			return false;
		}
	}

	function SelectAllComment()
	{
		$conn;
		$p = new connect();
		$result = $p -> ConnectDB($conn);

		if($result){
			$query = "SELECT *
			FROM binhluan
			ORDER BY MaBinhLuan DESC";
			$tbl = mysql_query($query);

			$p -> CloseConnect($conn);
			return $tbl;
		}else{
			return false;
		}
	}

	//Thêm binh luận 
	function themBinhLuan($id, $idKh, $idSach, $noiDung)
	{
		$conn;
		$p = new connect();
		$result = $p -> ConnectDB($conn);
		$sql = "INSERT INTO binhluan(MaBinhLuan, MaKH, MaSach, NoiDung, NgayBinhLuan) 
		VALUES ('".$id."', '" . $idKh . "', '" . $idSach . "', '" . $noiDung . "','" . date('Y-m-d') . "')";
		return mysql_query($sql);
	}

	function xoaBinhLuan($id_comment)
	{
		$conn;
		$p = new connect();
		$result = $p -> ConnectDB($conn);
		$sql = "DELETE FROM binhluan WHERE MaBinhLuan = '" . $id_comment . "'";
		// var_dump($sql);die;
		return mysql_query($sql);
	}

	function suaBinhLuan($id_comment, $new_content)
	{
		$conn;
		$p = new connect();
		$result = $p -> ConnectDB($conn);
		$sql = "UPDATE binhluan SET NoiDung = '" . $new_content . "' WHERE MaBinhLuan = '" . $id_comment . "'";
		// var_dump($sql);die;
		return mysql_query($sql);
	}

}
?>