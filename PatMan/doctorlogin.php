<?php
$login=false;
$showerror=false;
if(isset($_GET['ac'])){if($_GET['ac']=="truedd"){
    echo '<script>alert("Your account has successfully created")</script>';
    unset($_GET['ac']);
}}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include './partial/_dbcon.php';

    $username=$_POST['username'];
    $password=$_POST['password1'];
    // and password='$password'"
        $sql="SELECT * FROM hospital_dr where username='$username'";
        $result=mysqli_query($con,$sql);
        $num = mysqli_num_rows($result);
        // echo md5($password);
        if($num==1){
            while($row=mysqli_fetch_assoc($result)){ //$row will give the row from database
                $en=md5($password);
                
                if($en==$row['password']){
                    $login=true;
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$username;
                    $_SESSION['password']=$password;
                    $_SESSION['dr_id']=$row['dr_id'];
                    header("location: ./HTML Pages/doctorhomepage.php");
            }
            else{
                $showerror=true;
            }

        }
    }
    else{
        $showerror=true;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
	<title>Doctor Login</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
        if($showerror){
            echo '<script>alert("Invalid Crdentials")</script>';
        }
    ?>
	<!-- <header>
        <a class="logo" href="/">PATMAN</a>
            <nav>
                <ul class="nav__links">
                    <li><a href="#"><i class="fa fa-info-circle"style=" margin: 0 5px;"></i>About</a></li>
                    <li><a href="#"><i class="fa fa-phone"style=" margin: 0 5px;"></i>Contact</a></li>
                    <li><a href="#"><i class="fa fa-user-plus"style=" margin: 0 5px;"></i>Register</a></li>
                    <li><a href="#"><i class="fa fa-user"style=" margin: 0 5px;"></i>Admin</a></li>
                </ul>
            </nav>
        <p class="menu cta">Menu</p> -->
        </header>
        <!-- <div id="mobile__menu" class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="#"><i class="fa fa-info-circle"style=" margin: 0 5px;"></i>About</a>
                <a href="#"><i class="fa fa-phone"style=" margin: 0 5px;"></i>Contact</a>
                <a href="#"><i class="fa fa-user-plus"style=" margin: 0 5px;"></i>Register</a>
                <a href="#"><i class="fa fa-user"style=" margin: 0 5px;"></i>Admin</a>
            </div>
        </div> -->
        <?php require './partial/nav1.php';?>
		<div class="center">
			<h1>Login</h1>
			<h5>As Doctor</h5>
			<form method="post">
				<div class="txt_field">
					<input type="text" name="username" required>
					<span></span>
					<label>Doctor Id</label>
				</div>
				<div class="txt_field">
					<input type="password" name="password1" required>
					<span></span>
					<label>Password</label>
				</div>
				<input type="submit" value="login">
				<a href="./forget.php"><div class="pass">Forgot Password?</div></a>
				<div class="signup_link">
					<a href="./patientlogin.php">Login</a> As a Patient
				</div>
			</form>
		</div>
		<script type="text/javascript" src="./js/mobile.js"></script>
</body>
</html>