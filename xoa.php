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
	foreach ($data as $key => $row) {
		if($row->MaSP==$masp){
			unset($data[$key]);
			$_SESSION['data']=$data;
			header('Location:trangchu.php');
		}
	}
}
?>
