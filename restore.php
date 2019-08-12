<?php 
session_start();
if(isset($_SESSION['username'])){
	echo "<h5>Chào mừng <span style='color:red'>".$_SESSION['username']."</span> đến với trang chủ</h5>";
}else{
	header('Location:dangnhap.php');
}
$_SESSION['check']="true";
header('Location:trangchu.php');

 ?>