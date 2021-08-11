<html>
<head>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript"> 
        window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
    </script>
<script>
window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script> 
<style>
body{
background-color : #0000ff; color : gold; font-size:26px;}
</style>
</head>
<body>
<?php

$host = "localhost";
$dbUsername = "something";
$dbPassword = "something";
$dbname = "assessment";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_error(). ')'. mysqli_connect_error());
}
else{
$i = 1;
for( ; $i<=10 ;$i++){
$j = strval($i);
if (!isset($_POST[$j])) {
  $n = 'E';
}
else{
$n = $_POST[$j];}
$q = "UPDATE htmlas set ansobt = '$n' where qno = $i";
$conn->query($q);
}
$sum = 0;
$select = "SELECT cans,marks,ansobt from htmlas";
$result = $conn->query($select);
while($row = $result->fetch_array()){
$a = $row["cans"];
$b = $row["ansobt"];
$c = $row["marks"];
if($a == $b){
$sum = $sum + $c;
}
}
$e = floatval($sum/4);
if($sum >= 12){
echo "<script>alert('Congratulations!')</script>";
echo "<font color = 'red' size = '50'>Congratulations!</font>";
echo "<br><br>";
echo "You are qualified for HTML skills. HTML Skills has been added to your profile";
echo "<br><br>";
echo "Your Rating is : ";
echo "&nbsp;&nbsp;";
echo "<b>";
echo $e;
echo " / 5";
echo "</b>";
}
else{
echo "Sorry, you are not eligible for html skills";
echo "<br><br>";
echo "Your Rating is : ";
echo "&nbsp;&nbsp;";
echo "<b>";
echo $e;
echo " / 5";
echo "</b>";
}
}
$conn->close();
?>
</body>
</html>
