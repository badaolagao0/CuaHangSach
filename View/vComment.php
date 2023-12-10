<?php
include_once("Controller/cComment.php");

// if (session_status() !== PHP_SESSION_ACTIVE) {
// 	session_start();
// }

$maSach = $_GET["maSach"];
$p = new cComment();
$tbl = $p->getComment($maSach);

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["btnBL"])) {
	$content = $_POST['content'];
	$user_id = $_SESSION['id'];
	if ($user_id != '' && $content != '' && $content != '') {
		if ($p->themBinhLuan($user_id, $maSach, $content)) {
			echo '<script>location.href="/CuaHangSach/DetailProduct.php?maSach=' . $maSach . '";</script>';
		}
		;
	}
}
//

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["btnXoa"])) {
	$id_comment = $_POST['MaBinhLuan'];
    // print_r('hello');
	if ($id_comment != '') {
		if ($p->xoaBinhLuan($id_comment)) {
			echo '<script>location.href="/CuaHangSach/DetailProduct.php?maSach=' . $maSach . '";</script>';
		}
		;
	}
}
//
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["btnSua"])) {
	$id_comment = $_SESSION['id_comment'] = $_POST['MaBinhLuan'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["btnLuu"])) {
	$id_comment = $_POST['MaBinhLuan'];
	$new_content = $_POST['new_content'];

	if ($id_comment != '' && $new_content != '') {
		if ($p->suaBinhLuan($id_comment, $new_content)) {
			echo '<script>location.href="/CuaHangSach/DetailProduct.php?maSach=' . $maSach . '";</script>';
		}
		;
	}
	unset($_SESSION['id_comment']);
}
?>

<?php
while ($row = mysql_fetch_array($tbl)) {
	?>
<div class="row mt-2">
    <div class="col-4">
        <?php echo $row['HoTen']; ?><br />
        <?php echo $row['NgayBinhLuan']; ?>
    </div>
    <div class="col-8">
        <div class="row">
            <?php
				if (isset($_SESSION['id_comment']) && $_SESSION['id_comment'] == $row['MaBinhLuan']) { ?>
            <form method="post">
                <div class="col-12">
                    <input type="text" name="new_content" placeholder="Nhap noi dung muon sua..." />
                    <button onclick="return confirm('Bạn có muốn lưu?')" class="btn btn-success"
                        name="btnLuu">Lưu</button>
                </div>
                <input type="hidden" name="MaBinhLuan" value="<?php echo $row['MaBinhLuan']; ?>">
            </form>
            <?php } else { ?>
            <div class="col-12">
                <?php echo $row['NoiDung']; ?>
            </div>
            <?php } ?>

        </div>
        <div class="row">
            <div class="col-6">
                <!-- Thích -->
            </div>
            <div class="col-6">
                <form method="post">
                    <?php if (isset($_SESSION['id']) && ($row['MaKH'] == $_SESSION['id'])) { ?>
                    <button onclick="return confirm('Bạn có muốn sửa bình luận?')" class="btn-adj" name="btnSua"><i
                            class='fa fa-pencil-square-o' aria-hidden='true'></i></button>
                    <?php } ?>
                    <button onclick="return confirm('Bạn có muốn xóa bình luận này?')" class="btn-adj" name="btnXoa"><i
                            class='fa fa-trash-o' aria-hidden='true'></i></button>
                    <input type="hidden" name="MaBinhLuan" value="<?php echo $row['MaBinhLuan']; ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<form method="post">
    <div class="row mt-4">
        <div class="col-8">
            <input type="text" name="content" class="form-control" placeholder="Nhập bình luận" />
        </div>
        <div class="col-2">
            <button class="btn btn-info" name="btnBL" onclick="return confirm('Bạn có muốn bình luận?')">Gửi</button>
        </div>
    </div>
</form>