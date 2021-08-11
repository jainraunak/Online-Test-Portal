<html>
<head><title>Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"> 
        window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
    </script>
<style>
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
$email = $_GET["q"];
$otp = $_GET["k"];
$host = "localhost";
$dbUsername = "something";
$dbPassword = "something";
$dbname = "assessment";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_error(). ')'. mysqli_connect_error());
}
else{
$select = "SELECT * from username where email = '$email' and otp = '$otp' ";
$result = $conn->query($select);
$rown = $result->num_rows;
if($rown == 1){
echo "<form action = 'fp.html' method = 'post'>";
echo "<input type = 'hidden' id = 'email' name = 'email' value = '$email'>";
echo '<div class = "d2">Enter New Password</div>
<br>
<br>
<center><i class="fa fa-key icon"></i><input type = "password" id = "password" name = "password" placeholder = "New Password" style = "width : 80%; height : 38px; border : none; font-family: monospace;" oninput = "n()" required><div id = "p"></div></center>
<br>
<center><i class="fa fa-key icon"></i><input type = "password" id = "cpassword" placeholder = "Confirm New Password" style = "width : 80%; height : 38px; border : none; font-family: monospace;" oninput = "c()" required><div id = "cp"></div></center>
<br>
<br>
<input type = "submit" value = "Submit" class = "b" onclick = "chec()">
<br>
</form><center><div style = "font-size :12px;"><b>Instructions : </b><br><ol><li>Username and Password should be of atleast 8 characters and atmost 16 characters.<br><li>Password should include atleast one number,special character - !,@,#,$,%,^,&,*,_.<br><li>Donot include blank spaces in Username and Password.</ol><br></div></center>';
}
else{
echo "<input type = 'hidden' id = 'email' value = '$email' >";
echo '<div class = "d2">Enter OTP</div>Invalid OTP
<br>
<br>
<center><i class="fa fa-envelope icon"></i><input type = "text" id = "otp" name = "otp" placeholder = "Enter OTP" style = "width : 80%; height : 38px; border : none; font-family: monospace;" >
<br><br>
<center><button class = "b" onclick = "veri()">Submit OTP</center>
<br>';
}
}
$conn->close();
?>
</body>
</html>
