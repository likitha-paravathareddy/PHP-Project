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
    <title>Login Form</title>
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
    <h1 style="text-align:center;">Login Form</h1>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];

          
           if(!($email) || !($password)){
            echo "<div class='alert alert-danger'>Please fill the required fields</div>";

           }
           else{
            require 'database.php';
            $findResult=$result->findOne(['email'=>$email]);
            if(isset($findResult)){
            if ($email==$findResult['email']) {
                if (password_verify($password,$findResult['password'])) {
                    $remember=$_POST["remember"];
                    if(isset($remember)){
                        setcookie("email",$email,time()+60*60*7);
                        setcookie("password",$password,time()+60*60*7);
                    }
                    else{
                        setcookie("email",$email,time()-10);
                        setcookie("password",$password,time()-10);
                    }
                    session_start();
                    $_SESSION["user"] = $findResult["user"];
                    $_SESSION["email"]=$email;
                    $_SESSION["password"]=$password;
                    header("Location: index.php");
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        else{
            echo "<div class='alert alert-danger'>you haven't registered yet please register before login</div>";
        }
        }
        }
        ?>
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" id="mail" placeholder="Enter Email:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" id="pass" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-group">
        <input type="checkbox"  name="remember" id="remember">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>

     <div><p style="padding-top:8px;">Haven't registered yet ? <a href="register.php"> Register Here</a></p></div>
    </div>
    <?php
    if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
      
    $user=$_COOKIE["email"];
    $password=$_COOKIE["password"];
    echo "<script>
  
    document.getElementById('mail').value='$user'
    document.getElementById('pass').value='$password'
    </script>";
    }
    ?>

</body>
</html>