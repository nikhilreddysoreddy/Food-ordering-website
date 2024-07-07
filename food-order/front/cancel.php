<?php include('partials-front/menu.php'); ?>
<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];

        $sql="SELECT * FROM tbl_order WHERE id=$id";

        $res=mysqli_query($conn, $sql);

        $row=mysqli_fetch_assoc($res);

        $status=$row['status'];

        if($status=='Ordered' || $status=='On delivery')
        {
            $sql2="UPDATE tbl_order SET
            status='Cancelled'
            WHERE id=$id";

            $res2=mysqli_query($conn, $sql2);

            if($res2==true)
            {
                $_SESSION['cancel']="<div class='success'>Order cancelled successfully</div>";
                header('location:'.SITEURL.'front/orders.php');
            }         
        }
        else
        {
            $_SESSION['not-cancel']="<div class='error'>cannot be cancelled</div>";
            header('location:'.SITEURL.'front/orders.php');

        }

        

    }
    else
    {
        header('location:'.SITEURL.'front/orders.php');
    }

?>



