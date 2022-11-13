<?php
    include('common/constants.php');
    //taking the id 
    $id = $_GET['id'];
        $sql = "SELECT * FROM categories where id='$id'";

        $exec = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($exec);

        if($count == 1){
            while($rows=mysqli_fetch_assoc($exec)){
                $current_image = $rows['image_name'];

                //remove the old image
                if(file_exists("../images/category/".$current_image)){
                    @unlink("../images/category/".$current_image);
                }
            }
        }
    // making the sql 

    $sql = "DELETE FROM CATEGORIES WHERE ID = '$id'";

    //execute query
    $exec = mysqli_query($conn,$sql);

    //checking either true or false
    if($exec == TRUE){
        $_SESSION['message'] = '<div class="success"> Category Deleted Successfully </div>';
    }
    else{
        $_SESSION['message'] = '<div class="error"> Something Went wrong. Try Again. </div>';
    }
    header('location:'.APP_URL.'admin/manage-category.php');
?>