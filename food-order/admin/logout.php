<?php
    //include constants.php for SITEURL
    include('../config/constants.php');
    //1.destroy session 
    session_destroy();//unsets $_session['user']
    //2.redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>