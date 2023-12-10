<?php
include_once("Model/mComment.php");
class cComment
{
	function getComment($maSach)
	{
		$mComment = new mComment();
		$tbl = $mComment->SelectComment($maSach);
		return $tbl;
	}
	//Hiển thị ds bình luận
	function hienThiDanhSachBinhLuan($idKh, $idSach)
	{
		$mComment = new mComment();
		return $mComment->layDanhSachBinhLuan($idKh, $idSach);
	}
	// Thêm bình luận
	function themBinhLuan($idKh, $idSach, $noiDung)
	{
		// var_dump($idKh, $idSach, $noiDung);
		include_once('format.php');
		$p = new mComment();
		$tbl = $p->SelectAllComment();
		mysql_data_seek($tbl, 0);
		$row = mysql_fetch_assoc($tbl);
		$so = preg_replace("/[^0-9]/", "", $row['MaBinhLuan']);
		$ma = $so+1;
		$identityVariable =  formatData('BL',$ma);
		return $p->themBinhLuan($identityVariable, $idKh, $idSach, $noiDung);
	}

	function xoaBinhLuan($id_comment)
	{
		$mComment = new mComment();
		return $mComment->xoaBinhLuan($id_comment);
	}

	function suaBinhLuan($id_comment, $new_content)
	{
		$mComment = new mComment();
		return $mComment->suaBinhLuan($id_comment, $new_content);
	}
}
?>