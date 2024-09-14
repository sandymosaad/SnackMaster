<?php
session_start();
$username = $_SESSION['Name'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("../module/DBconection.php");

    $orderDetails = json_decode($_POST['orderDetails'], true);

    try {
        if (!$username) {
            throw new Exception("Username not set.");
        }

        // Retrieve user ID based on username
        $DB = new db();
        $stmt = $DB->get_connection()->prepare('SELECT User_ID FROM Users WHERE Name = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            throw new Exception("User not found.");
        }
        
        $userId = $user['User_ID'];

        // Insert order details 
        $stmt = $DB->get_connection()->prepare('INSERT INTO Orders (User_ID, Note, Total_Amount,Status) VALUES (?, ?, ?,"processing")');
        $stmt->execute([$userId, $orderDetails['notes'], $orderDetails['totalPrice']]);

        $orderId = $DB->get_connection()->lastInsertId();

 

        // Insert order items
        $stmt = $DB->get_connection()->prepare('SELECT Product_ID FROM Products WHERE Name = ?');
        // $stmt->execute([$username]);
        // $user = $stmt->fetch(PDO::FETCH_ASSOC);


        
        foreach ($orderDetails['items'] as $item) {
            $stmt->execute([$item['name']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $productId = $product['Product_ID'];
                $insertStmt = $DB->get_connection()->prepare('INSERT INTO Order_Details (Order_ID, Product_ID, Quantity) VALUES (?, ?, ?)');
                $insertStmt->execute([$orderId, $productId, $item['quantity']]);




            } else {
                throw new Exception("Product not found: " . $item['name']);
            }
        }

        if($_SESSION['Role']=="Admin"){
            header("Location: ../view/admin/allOrders.php?page-nr=1");
        }
        else{
            header("Location: ../view/user/myOrders.php?page-nr=1");
        }
       
        


        echo '<style>
        body {
            background-color: #f7f2e7;
        }
    </style>';
echo '<div style="font-size: 24px; color: #6f4e37; background:#f7f2e7; text-align: center; margin-top: 20px;">
        Order confirmed!
      </div>';

} catch (\PDOException $e) {
echo "<div style='color: red;'>Order failed: " . $e->getMessage() . "</div>";
}
}
?>