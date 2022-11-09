<?php 
    if(!isset($_SESSION['user'])){
        $_SESSION['message']= '<div class="error">You must log in first </div>';
        header('location:'.APP_URL.'admin/login.php');
    }
    
?>