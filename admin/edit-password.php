<?php include('common/header.php') ?>
     <!-- Body Section Starts -->
     <section class="content">
        <div class="wrapper">
        <h1 class="heading">Change password</h1>
        <br><br>
        <?php include('../config/session.php') ?>
        <?php 
            //getting id 
            $id = $_GET['id'];
            
            //making sql to select value 
            $sql = "SELECT * FROM users where id='$id'";

            //execute the query
            $exec = mysqli_query($conn, $sql);

            //count the number of rows
            $count = mysqli_num_rows($exec);

            if($count == 1){
                while($rows=mysqli_fetch_assoc($exec)){
                    $id = $rows['id'];
                }
            }
        ?>
            <!-- Users Add Form -->
            <form method="post" action="">
                <table class="table">
                    <tr>
                        <td class="text-right">
                            Old password
                        </td>
                        <td><input type="password" name="old_password" placeholder="Enter your old password.." id="old-password" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            New Password
                        </td>
                        <td><input type="password" name="new_password" placeholder="Enter your new password.." id="new-password" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            Confirm password
                        </td>
                        <td><input type="password" name="confirm-password" placeholder="Cofirm your new password.." id="confirm-password" class="form-control"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Users Add Form End -->
        </div>
    </section>
    <!-- Body Section Ends -->
<?php include('common/footer.php') ?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])){
            
            //Getting the data from the web form in respective variable
            $old_password = md5($_POST['old_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_passwrod= md5($_POST['confirm_password']);
            $id = $_POST['id'];

            //checking if user exists
            $checksql="SELECT * FROM USERS WHERE ID=$id AND password='$old_password'";
            //execute checking sql
            $exec = mysqli_query($conn,$checksql);
            //if exection is successful
            if($exec==TRUE){
                $count=mysqli_num_rows($exec);
                if($count==1){
                    if($new_password==$confirm_passwrod){
                        $sql = "UPDATE users SET 
                        $password='$new_password',
                        WHERE id='$id' AND password='$old_password'";

                        //execute the query
                        $execute = mysqli_query($conn, $sql);

                        if($execute == TRUE){
                            $_SESSION['message']='<div class="successs">password changed successfully</div>';
                        }
                        else{
                            $_SESSION['message'] = '<div class="error">Please try again</div>';
                        }
                    }
                    else{
                        $_SESSION['message'] = '<div class="error"> Please confirm your password</div>';
                    }
                }
            }else{
                $_SESSION['message'] = '<div class="error"> Could not find the user</div>';
            }
        
        //Check the connection 
        if($conn){
            $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            //create database
                if($execute = TRUE){
                    $_SESSION['message'] = "<div class='success'>User updated Successfully</div>";
                    header('location:'.APP_URL.'admin/manage-user.php');
                }else{
                    $_SESSION['message'] = '<div class="error">Could not Edit User Instantly. Try Again</div>';
                    header('location:'.APP_URL.'admin/edit-password.php');
                }

        }else{
            die("Connection Failed!".mysqli_connect_error());
        }
        
        }
    }
?>