<?php include('common/header.php') ?>
    <!--form validation-->

     <!-- Body Section Starts -->
     <section class="content">
        <div class="wrapper">
            <strong class="heading">ADD USER</strong>
            <br><br>
            <?php include('../config/session.php') ?>
            <!-- Users Add form-->
            <form method="post" action="add-user.php">
                <table class="table">
                    <tr>
                        <td>UserName
                        <input type="text" placeholder="Enter a unique username" name="user_name" value="" class="form-control">
                        <br>
                    </tr>
                    <tr>
                        <td>Full name
                        <input type="text" placeholder="Enter your name" name="full_name" value=""class="form-control">
                        <br>
                    </tr>
                    <tr>
                        <td>Password
                        <input type="password" placeholder="*******" name="password" value=""class="form-control">
                        <br>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                        
                        <input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary"></td>
                    </tr>
                </table>
            </form>
            <!-- Users Table End -->
        </div>
</section>
    <!-- Body Section Ends -->

 

<?php include('common/footer.php') ?>


<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
            echo"clicked";
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];
            $password = md5($_POST['password']);
            
            $sql = "INSERT INTO users SET 
            full_name='$full_name',
             user_name='$user_name',
             password='$password'
        ";

        if($conn){
            $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            //create database
                if($execute = TRUE){
                    $_SESSION['message'] = '<div class="success"> User added successfully </div> ';
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
