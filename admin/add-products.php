<?php include('common/header.php') ?>

    <!-- Body Section Starts -->
    <section class="content">
        <div class="wrapper">
             <h1 class="heading">ADD PRODUCTS</h1>
            <br>
            <?php include('../config/session.php') ?>
             <!-- Category Add Form -->
                <form enctype="multipart/form-data" method="post" action="">
                    <table class="table">
                        <tr>
                            <td class="text-right">Title</td>
                            <td>
                                <input type="text" name="title" placeholder="Enter title" id="title" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">Price</td>
                            <td>
                                <input type="text" name="price" placeholder="Enter Price" id="price" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">Image</td>
                            <td>
                                <input type="file" accept="image/*" name="image" id="image" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">Featured</td>
                            <td>
                                <input type="radio" name="featured" id="" value="Yes">Yes
                                <input type="radio" name="featured" id="" value="No">No
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">Status</td>
                            <td>
                                <input type="radio" name="status" id="" value="Yes">Active
                                <input type="radio" name="status" id="" value="No">Inactive
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center"><input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary"></td>
                        </tr>
                    </table>
                </form>
             <!-- Category Add Form End -->
        </div>
    </section>
    <!-- Body Section Ends -->

   

<?php include('common/footer.php') ?>

<?php 
//Form Submit Code
//check if request method is POST or not
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $price= $_POST['price'];  

        //to populate the default value of featured
        if(isset($_POST['featured'])){
            //request value 
            $featured = $_POST['featured']; 
        }else{
            //default value
            $featured = "No";
        }

         //to populate the default value of status
         if(isset($_POST['status'])){
            //request value 
            $status = $_POST['status']; 
        }else{
            //default value
            $status = "No";
        }
    
        

        //Check if request file
        if($_FILES['image']['name']){ 
            $file_end = explode('.',$_FILES['image']['name']);
            $ext = end($file_end);
            $image = 'Product_'.rand(1111,9999).'.'.$ext;
         //upload the image
            $uploaded_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/products/".$image;

            $upload = move_uploaded_file($uploaded_path, $destination_path);

         if($upload == false){
            $_SESSION['message'] = '<div class="error">Could not upload the image. Try again</div>';
            die();
        }else{ 
            $image_name = $image;
       }
    }else{
        $image_name = "";
    }

        //making sql
        $sql = "INSERT INTO PRODUCTS SET
        title='$title',
        price='$price',
        image_name='$image_name',
        featured='$featured',
        status='$status'";

        //Check the connection
        if($conn){
            $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            //create database 
            if($execute = TRUE){
                $_SESSION['message']= '<div class="success"> Product Added Succefully </div>';
                header('location:'.APP_URL.'admin/manage-products.php');
            }else{
                $_SESSION['message'] = '<div class="error"> Could not Add product Instantly. Try Again </div>';
                header('location:'.APP_URL.'admin/add-products.php');
            }
        }else{
            die("Connection Failed".mysqli_connect_error());
        }
    }
}
?>