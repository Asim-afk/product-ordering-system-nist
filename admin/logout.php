<?php
include('common/constants.php');
    session_destroy();
    header('location:'.APP_URL.'admin/login.php');
?>