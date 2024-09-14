
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../layout/pagenation.style.css">
    <!-- <link rel="stylesheet" href="allOrders.style.css">     -->
    <link rel="stylesheet" href="../insertOrder.style.css">


</head>
    

<body>

<?php


error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require("../layout/adminHeader.php");

if(empty($_SESSION['email'])){
    header("Location: ../login.php");

    // echo "you should login";
    // echo "<a href='login.php'> login</a>";

}

else{


    if($_SESSION['Role'] == "User" ){

        echo "User";
    }

    else{

        $email=$_SESSION['email'];
        $User_ID=$_SESSION['User_ID'];
        $Role=$_SESSION['Role'];


        ### select all orders of login user 
        require("../../module/DBconection.php");
        $DB = new db();
        $result = $DB->get_data_col('Orders.Order_ID , Orders.Total_Amount , Orders.Order_Date , Users.Name , Users.Room_Number , Orders.Status ','Orders,Users',' Orders.User_ID = Users.User_id ');
        
        // $result = $DB->get_data('Orders'," Orders.User_ID = 2");
        
        // var_dump($result);


        ### (pagenation) get number of orders for pagenation
        $nr_of_rows = $DB->get_count_data_col('Orders.Order_ID , Orders.Total_Amount , Orders.Order_Date , Users.Name , Users.Room_Number , Orders.Status ','Orders,Users',' Orders.User_ID = Users.User_id ');
        
        // $nr_of_rows = $DB->get_count_data('Orders'," Orders.User_ID = 2");
        // echo $nr_of_rows;


        ### (pagenation) variable of pagenation
        $rows_per_page = 2;
        $pages = ceil($nr_of_rows / $rows_per_page);
        $start = 0;


        ### (pagenation) If the user clicks on the pagination buttons.
        if(isset($_GET['page-nr'])){
            $page = $_GET['page-nr'] - 1;
            $start = $page * $rows_per_page;
        }



        ### get the orders of one page
        $result = $DB->get_data_col('Orders.Order_ID , Orders.Total_Amount , Orders.Order_Date , Users.Name , Users.Room_Number , Orders.Status ','Orders,Users'," Orders.User_ID = Users.User_id  LIMIT $start, $rows_per_page");
        // $result = $DB->get_data('Orders'," Orders.User_ID = 2 LIMIT $start, $rows_per_page");
        // var_dump($result);


    }

?>


<h1 class="myOrder"  >Orders</h1>



<div class="contan">

<?php      
    foreach($result as $row)
    {  ### calculat the total amount of user
        $total =$row["Total_Amount"]; 
 ?>
<table>

    <tr>
        <th>Order Date</td>
        <th>Name</td>
        <th>Room</th>
        <th>Status</th>
    </tr>




        <tr >
            <td><?php echo $row["Order_Date"];?></td>
            <td><?php echo $row["Name"]; ?></td>
            <td><?php echo $row["Room_Number"]; ?></td>
            <td><?php echo $row["Status"]?></td>
            
        <tr>

<?php
    
    
?> 
        
</table>
</div>

<div class="contan">
<div class="box" >

<?php

        $DB = new db();
        $query= "select Picture, Order_Details.Quantity  from Products,Order_Details where Order_Details.Order_ID = ? and Products.Product_ID= Order_Details.Product_ID";
        $stmt=$DB->get_connection()->prepare($query);
        $stmt->execute([$row['Order_ID']]);
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
    


        
?>

</div>
</div>

<?php





?>


<div class="contan">
    <h4>Total Done Orders = <?php echo $total?></h4>
</div>


<div class="contan">

<?php 
    }

require("../layout/pagenation.php");

} 
?>

</div>


</body>






