<?php
    include('../config/constants.php');
    //check whether th id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //GET the value and delete
        $id = $_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the physical image file is available
        if($image_name!="")
        {
            //image is available so remove it
            $path="../images/category/".$image_name;
            //remove image
            $remove=unlink($path);

            if($remove==false)
            {
                //set the session message 
                $_SESSION['remove']="<div class='error'>Failed to remove category image </div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //delete data from database
        $sql="DELETE FROM tbl_category WHERE id=$id";
        $res=mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Category deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['delete']="<div class='error'>Failed to delete category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category page

    }
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>