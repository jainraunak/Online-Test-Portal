<html>
<head>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style>
#u{
color : gold;
font-weight: bold;
}
#p{
color : gold;
font-weight: bold;
}
#cp{
color : gold;
font-weight: bold;
}
.d2{
background-color : red;
color : white;
text-align : center;
font-size : 36px;
width : 100%;
}
.icon {
  padding: 10px;
  background: white;
  color: black;
  min-width: 20px;
  text-align: center;
  min-height : 18px;
  border : none;
}
.b{
color: gold;background-color: black;display: inline-block;
  font-size: 20px;
  height : 32px;
  text-align: center; cursor: pointer;
}
</style>
</head>
<body>


<?php

$ele = $_GET["k"];
if (!isset($_GET["q"])) {
  echo "<script>alert('Email Not Entered')</script>";
  
}
else{
$otp = rand(100000,999999);
$email = $_GET["q"];
$host = "localhost";
$dbUsername = "something";
$dbPassword = "something";
$dbname = "assessment";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_error(). ')'. mysqli_connect_error());
}
else{
$que = "SELECT email,otp,verify,username from username where email = '$email' ";
$result = $conn->query($que);
$nrow = $result->num_rows;
if($nrow == 0){
$to = $email;
$subject = "Profiln Email Verification";
$message = "
<html>
<head>
<title>Profiln Email Verification</title>
</head>
<body>
Hi,<br><br>
<font color = 'red' size = '8'>Welcome to Profiln</font>
<br>
<br>
Please verify your email with the given OTP.<BR>
<b>OTP is valid for 24 hours.</b><br><br>
<b>OTP : $otp </b><br><br>
Thanking You<br>
<font color = 'red'>Team Profiln</font>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <jainraunak906@gmail.com>';
if(mail($to,$subject,$message,$headers)){
$d=strtotime("next day");
$a = date("Y-m-d h:i:sa", $d);
echo "<input type = 'hidden' id = 'email' value = '$email'>";
echo '<div class = "d2">Enter OTP</div><font color = "gold">OTP Sent Successfully!!</font>
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "otp" placeholder = "Enter OTP" style = "width : 80%; height : 38px; border : none; font-family: monospace;"></center>
<br>
<br>
<button class = "b" onclick = "otp()">Submit OTP</button>
<br>
<br>';   
$insert = "INSERT into username(email,otp,verify,date) values('$email','$otp','0','$a')";
$conn->query($insert);
}
else{
echo "<script>alert('Invalid Email')</script>";
echo '<div class = "d2">Register with Profiln</div><center>Invalid Email</center>
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "email" placeholder = "Email" style = "width : 80%; height : 38px; border : none; font-family: monospace;"></center>
<br>
<br>
<button class = "b" onclick = "ver()">Verify</button>
<br>
<br>';
}


}
else{
while($row = $result->fetch_array()){
if($row["verify"] == "0"){
echo "<input type = 'hidden' id = 'email' value = '$email'>";
echo '<div class = "d2">Enter OTP</div><font color = "gold">OTP Already Sent Before</font>
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "otp" placeholder = "Enter OTP" style = "width : 80%; height : 38px; border : none; font-family: monospace;"></center>
<br>
<br>
<button class = "b" onclick = "otp()">Submit OTP</button>
<br>
<br>';
}
else{
if($row["username"] == ""){

echo '<form action = "signup.html" method = "post">';
echo "<input type = 'hidden' id = 'email' name = 'email' value = '$email'>";
echo '<div class = "d2">Register with Profiln</div>
<br>
<br>
<center><i class="fa fa-user icon"></i><input type = "text" id = "username" name = "username" placeholder = "Username" style = "width : 80%; height : 38px; border : none; font-family: monospace;" oninput = "usern()" required><div id = "u"></div></center>
<br>
<center><i class="fa fa-key icon"></i><input type = "password" id = "password" name = "password" placeholder = "Password" style = "width : 80%; height : 38px; border : none; font-family: monospace;" oninput = "n()" required><div id = "p"></div></center>
<br>
<center><i class="fa fa-key icon"></i><input type = "password" id = "cpassword" placeholder = "Confirm Password" style = "width : 80%; height : 38px; border : none; font-family: monospace;" oninput = "c()" required><div id = "cp"></div></center>
<br>
<br>
<input type = "submit" value = "Register" class = "b" onclick = "che()">
<br>
</form>
<center><div style = "font-size :12px;"><b>Instructions : </b><br><ol><li>Username and Password should be of atleast 8 characters and atmost 16 characters.<br><li>Password should include atleast one number,special character - !,@,#,$,%,^,&,*.<br><li>Donot include blank spaces in Username and Password.</ol><br></div></center>
';
}
else{
echo '<div class = "d2">Register with Profiln</div><center>Email Already Registered</center>
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "email" placeholder = "Email" style = "width : 80%; height : 38px; border : none; font-family: monospace;"></center>
<br>
<br>
<button class = "b" onclick = "ver()">Verify</button>
<br>
<br>';
}
}
}
}


}
$conn->close();} 



?>
</body>
</html>
