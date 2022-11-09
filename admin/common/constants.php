<?php
    session_start();

    define('APP_URL','http://localhost/product-ordering-system-nist/');    
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','mitho_sekuwa');

    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die(mysqli_error($conn));

?>