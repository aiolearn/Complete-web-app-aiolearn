<?php
$db = mysqli_connect('localhost','root','','aiolearntest');
$ok=false;
if (isset($_GET["user"])){
  $user=$_GET["user"];
  $pass=$_GET["pass"];
  $sql = mysqli_query($db , " select * from user where username='$user' and pass='$pass' " );
  if ( $row = mysqli_fetch_assoc($sql) ){
    $mobile=$row['mobile'];
    $username=$row['username'];
    $ok=true;
    setcookie('mobile', $mobile , time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('namefull', $username , time() + (86400 * 30), "/"); // 86400 = 1 day
  } 
}

if ($ok==true){
echo '1';
}else{
echo '0';
}
?>