<?php include('common/header.php') ?>
    <!--form validation-->
 <?php 
        $full_name = $user_name =$password="";
        $full_nameError = $user_nameError=$passwordError="";
    ?>

    <?php 
        if($_SERVER["REQUEST_METHOD"]=="POST")    {
            
        if(isset($_POST['submit'])){
            echo"clicked";
            
            $sql = "INSERT INTO users SET 
            full_name='$full_name',
            user_name='$user_name',
             password='$password'
        ";

        if($conn){
            $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if($execute = TRUE){
                    $_SESSION['message'] = "User Added Successfully";
                    header('location:'.APP_URL.'admin/manage-user.php');
                }else{
                    $_SESSION['message'] = "Could not Add User Instantly. Try Again";
                    header('location:'.APP_URL.'admin/add-user.php');
                }

        }
        else{
            die("Connection Failed!".mysqli_connect_error());
        }
    }
}
    ?>  
     <!-- Body Section Starts -->
     <section class="content">
        <div class="wrapper">
            <strong class="heading">ADD USER</strong>
            <br><br>
            <?php include('../config/session.php') ?>
            <!-- Users Add form-->
            <form method="post" action="test.php">
                <table class="table">
                    <tr>
                        <td>UserName
                        <input type="text" placeholder="Enter a unique username" name="user_name" value="<?php echo $user_name; ?>" class="form-control">
                        <br><span class="error">* <?php echo $user_nameError; ?> </span></td>
                    </tr>
                    <tr>
                        <td>Full name
                        <input type="text" placeholder="Enter your name" name="full_name" value="<?php echo $full_name; ?>"class="form-control">
                        <br><span class="error">* <?php echo $full_nameError; ?> </span></td>
                    </tr>
                    <tr>
                        <td>Password
                        <input type="password" placeholder="*******" name="password" value="<?php echo $password; ?>"class="form-control">
                        <br><span class="error">* <?php echo $passwordError; ?> </span></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                        <input type="submit" value="submit" class="btn btn-primary"></td>
                    </tr>
                </table>
            </form>
            <!-- Users Table End -->
        </div>
</section>
    <!-- Body Section Ends -->

 

<?php include('common/footer.php') ?>


-
