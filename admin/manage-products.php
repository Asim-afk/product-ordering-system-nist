<?php include('common/header.php') ?>

<!-- Body Section Starts -->
<section class="content">
    <div class="wrapper">
        <strong class="heading">MANAGE PRODUCTS</strong><br>
        <?php include('../config/session.php') ?>
        <br>
        <a class="btn btn-secondary category-add" href="add-products.php"> Add Products</a>
        <br>
        <!-- Users Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>featured</th>
                    <th>Status</th>
                    <th>category_id</th>
                    <th>Action</th>
                </tr> 
            </thead>
            <tbody>
                    <?php 
                        //making the sql to fetch the data from categories table
                        $sql = "SELECT * FROM `products`";

                        //execute the query
                        $exec = mysqli_query($conn, $sql);

                        //if there is something
                        if($exec == TRUE){
                        //count the number of rows
                        $count = mysqli_num_rows($exec);

                        if($count > 0){
                            $sn=1;
                            while($rows = mysqli_fetch_assoc($exec)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $price = $rows['price'];
                                $current_image = $rows['image_name'];
                                $featured = $rows['featured'];
                                $category_id = $rows['category_id'];
                                $status = $rows['status'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
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
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                
                                    <a class="btn btn-primary" href="<?php  echo APP_URL; ?>admin/edit-products.php?id=<?php echo $id; ?>">
                                Edit products
                            </a>
                                <a class="btn btn-danger" href="<?php  echo APP_URL; ?>admin/delete-products.php?id=<?php echo $id; ?>">
                                    Delete products
                                </a>
                                    </td>
                                </tr>
                                <?php
                        
                            }
            
                        }else{
                            echo '<tr><td colspan="6" class="text-center">No rows to display</td></tr>';
                        }
                        }
                    ?>
                
                </tbody>
            </table>
            <!-- Users Table End -->
        </div>
    </section>
    <!-- Body Section Ends -->
<?php include('common/footer.php') ?>