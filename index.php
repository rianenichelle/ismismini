<?php
	session_start();
	include 'connect.php';
<?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!---LINKS-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

    <title>Mini ISMIS.</title>
</head>

<body>
	<div class="limiter">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="d-flex flex-column justify-content-center">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-55">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
					    <input type = "Submit" class="login100-form-btn" name="login" value = "Login">
					</div>

					<div class="text-center w-full p-t-115">
						<span class="txt1">
							Not a member?
						</span>

						<a class="txt1 bo1 hov1" href="register.php">
							Sign up now							
						</a>
					</div>
				
			</div>
		</div>
		</form>
	</div>
	<?php
	   
	   if(isset($_POST['login'])){
		   $email = $_POST['email'];
		   $password = $_POST['password'];

		
		   $conn = new mysqli($servername,$username,$password,$dbname);
           
	       if($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
		    }  

		   $sql = "SELECT * FROM account WHERE email = '$email'";

		   $query = mysqli_query($conn,$sql);

		   while($row = mysqli_fetch_array($query)){
			   if($row["password"] == $password){
				   if($row["type"] == "Admin"){
					   $_SESSION['account_id'] = $row['account_id'];
					   echo "<script language='javascript'>alert('Successfully Logged In!');window.location.href='index.php';</script>";
					   header("Location:admin.php");
				    }else if($row["type"] == "Student"){
						$_SESSION['account_id'] = $row['account_id'];
					    echo "<script language='javascript'>alert('Successfully Logged In!');window.location.href='index.php';</script>";
					    header("Location:student.php");
				    }else if($row["type"] == "Teacher"){
						$_SESSION['account_id'] = $row['account_id'];
					    echo "<script language='javascript'>alert('Successfully Logged In!');window.location.href='index.php';</script>";
					    header("Location:faculty.php");
				    }
				}else{
					echo "<script language='javascript'>alert('Wrong email and password ');window.location.href='index.php';</script>";
				}
			}
			mysqli_close($conn);
		}
		
	?>
<!--SCRIPTS-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>