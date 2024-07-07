<?php include('partials-front/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Orders</h1>
        <br><br>
        <form action="" method="POST">
            <table style="width:50%">
                <tr style="padding: 50px">
                    <td>Contact Number</td>
                    <td><input type="text" name="customer_contact" placeholder="contact number"></td>
                </tr>
                <tr>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Fetch Orders" class="btn-secondary">
                    </td>
                <tr>
            </table>
        </form><br><br>
        <?php
            if(isset($_SESSION['cancel']))
            {
                echo $_SESSION['cancel'];
                unset($_SESSION['cancel']);
            }
            if(isset($_SESSION['not-cancel']))
            {
                echo $_SESSION['not-cancel'];
                unset($_SESSION['not-cancel']);
            }
        ?>
        <br><br><br>
        <?php
            if(isset($_POST['submit']))
            {
                $contact=$_POST['customer_contact'];
                ?>
                <table style="width: 100%" border="2">
                    <tr align="left">
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order_date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $sql="SELECT * FROM tbl_order WHERE customer_contact='$contact'";
                        $res=mysqli_query($conn, $sql);
                        $count=mysqli_num_rows($res);
                        $sn=1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $food=$row['food'];
                                $price=$row['price'];
                                $qty=$row['qty'];
                                $total=$row['total'];
                                $date=$row['order_date'];
                                $status=$row['status'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td>
                                            <?php
                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>
                                        <td><a href="<?php echo SITEURL; ?>front/cancel.php?id=<?php echo $id; ?>" class="btn-secondary">Cancel</a></td>
                                    </tr>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <tr>
                                <td colspan="6"><div class="error">No Food ordered</div></td>

                            </tr>
                            <?php
                        }
                      ?>  
                </table>
                <?php
            }
        ?>

    </div>
</div>
<?php include('partials-front/footer.php'); ?>