<?php 
session_start();
if(!isset($_SESSION['data'])||!isset($_SESSION['username']))
	header('Location:dangnhap.php');
else{
	$data=$_SESSION['data'];
}
function convertDate($strD){
	$strD=str_replace("-","",$strD);
	$intD=(int)$strD;
	return $intD;
}
if(isset($_GET['masp'])){
	$masp=$_GET['masp'];
	foreach ($data as $row) {
		if($row->MaSP==$masp){
			$row->TenSP= $_REQUEST['tensp'];
			$row->Gia= $_REQUEST['gia'];
			$row->SoLuong= $_REQUEST['soluong'];
			$row->NgayTao= convertDate($_REQUEST['ngay']);
			$row->TrangThai= $_REQUEST['trangthai'];
			break;
		}
	}
	$_SESSION['data']=$data;
	// echo $_REQUEST['ngay'];
	// convertDate();
	header('location:trangchu.php');
}
?>
