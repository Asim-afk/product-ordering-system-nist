<?php
    include('common/constants.php')

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-mitho-sekuwa</title>
    <style>
        
    </style>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">login</h1>
        <br>
        <?php  
            include('../config/session.php');
        ?>
        <br>
        <form action="" method="post" >
            <label for="">User name: </label>
            <input type="text" name="user_name" class="form-control-login" placeholder="Enter your user name">
            <br><br>
            <label for="">Password: </label>
            <input type="password" name="password" class="form-control-login" placeholder="Enter your password">
            <br><br><input type="submit" name="submit" value="login" class="btn btn-primary">
        </form>
        
        <p class="text-center">Designed by <a href="">Asim Chaulagain</a></p>
    </div>

    <?php
     if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
            $user_name = $_POST['user_name'];
            $password = md5($_POST['password']);
            
            $sql="SELECT * FROM users where user_name='$user_name' AND password='$password'";
            
            $exec= mysqli_query($conn,$sql);
            if($exec== TRUE){
                $count= mysqli_num_rows($exec);
                if($count==1){
                    $_SESSION['message'] = '<div class="success">Logged in sucessfully</div>';
                    $_SESSION['user']= $user_name;
                    header('location:'.APP_URL.'/admin/index.php');
                }
                else{
                    $_SESSION['message'] = '<div class="error">Your credentials do not match</div>';
                    header('location:'.APP_URL.'/admin/login.php');
                }
            }
            else{
                $_SESSION['query-error'] = '<div class="error">something went wrong</div>';
                header('location:'.APP_URL.'/admin/login.php');
            }
        
        }
     } 
    ?>
</body>
</html>