<?php 
session_start();
if(!isset($_SESSION['data'])||!isset($_SESSION['username']))
	header('Location:dangnhap.php');
else{
	$data=$_SESSION['data'];
	// var_dump($data);
}
if(isset($_GET['route'])){
	$route=$_GET['route'];
}
echo $route;
$arr_rs = $data;
if($route=="1"){
	$_SESSION['route']="0";
	usort($arr_rs, function ($a, $b)
	{
		return strcmp($a->TenSP, $b->TenSP);	
	});
}else{
	$_SESSION['route']="1";
	usort($arr_rs, function ($a, $b)
	{
		return -strcmp($a->TenSP, $b->TenSP);	
	});
}

echo '<br>';
echo $_SESSION['route'];
// var_dump($arr_rs);
$_SESSION['data']=$arr_rs;
header('Location:trangchu.php');
?>