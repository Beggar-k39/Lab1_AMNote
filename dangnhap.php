
<?php
// Khởi tạo session 
session_start();
// Xóa session 
unset($_SESSION['username']);
unset($_SESSION['data']);
unset($_SESSION['check']);
unset($_SESSION['route']);
$_SESSION['check']="true";
// Phần khai báo mảng chứa dữ liệu mẫu
$users=[];
$obj1=new stdClass;
$obj1->username="quocthai0099";
$obj1->password="quocthai123";
$users[]=$obj1;
$error="";
$obj2=new stdClass;
$obj2->username="admin";
$obj2->password="admin";
$users[]=$obj2;

// var_dump($users);
$username=isset($_POST['username'])?$_POST['username']:"";
$password=isset($_POST['password'])?$_POST['password']:"";
if($username!="" && $password!=""){
	// echo $username;
	// echo $password;
	foreach ($users as $user) {
		if($user->username==$username&&$user->password==$password){
			$_SESSION['username'] = $username;
			header('Location: trangchu.php');
		}
		else{
			$error ="Sai tên đăng nhập hoặc mật khẩu!";
		}
	}
}
else{
	// $error ="Vui lòng điền đẩy đủ thông tin!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
</head>
<body>
	<div class="container">
		<form action="dangnhap.php" method="post">
			<div class="form-group">
				<label for="exampleInputEmail1">Tên đăng nhập</label>
				<input type="text" class="form-control" name="username" placeholder="Nhập tên tài khoản" required="required">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Mật khẩu</label>
				<input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required="required" >
			</div>
			<?php if($error!=null){  ?>
				<label id="error" style="color:red"><?=$error ?></label>
				<?php
			}?>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="exampleCheck1">
				<label class="form-check-label" for="exampleCheck1">Nhớ đăng nhập</label>
			</div>
			<button type="submit" class="btn btn-success">Đăng nhập</button>
		</form>
	</div>
</body>
</html>


