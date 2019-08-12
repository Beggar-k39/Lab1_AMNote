<?php 

session_start();

if(isset($_SESSION['username'])){
	echo "<h5>Chào mừng <span style='color:red'>".$_SESSION['username']."</span> đến với trang chủ</h5>";
}else{
	header('Location:dangnhap.php');
}

// echo $_SESSION['check'];
$check=$_SESSION['check'];
if($check=="true")
{
	$data=[];
	$product1=new stdClass;
	$product1->MaSP=1;
	$product1->TenSP="Tivi";
	$product1->Gia=10000000;
	$product1->SoLuong=10;
	$product1->NgayTao=20190801;
	$product1->TrangThai=1;
	$data[]=$product1;

	$product1=new stdClass;
	$product1->MaSP=2;
	$product1->TenSP='Audi';
	$product1->Gia=12000000;
	$product1->SoLuong=3;
	$product1->NgayTao=20190802;
	$product1->TrangThai=0;
	$data[]=$product1;

	$product1=new stdClass;
	$product1->MaSP=3;
	$product1->TenSP='Xe Hơi';
	$product1->Gia=8000000;
	$product1->SoLuong=3;
	$product1->NgayTao=20190803;
	$product1->TrangThai=0;
	$data[]=$product1;

	$product1=new stdClass;
	$product1->MaSP=4;
	$product1->TenSP='Xe Hơi';
	$product1->Gia=15000000;
	$product1->SoLuong=3;
	$product1->NgayTao=20190804;
	$product1->TrangThai=0;
	$data[]=$product1;

	$_SESSION['data']=$data;
	// var_dump($_SESSION['data']);

	$_SESSION['check']='false';
	$_SESSION['route']="1";
}

// var_dump($data);
// echo $_SESSION['route'];
$data=$_SESSION['data'];
// Tìm theo tên
if(isset($_GET['ten'])){
	$bit=false;
	$ten=$_GET['ten'];
	foreach ($data as $row) {
		if($row->TenSP==$ten){
			$data1[]=$row;
			$bit=true;
		}
	}
	if(!$bit){
		header('Location:trangchu.php');
	}
	$data=$data1;
	$_SESSION['data']=$data1;
}
function convertDate($strD){
	$strD=str_replace("-","",$strD);
	$intD=(int)$strD;
	return $intD;
}
// Tìm theo ngày 
if(isset($_GET['submit'])){
	$bit=false;
	$start=$_GET['ngaybatdau'];
	$end=$_GET['ngayketthuc'];
	$start_int =convertDate($start);
	$end_int= convertDate($end);
	foreach ($data as $row) {
		if($row->NgayTao>=$start_int&&$row->NgayTao<=$end_int){
			$data1[]=$row;
			$bit=true;
		}
	}
	if(!$bit){
		header('Location:trangchu.php');
	}
	$data=$data1;
	$_SESSION['data']=$data1;
}
// var_dump($data);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Trang chủ</title>
	<script
	src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<h2>Danh sách sản phẩm</h2>
	<table class="table table-striped table-dark">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên SP</th>
				<th>Giá SP</th>
				<th>...</th>
				<th>Tác vụ</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach ($data as $row) {
				$str=$row->TenSP;
				echo '<tr>';
				echo '<td>'.($i++).'</td>';
				echo '<td>'.($row->TenSP).'</td>';
				echo '<td>'.number_format($row->Gia).'</td>';
				echo '<td><a href="chitiet.php?masp='.$row->MaSP.'">...<a></td>';
				echo '<td>';
				echo '<a class="badge badge-warning" href="sua.php?masp='.$row->MaSP.'">Sửa</a>';
				echo '<a style="cursor:pointer" class="badge badge-danger" 	onclick="Message('.$row->MaSP.',`'.$row->TenSP.'`)">Xóa</a>';
				echo '</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
	<?php 
	// foreach ($data as $row) {
	// 	foreach($row as $key=>$value){
	// 		echo $key.":".$value."<br>";
	// 	}
	// 	echo '<hr>'; 
	// }
	?>
	<hr>
	<h1>Các chức năng bổ trợ</h1>
	<button class="btn btn-success" id="sort_ten" onclick="sortTen();">Sắp xếp theo tên sản phẩm</button>
	<button class="btn btn-danger" onclick="sortGia();">Sắp xếp theo giá sản phẩm</button><br><br>
	<form action="trangchu.php" method="get">
		<table>
			<tr>
				<td><input type="text" name="ten" class="form-control"></td>
				<td><input type="submit" class="btn btn-primary" value="Tìm kiếm"></td>
				<td><button type="button" class="btn btn-success" onclick="Restore()">Khôi phục</button></td>
			</tr>
		</table>
	</form>
	<form class="form-group" action="trangchu.php" method="get">
		<div class="row">
			<div class="col">Ngày bắt đầu</div>	
			<div class="col">Ngày kết thúc</div>	
			<div class="col"></div>	

		</div>
		<div class="row">
			<div class="col">
				<input type="date" class="form-control" name="ngaybatdau" placeholder="Ngày bắt đầu" value="">
			</div>
			<div class="col"><input type="date" class="form-control" name="ngayketthuc" value=""></div>
			<!-- <?=date("Y-m-d") ?> -->
			<div class="col"><input type="submit" class="btn btn-primary" name="submit" value="Tìm kiếm"></div>
		</form>
	</div>
	

</body>
</html>
<script type="text/javascript">
	function Message($ma,$ten){
		var txt;
		var r = confirm("Bạn có muốn xóa "+$ten+" không ?");
		if (r == true) {
			txt = "You pressed OK!";
			window.location='xoa.php?masp='+$ma+'';
		} else {
			txt = "You pressed Cancel!";
		}
		console.log(txt);
	}
	function Restore(){
		window.location='restore.php';
	}
	function sortTen(){
		window.location='sortTen.php?route='+<?=$_SESSION['route'] ?>+'';
	}
	function sortGia(){
		window.location='sortGia.php?route='+<?=$_SESSION['route'] ?>+'';
	}
</script>