<?php 
session_start();
if(!isset($_SESSION['data'])||!isset($_SESSION['username']))
	header('Location:dangnhap.php');
else{
	$data=$_SESSION['data'];
	// var_dump($data);
}

if(isset($_GET['masp'])){
	$masp=$_GET['masp'];
	foreach ($data as $row) {
		if($row->MaSP==$masp){
			$sp=$row;
		}
	}
}
function FormatDate($intD){
	// echo $intD;
	$strD=$intD."";
	$y=substr($strD,0,4);
	$m=substr($strD,4,2);
	$d=substr($strD,6,2);
	echo $y."-".$m."-".$d;
}
// FormatDate($sp->NgayTao);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sửa thông tin</title>
	<script
	src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<form action="suapro.php?masp=<?=$sp->MaSP?>" method="post">
			<div class="form-group">
				<label >Mã sản phẩm</label>
				<input type="text" class="form-control" name="masp" value="<?=$sp->MaSP ?>" readonly="readonly">
			</div>
			<div class="form-group">
				<label>Tên sản phẩm</label>
				<input type="text" class="form-control" name="tensp" value="<?=$sp->TenSP ?>">
			</div>
			<div class="form-group">
				<label>Giá sản phẩm</label>
				<input type="text" class="form-control" name="gia" value="<?=$sp->Gia ?>">
			</div>
			<div class="form-group">
				<label>Số lượng</label>
				<input type="text" class="form-control" name="soluong" value="<?=$sp->SoLuong ?>">
			</div>
			<div class="form-group">
				<label>Ngày tạo sản phẩm</label>
				<input type="date" class="form-control" id="ngay" name="ngay" value="<?php FormatDate($sp->NgayTao) ?>">
			</div>
			<div class="form-group">
				<label>Trạng thái</label>
				<input type="text" class="form-control" name="trangthai" value="<?=$sp->TrangThai ?>">
			</div>
			<button type="submit" class="btn btn-warning">Sửa</button>
		</form>
	</div>
</body>

</html>
<!-- <script type="text/javascript">
	$(document).ready(function(){
		$("#ngay").blur(function(){
			var ngay=$(this).val();
			alert(ngay);
		});
	});
</script> -->