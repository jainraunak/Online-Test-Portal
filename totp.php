<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<body bgcolor = >
<?PHP $email = $_GET["q"];
$otp = rand(100000,999999);
$empt = "";
$host = "localhost";
$dbUsername = "something";
$dbPassword = "something";
$dbname = "assessment";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_error(). ')'. mysqli_connect_error());
}
else{
$select = "SELECT votp from username where username !='$empt' and email = '$email' ";
$result = $conn->query($select);
$rown = $result->num_rows;
while($row = $result->fetch_array()){
$votp = $row["votp"];
}
if($rown == 1){
if($votp == 0){
echo "<input type = 'hidden' id = 'email' value = '$email' >";
echo '<div class = "d2">Enter OTP</div>OTP sent Successfully!!
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "otp" name = "otp" placeholder = "Enter OTP" style = "width : 80%; height : 38px; border : none; font-family: monospace;" >
<br><br>
<center><button class = "b" onclick = "veri()">Submit OTP</center>
<br>';
$upd = "UPDATE username set otp = '$otp' where email = '$email' ";
$conn->query($upd);
$to = $email;
$subject = "Profiln Forget Password";
$message = "
<html>
<head>
<title>Profiln Foreget Password</title>
</head>
<body><br>
Hi,<br><br>
<font color = 'red' size = '8'>Welcome to Profiln</font>
<br>
<br>
Please reset your password with the given OTP.<BR>
<b>OTP is valid for 24 hours.</b><br><br>
<b>OTP : $otp </b><br><br>
Thanking You<br>
<font color = 'red'>Team Profiln</font>
</body>
</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <jainraunak906@gmail.com>';
mail($to,$subject,$message,$headers);
$updt = "UPDATE username set votp = 1 where email = '$email' ";
$conn->query($updt);
$d=strtotime("next day");
$a = date("Y-m-d h:i:sa", $d);
$u = "UPDATE username set date = '$a' where email = '$email' ";
$conn->query($u);
}
else{
echo "<input type = 'hidden' id = 'email' value = '$email' >";
echo '<div class = "d2">Enter OTP</div>OTP Already Sent Before
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "otp" name = "otp" placeholder = "Enter OTP" style = "width : 80%; height : 38px; border : none; font-family: monospace;" >
<br><br>
<center><button class = "b" onclick = "veri()">Submit OTP</center>
<br>';
}
}
else{
echo '<input type = "hidden" id = "see" value = "0">
<form action = "page.html" method = "post" id = "myform">
<div class = "d2">Login</div>Sign-Up Not Done
<br>
<br>
<center><i class="fa fa-user icon"></i><input type = "text" id = "username" name = "username" placeholder = "Username/Email" style = "width : 80%; height : 38px; border : none; font-family: monospace;" required>
<br><br>
<center><i class="fa fa-key icon"></i><input type = "password" id = "password" name = "password" placeholder = "Password" style = "width : 80%; height : 38px; border : none; font-family: monospace;" required></center><br><div class = "f" onclick = "fu()"><u>Forget Password</u></div>
<br>
<br>
<center><input type = "button" value = "Login" class = "b" onclick = "che()"></center>
<br>
</form>If not register, Please <a href = "register.html" style ="color:yellow;">Register</a><br><br><br>';
}
}
$conn->close();
?>
</body>
</html>
