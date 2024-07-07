<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add']))//checking whether session is set or not 
            {
                echo $_SESSION['add'];//displaying session message  if set
                unset($_SESSION['add']);//removing session message
            }
        
        ?>

        <form action="" method="POST">
            <table style="width:50%">
                <tr>
                    <td>FullName:    </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username:    </td>
                    <td><input type="text" name="username" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password:    </td>
                    <td><input type="password" name="password" placeholder="Your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php
    //process the value from form and save it in database

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Button clicked 
        //echo "Button clicked";
        //get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //SQL query to insert data
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name', 
            username='$username', 
            password='$password'
        ";
        //executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        //check whether the (query is executed) data is inserted or not
        if($res==TRUE)
        {
            //echo "Data inserted";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //Redirect page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //echo "Failed to insert data";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            //Redirect page
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>