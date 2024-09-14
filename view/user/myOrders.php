
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../layout/pagenation.style.css">
    <!-- <link rel="stylesheet" href="myOrders.style.css">     -->
    <link rel="stylesheet" href="../insertOrder.style.css">


</head>
    

<body>

<?php


error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require("../layout/userHeader.php");

if(empty($_SESSION['email'])){
    header("Location: ../login.php");

    // echo "you should login";
    // echo "<a href='login.php'> login</a>";

}

else{


    if($_SESSION['Role'] == "Admin" ){

        echo "admin";
    }

    else{

        $email=$_SESSION['email'];
        $User_ID=$_SESSION['User_ID'];
        $Role=$_SESSION['Role'];


        ### select all orders of login user 
        require("../../module/DBconection.php");
        $DB = new db();
        $result = $DB->get_data('Orders'," User_ID='$User_ID' ");
        // var_dump($result);


        ### (pagenation) get number of orders for pagenation
        $nr_of_rows = $DB->get_count_data('Orders'," User_ID='$User_ID' ");
        // echo $nr_of_rows;


        ### (pagenation) variable of pagenation
        $rows_per_page = 3;
        $pages = ceil($nr_of_rows / $rows_per_page);
        $start = 0;


        ### (pagenation) If the user clicks on the pagination buttons.
        if(isset($_GET['page-nr'])){
            $page = $_GET['page-nr'] - 1;
            $start = $page * $rows_per_page;
        }



        ### get the orders of one page
        $result = $DB->get_data('Orders'," User_ID='$User_ID' LIMIT $start, $rows_per_page");


    }

?>


<h1 class="myOrder"  >My Orders</h1>

<div class="contan">
<table>

    <tr>
        <th>Order Date</td>
        <th>Status</td>
        <th>Amount</th>
        <th>Action</th>
    </tr>



<?php      
    foreach($result as $row)
    {   
 ?>
        <tr >
            <td style="position: relative ;"><?php echo $row["Order_Date"];
            
            if(isset($_GET['order-id'])) {

                    if($row["Order_ID"]== $_GET['order-id']) {

                        ?> <a class="show-details-user active" href="?page-nr=<?php echo $_GET['page-nr']?>&order-id=<?php echo $row["Order_ID"] ?>">show details</a> <?php
                    }else{
                        ?> <a class="show-details-user" href="?page-nr=<?php echo $_GET['page-nr']?>&order-id=<?php echo $row["Order_ID"] ?>">show details</a> <?php
                    }
                }
                else{
                    ?> <a class="show-details-user" href="?page-nr=<?php echo $_GET['page-nr']?>&order-id=<?php echo $row["Order_ID"] ?>">show details</a> <?php
                }
                ?>
                
            </td>
            <td><?php echo $row["Status"]; ?></td>
            <td><?php echo $row["Total_Amount"]; ?></td>
            <td><?php if($row["Status"]=="processing") { ?> <a class="lll" href="../../controller/cancelOrder.php?order-id=<?php echo $row["Order_ID"] ?>">Cancel</a> <?php }?></td>
            
        <tr>

<?php
    
    } 
?> 
        
</table>
</div>

<div class="contan">
<div class="box" >

<?php
if(isset($_GET['order-id'])) {
        $DB = new db();
        $query= "select Picture, Order_Details.Quantity  from Products,Order_Details where Order_Details.Order_ID = ? and Products.Product_ID= Order_Details.Product_ID";
        $stmt=$DB->get_connection()->prepare($query);

        $stmt->execute([$_GET['order-id']]);
        // $stmt->execute();
        $result2=$stmt->fetchAll();
        // var_dump($result2);

        foreach($result2 as $row)
        {
            $img=$row["Picture"];
            $Quantity=$row["Quantity"]

            ?>
                <div style="width:20%;">
                    <img src="<?php echo $img; ?> " alt="<?php echo $img; ?> " style="width:200px;height:200px;margin:20px;border-radius: 10%;">
                    <span><?php echo $Quantity; ?> </span>
                </div>
            <?php

        } 
    }
        
?>

</div>
</div>

<?php

### calculat the total amount of user

$result = $DB->get_data('Orders'," User_ID='$User_ID' and Status ='Done' ");
$total =0;
foreach($result as $row){
$total=$total+$row["Total_Amount"]; 

}

?>


<div class="contan">
    <h3>Total Done Orders = <?php echo $total?></h3>
</div>


<div class="contan">

<?php 

require("../layout/pagenation.php");
} 

?>

</div>


</body>









