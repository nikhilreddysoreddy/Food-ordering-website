<?php
    //Include constant.php file here
    include('../config/constants.php');
    //1.Get the id of admin to be deleted
    $id = $_GET['id'];
    //2.Create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //execute query 
    $res = mysqli_query($conn, $sql);
    //check whether query executed successfully or not
    if($res==true)
    {
        //query executed successfully and admin deleted
        //echo "Admin Deleted";
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //failed to delete admin
        //echo "failed to delete admin"
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3.Redirect to manage admin page with message(success/error)

?>