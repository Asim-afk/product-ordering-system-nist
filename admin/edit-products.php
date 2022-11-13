<?php include('common/header.php') ?>
     <!-- Body Section Starts -->
     <section class="content">
        <div class="wrapper">
        <h1 class="heading">EDIT PRODUCTS</h1>
        <br><br>
        <?php include('../config/session.php') ?>
        <?php 
        //getting id 
        $id = $_GET['id'];
        
        //making sql to select value 
        $sql = "SELECT * FROM PRODUCTS where id='$id'";

        //execute the query
        $exec = mysqli_query($conn, $sql);

        //count the number of rows
        $count = mysqli_num_rows($exec);

        if($count == 1){
            while($rows=mysqli_fetch_assoc($exec)){
                $id = $rows['id'];
                $title = $rows['title'];
                $price = $rows['price'];
                $featured = $rows['featured'];
                $current_image = $rows['image_name'];
                $status = $rows['status'];
            }
        }
        ?>
            <!-- Users Add Form -->
            <form method="post" action="" enctype="multipart/form-data">
            <table class="table">
                    <tr>
                        <td class="text-right">Title</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?> " placeholder="Enter title.." id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">Price</td>
                        <td>
                            <input type="text" name="price" value="<?php echo $price; ?> " placeholder="Enter price.." id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">Current Image</td>
                        <?php
                                        if($current_image != "") {
                                            ?>
                                            <td>
                                            <img width="100" height="100" src="../images/products/<?php echo $current_image; ?>" alt="<?php echo $title; ?>">
                                            </td>
                                            <?php
                                        }else{
                                           echo '<td>No Image Found</td>'; 
                                        }
                                    ?>
                    </tr>
                    <tr>
                        <td class="text-right">Upload New Image</td>
                        <td>
                            <input type="file" accept="image/*" name="image" id="image" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">Featured</td>
                        <td>
                            <input type="radio" <?php if($featured == "Yes"){echo "checked";} ?> name="featured" id="" value="Yes">Yes
                            <input type="radio" <?php if($featured == "No"){echo "checked";} ?> name="featured" id="" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">Status</td>
                        <td>
                            <input type="radio" <?php if($status == "Yes"){echo "checked";} ?> name="status" id="" value="Yes">Active
                            <input type="radio" <?php if($status == "No"){echo "checked";} ?> name="status" id="" value="No"> InActive
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Users Add Form End -->
        </div>
    </section>
    <!-- Body Section Ends -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
        
        $title = $_POST['title'];
        $price = $_POST['price'];
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured = "No";
        }
        if(isset($_POST['status'])){
            $status = $_POST['status'];
        }else{
            $status = "No";
        }
        $id = $_POST['id'];
        $current_image = $_POST['current_image'];
         if($_FILES['image']['name']){
            $file_end = explode('.',$_FILES['image']['name']);
            $ext = end($file_end);
            $image = 'Product_'.rand(1111,9999).'.'.$ext;
            //uppload the image
            $uploaded_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/products/".$image;

            $upload = move_uploaded_file($uploaded_path, $destination_path);

            if($upload == false){
                $_SESSION['message'] = '<div class="error">Could not upload the image. Try Again</div>';
                die();
            }else{
                $image_name = $image;

                //remove the old image
                if(file_exists("../images/products/".$current_image)){
                    @unlink("../images/products/".$current_image);
                }
            }
        }else{
            $image_name = $current_image;
        }

        //making sql 
        $sql = "UPDATE PRODUCTS SET 
        title='$title',
        price='$price',
        featured='$featured',
        status='$status',
        image_name='$image_name'
        WHERE id='$id'";
       
	if($conn){
		$execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if($execute == TRUE){
				$_SESSION['message'] = "<div class='success'>Product updated Successfully</div>";

			}else{
				$_SESSION['message'] = '<div class="error">Could not Edit Product Instantly. Try Again</div>';
                header('location:'.APP_URL.'admin/edit-products.php');
			}

	}else{
		die("Connection Failed!".mysqli_connect_error());
	}
    
    }
}
?>
<?php include('common/footer.php')?>