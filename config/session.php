<?php
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }

            if(isset($_SESSION['query-error'])){
                echo $_SESSION['query-error'];
                unset($_SESSION['query-error']);
            }
?>