<?php 
    include('common/constants.php');
    $id=$_GET['id'];

    $sql="DELETE FROM USERS WHERE ID = '$id'";

    $exec=mysqli_query($conn,$sql);

    if($exec == TRUE){
        $_SESSION['message'] = '<div class="success"> User deleted successfully </div> ';
        header('location:'.APP_URL.'admin/manage-user.php');
    }
    else{
        $_SESSION['message'] = '<div class="error"> Please try again </div> ';
        header('location:'.APP_URL.'admin/manage-user.php');
    }
    
?>