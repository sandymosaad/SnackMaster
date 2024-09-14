<?php
session_start();

$username = $_SESSION['Name'];
$userImage = $_SESSION['user_image']; 

require("../../module/DBconection.php");

try {
    $DB = new db();
    $stmt = $DB->get_connection()->prepare('SELECT Name FROM Users');
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erorr" . $e->getMessage();
}

$stmt2 = $DB->get_connection()->query("SELECT * FROM Products");
$drinks = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admain</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../insertOrder.style.css">
</head>

<body>

  
<?php
    require("../layout/adminHeader.php");
?>

    <div class="container search-bar">
        <input type="text" class="form-control" id="search" placeholder="Search for a drink...">
    </div><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="d-flex align-items-center justify-content-center">
                    <label for="users" class="mr-2">Add User:</label>
                    <select id="users" class="form-control mx-2" style="width: 200px;">
                        <?php
                    if (!empty($users)) {
                        foreach ($users as $user) {
                            echo '<option value="' . ($user['Name']) . '">' . ($user['Name']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No users found</option>';
                    }
                    ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 order-summary">
                <h5>Order Summary</h5>
                <div id="orderItems">
                    <!-- orderItems appear here-->
                </div>
                <div>
                    <label for="notes">Notes:</label>
                    <textarea id="notes" class="form-control" rows="3" placeholder="e.g., 1 Tea Extra Sugar"></textarea>
                </div>
                
                <div class="mt-2">
                    <h5>Total: EGP <span id="totalPrice">0</span></h5>
                </div>
                <form action="../../controller/insertOrder.php" method="POST" id="orderForm">
                    <input type="hidden" name="orderDetails" id="orderDetails">
                    <button type="submit" class="btn" style="background-color: #6f4e37; color: #fff;">Confirm</button>
                </form>


            </div>

            <!-- Right Side: Drink Selection -->
            <div class="col-md-8">
                <h5>Latest Order</h5>
                <div class="latest-order" id="latestOrder">
                    <!-- Selected drinks appear here -->
                </div>
                <hr>


                <div class="row" id="drinkList">
                    <?php foreach ($drinks as $drink): ?>
                    <div class="col-md-3 drink-item">
                        <img src="<?php echo $drink['Picture']; ?>" class="drink-img"
                            data-name="<?php echo $drink['Name']; ?>" data-price="<?php echo $drink['Price']; ?>"
                            alt="<?php echo $drink['Name']; ?>">
                        <p><?php echo $drink['Name']; ?> (<?php echo $drink['Price']; ?> LE)</p>
                    </div>
                    <?php endforeach; ?>
                </div>


       


            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../scriptOrder.js"></script>
</body>

</html>