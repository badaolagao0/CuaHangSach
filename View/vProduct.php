<?php
    session_start();
    include_once("Controller/cProduct.php");
    $p = new controlProduct();
    if (!$_SESSION['login']){
        // $chkAddCart = 'login.php';
        $temp = 'index.php';
    } else {
        // $chkAddCart = '#';
        $temp = 'indexKh.php';
    }
    if(isset($_REQUEST["page"])){
        $page = $_REQUEST["page"];
        $count = $p->countProduct();
        $productpage= 8;
        $tbl = $p->getProductPage($page,$productpage);
    }elseif(isset($_REQUEST['btnSearch'])){
        $search = $_REQUEST['search'];
        // if (empty($search)){
        //     echo "<script> window.location='".$temp."?page=1'</script>";
        // } else {
        //     $tbl = $p ->getAllProductBySearch($search);
        // }
        $tbl = $p ->getAllProductBySearch($search);
    }elseif($_REQUEST["loaisach"]){
        $theloai = $_REQUEST['loaisach'];
        $tbl = $p ->getAllProductByLoai($theloai);
    }elseif($_REQUEST["previous"]){
        echo "<script> alert('có')</script>";
    }else{
        echo "<script> window.location='".$temp."?page=1'</script>";
    }

    if($tbl){
        //kiểm tra kết quả trả về
        if(mysql_num_rows($tbl) > 0){
                echo "<div class='container' style='background-color:white'>";
                echo "<div class='justify-content-around row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4'>";
                while($row = mysql_fetch_assoc($tbl)){

                echo "<div class='card border-0 col' style='margin: 10px 0;'>";
                echo "<img style='max-width: 100%;' class='card-img-top border border-2 border-bottom-0 rounded' src ='image/".$row['HinhAnh']."'/>";
                echo "<div class='card-body border border-2 border-top-0 rounded'>";
                echo "<h5 class='card-title noidung-card'>".$row['TieuDe']."</h5>";
                echo "<p class='card-price'>Giá: ".$row['DonGia'].".000đ</p>";
                // if($chkAddCart!="login.php"){
                //     $chkAddCart="./DetailProduct.php?maSach=".$row['MaSach']."";
                // }
                echo "<a href='./DetailProduct.php?maSach=".$row['MaSach']."' class='btn btn-success'><i class='fa fa-eye' aria-hidden='true'></i> Xem chi tiết</a>";
                echo "</div></div>";
                }
                echo "</div>";
                echo "</div>";

            $sumpage = ceil($p->countProduct()/8);

            if(isset($_REQUEST["page"])){
            echo '<div class="container mt-3">';
            echo '<ul class="pagination justify-content-center">';
            // kiểm tra lấy số page trên link xuống xem, nếu page bằng 1 thì không trở về page trước được nửa nên disable nó đi
            if($_REQUEST["page"] == 1){
                echo '<li class="page-item disabled"><a class="page-link" href="'.$temp.'?page='.($_REQUEST["page"]-1).'#sanpham">Previous</a></li>';
            }else{
                echo '<li class="page-item"><a class="page-link" href="'.$temp.'?page='.($_REQUEST["page"]-1).'#sanpham">Previous</a></li>';
            }
            // Vòng for in ra các trang ví dụ: 1,2,3,...
            for($i = 1;$i <= $sumpage;$i++){
                // kiểm tra lấy số page trên link xuống, nếu bằng với số $i có nghĩa là đang nằm trên page này nên active cho nó sáng lên 
                if($_REQUEST["page"] == $i){
                    echo '<li class="page-item active"><a class="page-link" href="'.$temp.'?page='.$i.'#sanpham">'.$i.'</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link" href="'.$temp.'?page='.$i.'#sanpham">'.$i.'</a></li>';
                }
            }
            // kiểm tra lấy số page trên link xuống xem, nếu page bằng $sumpage(số page lớn nhất được tính) thì không next page sau được nửa nên disable nó đi
            if($sumpage == $_REQUEST["page"]){
                echo '<li class="page-item disabled"><a class="page-link" href="'.$temp.'?page='.($_REQUEST["page"]+1).'#sanpham">Next</a></li>';
            }else{
                echo '<li class="page-item"><a class="page-link" href="'.$temp.'?page='.($_REQUEST["page"]+1).'#sanpham">Next</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }
        }else{
            echo "<div class='container' style='background-color:white'>";
            echo "<div style ='font-size: 20px' class='mb-3 justify-content-around row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 pt-4 pb-4'>";
            echo "KHÔNG CÓ KẾT QUẢ!";
            echo "</div>";
            echo "</div>";
        }
    }else{
        echo "không có giá trị";
    }
?>