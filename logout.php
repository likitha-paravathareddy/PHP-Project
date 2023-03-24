

<?php
session_start();
session_destroy();
// if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
//     $user=$_COOKIE["email"];
//     $password=$_COOKIE["password"];
//     setcookie("user",$user,time()-1);
//     setcookie("password",$password,time()-1);
// }
header("Location: login.php");
?>