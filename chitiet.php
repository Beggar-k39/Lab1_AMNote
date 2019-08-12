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
			break;
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chi tiết sản phẩm</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<h1>Chi tiết sản phẩm</h1>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">Mã SP</th>
				<th scope="col">Tên SP</th>
				<th scope="col">Giá SP</th>
				
				<th scope="col">Số lượng</th>
				<th scope="col">Ngày tạo</th>
				<th scope="col">Trạng thái</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=$row->MaSP?></td>
				<td><?=$row->TenSP?></td>
				<td><?=$row->Gia?></td>
				<td><?=$row->SoLuong?></td>
				<td><input type="date" value="<?php FormatDate($row->NgayTao) ?>" readonly></td>
				<td><?=$row->TrangThai?></td>
			</tr>
		</tbody>
	</table>
	<a class="btn btn-success" href="trangchu.php">Quay về trang chủ</a>
</body>
</html>