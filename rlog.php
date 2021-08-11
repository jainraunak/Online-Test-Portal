<?php 
$username = $_GET["q"];
$password = $_GET["k"];
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
$select = "SELECT username,password,email from username where username = '$username' or email = '$username' and username != '$empt' ";
$result = $conn->query($select);
$rown = $result->num_rows;
if($rown == 0){
echo "0";
}
else{
while($row = $result->fetch_array()){
if($row["username"] == $username || $row["email"] == $username && $row["password"] == $password){
echo "1";
}
else{
echo "0";
}
}
}
}
$conn -> close();
?>
