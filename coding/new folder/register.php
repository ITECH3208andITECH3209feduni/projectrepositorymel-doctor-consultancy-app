<!DOCTYPE html>
<html>
<title>Smateria Doctor Consultancy App</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<body class="w3-content" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>Doctor Consultancy App</b></h3>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
     <a href="C:\Users\Lenovo\Xampp\htdocs\new folder\index.php" class="w3-bar-item w3-button">Doctors</a>
    <a href="C:\Users\Lenovo\Xampp\htdocs\new folder\checkup.php" class="w3-bar-item w3-button">Consult</a>
	<a href="C:\Users\Lenovo\Xampp\htdocs\new folder\pharmacy.php" class="w3-bar-item w3-button">Pharmacy</a>
	<a href="C:\Users\Lenovo\Xampp\htdocs\new folder\diagnostic.php" class="w3-bar-item w3-button">Diagnostic</a>
	
    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
      Extras <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="#" class="w3-bar-item w3-button">Read health articals</a>
      <a href="#" class="w3-bar-item w3-button">Read about medicines</a>
      <a href="#" class="w3-bar-item w3-button">About Doctors consultancy App</a>
    
  <a href="#footer" class="w3-bar-item w3-button w3-padding">Contact</a> 
  <a href="#footer"  class="w3-bar-item w3-button w3-padding">Subscribe</a>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">Doctor Consultancy App</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Register</p>
    <p class="w3-right">
	 <i class="fa fa-fw fa-map-marker"></i>
	<input type="text" placeholder="location">
      <input type="text" placeholder="Search doctors">
	  <i class="fa fa-search"></i>
    </p>
  </header>
<a href="Signin.php" class="w3-button w3-blue w3-right">Sign in</a>

  <!-- Image header -->

  <div class="w3-container w3-text-grey" id="jeans">
  </div>
  <!-- Subscribe section -->
  <div class="w3-container w3-black w3-padding-32">
  	<form action="" method="POST" id = "signupForm">
  <?php
				require("utils/config.php");
				session_start();
				//checking if the form has been submitted
				if(isset($_POST['username'])){
					$username = $_POST['username'];
					//checking if the username exists in the database
					$checkUserNameQuery="SELECT * FROM users WHERE username = '$username'";		
					$usernameResult = $con->query($checkUserNameQuery);
					$rows = $usernameResult->fetch_assoc();
					
					if (isset($rows)){
						echo("Username taken. Please type a different Username.<br>");
					}
					elseif(strlen($_POST['password'])<5){
						echo("Password must be at least 5 characters!<br>");
					}
					elseif($_POST['password'] != $_POST['rePassword']){
						echo("Passwords do not match!<br>");
					}					
					else
					{
						
						$number = $_POST['number'];
						$email = $_POST['email'];
						$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
						$address= $_POST['address'];
						$picture=$_POST['picture'];
						$idResult = $con->query("SELECT MAX(id) AS id FROM users");
						$idResult1 = $idResult->fetch_assoc();
						$maxId = $idResult1['id'];
						$con->query("ALTER TABLE users AUTO_INCREMENT = $maxId");
						$query = "INSERT INTO users(username,number,email,password,address,profile,photo_url) VALUES ('$username','$number','$email','$password','$address',NULL,'$picture')";
						if($con->query($query)){
							echo ("User $username Successfully Created!<br>");
						}
						else{
							echo("Failed to create user!<br>");
						}
					}
				}
			?>
    <h1>Welcome to Doctor Consultancy App</h1>
    <p>Please fill your details.</p>
	<p><a href="doctorsignup.php">Click Here if you are a doctor</a></p>
	 <p><input class="w3-input w3-border" type="text" name="username" placeholder="Name" style="width:50%"></p>
	 <p><input class="w3-input w3-border" type="text" name="number" placeholder="Number" style="width:50%"></p>
	 <p><input class="w3-input w3-border" type="text" name="email" placeholder="Email" style="width:50%"></p>
     <p><input class="w3-input w3-border" type="password" name="password" placeholder="Password" style="width:50%"></p>
	 <p><input class="w3-input w3-border" type="password" name="rePassword" placeholder="Re enter Password" style="width:50%"></p>
	 <p><input class="w3-input w3-border" type="text" name="address" placeholder="Address" style="width:50%"></p>
	 <p><input class="w3-input w3-border" type="text" name="picture" placeholder="Your photo" style="width:50%"></p>
	
	<button  class="w3-button w3-red w3-margin-bottom">Register</button>
	</form>
  </div>
  <div class=" " id= "body"> 
  
	
	
	</div>
  <!-- Footer -->
  <footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
    <div class="w3-row-padding">
      <div class="w3-col s4">
        <h4>Contact</h4>
        <p>Questions? Go ahead.</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="w3-input w3-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Message" name="Message" required></p>
          <button type="submit" class="w3-button w3-block w3-black">Send</button>
        </form>
      </div>

      <div class="w3-col s4">
        <h4>About</h4>
        <p><a href="#">Support</a></p>
        <p><a href="#">Find store</a></p>
        <p><a href="#">Payment</a></p>
        <p><a href="#">Help</a></p>
      </div>

      <div class="w3-col s4 w3-justify">
        <h4>Store</h4>
        <p><i class="fa fa-fw fa-map-marker"></i> Company Name</p>
        <p><i class="fa fa-fw fa-phone"></i> </p>
        <p><i class="fa fa-fw fa-envelope"></i> Doctorconsultacy@gmail.com</p>
        <h4>We accept</h4>
        <p><i class="fa fa-fw fa-cc-amex"></i> Debit</p>
        <p><i class="fa fa-fw fa-credit-card"></i> Credit Card</p>
		<p><i class="fa fa-fw fa-credit-card"></i> Debit Card</p>
        <br>
        <i class="fa fa-facebook-official w3-hover-opacity w3-large"></i>
        <i class="fa fa-instagram w3-hover-opacity w3-large"></i>
        <i class="fa fa-snapchat w3-hover-opacity w3-large"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity w3-large"></i>
        <i class="fa fa-twitter w3-hover-opacity w3-large"></i>
        <i class="fa fa-linkedin w3-hover-opacity w3-large"></i>
      </div>
    </div>
  </footer>

  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

  <!-- End page content -->
</div>

<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Join our mailing list to receive updates on new arrivals and special offers.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<script>
// Accordion 
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

// Click on the "Jeans" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();


// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>

