<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>


        <form action="" method="POST">
            <table style="width:50%">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php
                
    //to check whether sbmit button clicked or not
    if(isset($_POST['submit']))
    {
        //1.get the data from the form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);


        //2.check whether the user current id and current password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //execute query
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //user exist and password can be changed
                //check whether new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //update password
                    $sql2="UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id";
                    //execute query
                    $res2=mysqli_query($conn, $sql2);
                    //check whether query executed or not
                    if($res2==true)
                    {
                        //display message
                        $_SESSION['change-pwd']="<div class='success'>password changed successfully</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        //display error message
                        $_SESSION['change-pwd']="<div class='error'>Failed to change password </div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //user does not exist
                    $_SESSION['pwd-not-match']="<div class='error'>password did not match</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
            }
            else
            {
                //user does not exist
                $_SESSION['user-not-found']="<div class='error'>User not found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        //3.check whether the new password and confirm password match or not
        //4.change password if all above is true
    }
?>
<?php include('partials/footer.php'); ?>