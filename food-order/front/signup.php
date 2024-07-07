<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
        <style>
            
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>

    <body >
        <div class="login" >
            <br>
            <h1 class="text-center">Sign Up</h1>
            <br>

            <?php
                if(isset($_SESSION['add']))//checking whether session is set or not 
                {
                    echo $_SESSION['add'];//displaying session message  if set
                    unset($_SESSION['add']);//removing session message
                }
            
            ?>
            <br>
            <!-- login form starts here-->
            <form action="" method="POST" >
                <table style="width:50%" border="1" align="center">
                    <tr>
                        <td>Full_name:</td>
                        <td><input type="text" name="full_name" placeholder="Full Name"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" placeholder="Email Id"></td>
                    </tr>
                    <tr>
                        <td>Phone_Number:   </td>
                        <td><input type="text" name="phone" placeholder="Phone number"></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Username"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center"><input type="submit" name="submit" value="Signup" class="btn-primary"></td>
                    </tr>
                </table>
            </form>
            <!-- login form Ends here-->

            <br><br>
            <p class="text-center">Created By- <a href="">VISVODAYANS</a></p>
        </div>
    </body>
</html>
<?php
    //process the value from form and save it in database

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Button clicked 
        //echo "Button clicked";
        //get the data from form
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //SQL query to insert data
        $sql = "INSERT INTO tbl_login SET 
            l_full_name='$full_name',
            l_email='$email',
            phone_number='$phone_number', 
            l_username='$username', 
            l_password='$password'
        ";
        //executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        //check whether the (query is executed) data is inserted or not
        if($res==TRUE)
        {
            //echo "Data inserted";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Registered Successfully</div>";
            //Redirect page
            header("location:".SITEURL.'front/login.php');
        }
        else{
            //echo "Failed to insert data";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to register</div>";
            //Redirect page
            header("location:".SITEURL.'front/signup.php');
        }
    }
?>