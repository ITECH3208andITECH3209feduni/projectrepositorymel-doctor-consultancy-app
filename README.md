<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class = "loginContainer">
		<form action="" method="POST" id = "loginForm">
			<h2>Doctor Consultancy App</h2><br><br>
			<?php
			require("utils/config.php");
			session_start();
			session_unset();
			if(isset($_POST['username'])){
				$username = stripslashes($_POST['username']);
				$password = stripslashes($_POST['password']);
				$query = "SELECT username,password FROM user WHERE username = '$username'";
				$result = $con->query($query);
				$rows = $result->fetch_assoc();
				
				if($rows['username']==$username){
					if(password_verify($password,$rows['password'])){
						$_SESSION['username'] = $username;
						header("Location: dashboard.php");
					}
					else{
						echo"<p>Incorrect Password!</p>";
					}
				}
				else{
						echo"<p>Username Not Registered!</p>";
				}
			}
			?>
	
			<input type="text" size="10" name="username" placeholder = "Username" id="typefield" required></br><br>
			<input type="password" size="10" name="password" placeholder = "Password" id="typefield" required></br><br>
			<button>Login</button> </br>			
			<p>Not Registered?</p>
			<a = href="signup.php">Sign Up</a>
			</form>
	</div>
</body>
</html>

