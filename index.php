

 <?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   
    <title>User Dashboard</title>
    <style>
        body{
    padding:50px;
}
.container{
    max-width: 600px;
    margin:0 auto;
    padding:50px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    margin-top:50px;
}
.form-group{
    margin-bottom:30px;
}
    </style>
</head>
<body>
    <div class="container">
        <h1 style="padding-left:25px;">Welcome to Dashboard</h1>
        <h3 style="padding-left:190px"><?php echo $_SESSION["user"]?></h3>
        <a style="padding-left:200px;" href="profile.php">Profile</a><br>
        <div style="padding-top:15px;padding-left:190px;">
        
        <a href="logout.php"  class="btn btn-warning">Logout</a>
        </div>
    </div>
</body>
</html>