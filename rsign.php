<html>
<style>
         .button {
         background-color: #4CAF50;
         border: 2px solid black;
         color: gold;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 16px;
         margin: 6px 3px;
         cursor: pointer;
         }
      </style>
<style>
body {
  color: black;
}
</style>
<body bgcolor = "#CDBE42">
<?php $username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
$oname = $_POST["oname"];
$phone = $_POST["phone"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$address = $_POST["address"];
if($password == $cpassword){
$host = "localhost";
$dbUsername = "something";
$dbPassword = "something";
$dbname = "registration";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_error(). ')'. mysqli_connect_error());
}
else{
$SELECT = "SELECT Username From rsignup Where Username = ? Limit 1";
$INSERT = "INSERT Into rsignup(Username, Password, Oname, Phone, Gender, Email, Address) values(?,?,?,?,?,?,?)";
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s",$username);
$stmt->execute();
$stmt->bind_result($username);
$stmt->store_result();
$rnum = $stmt->num_rows;
if($rnum == 0){
$stmt->close();
$stmt = $conn->prepare($INSERT);
$stmt->bind_param("sssisss",$username,$password,$oname,$phone,$gender,$email,$address);
$stmt->execute();
echo '<script>alert("Sign Up Done Successfully !")</script>';
echo "Thank You For Joining With Us.";
echo "<br><br>";
echo "Please Login";
echo "<br>";
echo '<a href = "rlogin.html" class = "button">Login</a>';
}
else{
echo "Username Already Exists";
}
$stmt->close();
}$conn->close();
}else{
die("Enter Correct Password");

}
?>

</body>
</html>
