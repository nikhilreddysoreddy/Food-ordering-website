<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            //check whether id set or not
            if(isset($_GET['id']))
            {
                //get the id and all other details
                $id=$_GET['id'];
                $sql="SELECT * FROM tbl_category WHERE id=$id";

                $res=mysqli_query($conn, $sql);
                 
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //get all data
                    $row=mysqli_fetch_assoc($res);

                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else{
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table  >
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php 
                            if($current_image!="")
                            {
                                //display image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">Yes
                        <input <?php if($featured=="no"){echo "checked";} ?> type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes">Yes
                        <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //1.GET ALL values from form
                $id=$_POST['id'];

                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];
                

                //2.updating new image if selected
                if(isset($_FILES['image']['name']))
                {
                    $image_name=$_FILES['image']['name'];

                    if($image_name!="")
                    {
                        //auto rename our image
                        //get the extension of our image(jpg,png,gif,etc...)e.g:-food.jpg
                        $ext = end(explode('.', $image_name));
                        //rename the image
                        $image_name="food_category_".rand(000, 999).'.'.$ext;//e.g:-"food_category_565.jpg"

                        
                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //finally upload image
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //if the image is uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //set message 
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();
                        }

                        //remove current image if available
                        if($current_image!="")
                        {
                            $remove_path="../images/category/".$current_image;
                            $remove=unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['failed-remove']="<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name=$current_image;
                    }
                }
                else
                {
                    $image_name=$current_image;
                }


                //update the database
                $sql2="UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id=$id";

                
                $res2= mysqli_query($conn, $sql2);

                //redirect to manage category
                if($res2==true)
                {
                    $_SESSION['update']="<div class='success'>Category updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update']="<div class='error'>Failed to update category</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
