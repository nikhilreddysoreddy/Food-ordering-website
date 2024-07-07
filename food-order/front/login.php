<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body style="background-color:powderblue;">
        <div class="login" style="background-color:white;" >
            <br>
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!-- login form starts here-->
            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
                <a href="signup.php"><button type=button class="btn-primary">Signup</button></a><br><br>
            </form>
            <!-- login form Ends here-->


            <p class="text-center">Created By- <a href="">VISVODAYANS</a></p>
        </div>
    </body>
</html>
<?php
    //check whether submit clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //1.get the data from login form
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        //2.query to check whether the user with username and password exist or not
        $sql="SELECT * FROM tbl_login WHERE l_username='$username' AND l_password='$password'";
        //3.EXECUTE QUERY
        $res=mysqli_query($conn, $sql);
        //4.count rows to check whether th user exist or not
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //user avilable and login success
            $_SESSION['login']="<div class='success'>Login successful</div>";

            $_SESSION['user']=$username;//to check whether user is logged in or not logout  will unset it
            //redirect to homepage/dashboard
            header('location:'.SITEURL.'front/');
        }
        else
        {
            //user not available and login fail
            $_SESSION['login']="<div class='error text-center' >Username or Password did not match</div>";
            //redirect to homepage/dashboard
            header('location:'.SITEURL.'front/login.php');
        }
    }
?>