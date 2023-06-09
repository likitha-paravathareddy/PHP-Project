<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
<h1 style="text-align:center;">Registration Form</h1>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["confirm_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!preg_match("/^[a-zA-Z-' ]*$/",$fullName)) {
            array_push($errors, "Full Name is not valid Only letters and white space allowed");
           
          }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{

                require 'database.php';
                $findResult=$result->findOne(['email'=>$email]);
                
                if(isset($findResult)){
                    echo "<div class='alert alert-danger'>User already exists.</div>";
                    header('refresh:0.5;login.php');
                }
                else{
                    try{
                    $insertResult = $result->insertOne([ 'email' => $email, 'password' => $passwordHash,'user'=>$fullName ]);
                   
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header('refresh:0.5;login.php');
                    }
                    catch (Exception $e){
                        echo "<script>alert('failed to register..try again')</script>";
                        header('refresh:0.3;register.php');
                    }
                }
        
           }
          

        }
        ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div style="padding-top:6px"><p>Already Registered? <a href="login.php"> Login Here</a></p></div>
      </div>
    </div>
</body>
</html>