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
$otp = $_GET["q"];
$email = $_GET["k"];
$host = "localhost";
$dbUsername = "something";
$dbPassword = "something";
$dbname = "assessment";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_error(). ')'. mysqli_connect_error());
}
else{
$select = "SELECT otp FROM username where email = '$email' ";
$result = $conn->query($select);
while($row = $result->fetch_array()){
$a = $row["otp"];
if($a == $otp){
echo "<form action = 'signup.html' method = 'post'>";
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
</form><center><div style = "font-size :12px;"><b>Instructions : </b><br><ol><li>Username and Password should be of atleast 8 characters and atmost 16 characters.<br><li>Password should include atleast one number,special character - !,@,#,$,%,^,&,*,_.<br><li>Donot include blank spaces in Username and Password.</ol><br></div></center>';
$que = "UPDATE username SET verify = '1' where email = '$email' ";
$conn->query($que);
}
else{

echo "<input type = 'hidden' id = 'email' value = '$email'>";
echo '<div class = "d2">Enter OTP</div><font color = "gold">Invalid OTP</font>
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "otp" placeholder = "Enter OTP" style = "width : 80%; height : 38px; border : none; font-family: monospace;"></center>
<br>
<br>
<button class = "b" onclick = "otp()">Submit OTP</button>
<br>
<br>'; 
}
}
}
$conn->close();
?>
</body>
</html>
   
