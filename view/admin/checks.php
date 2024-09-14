<?php
// Connect to the database using PDO

session_start();

include ("../layout/adminHeader.php");


require("../../module/DBconection.php");

$DB = new db();



try {
    $conn = $DB->get_connection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $users = [];
    $stmt = $conn->query("SELECT User_ID, Name FROM Users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $users[] = $row;
    }

    $selectedUser = isset($_GET['user']) ? $_GET['user'] : '';
    $dateFrom = isset($_GET['date_from']) ? $_GET['date_from'] : '';
    $dateTo = isset($_GET['date_to']) ? $_GET['date_to'] : '';

    $orders = [];
    if ($selectedUser && $dateFrom && $dateTo) {
        $stmt = $conn->prepare("SELECT Order_Date, Total_Amount FROM Orders WHERE User_ID = ? AND Order_Date BETWEEN ? AND ?");
        $stmt->execute([$selectedUser, $dateFrom, $dateTo]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orders[] = $row;
        }
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../insertOrder.style.css">


    <title>Checks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f2e7;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color:#fff3cd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #6f4e37;;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color:  #ac8971;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
        }

        tr:hover {
            background-color: #fff3cd;
        }

        tr:last-child td {
            border-bottom: none;
        }

        strong {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Checks</h1>
    <form method="GET" action="">
        <label for="date_from">Date from:</label>
        <input type="date" id="date_from" name="date_from" value="<?php echo $dateFrom; ?>" required>

        <label for="date_to">Date to:</label>
        <input type="date" id="date_to" name="date_to" value="<?php echo $dateTo; ?>" required>

        <label for="user">User:</label>
        <select id="user" name="user" required>
            <option value="">Select User</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['User_ID']; ?>" <?php if ($user['User_ID'] == $selectedUser) echo 'selected'; ?>>
                    <?php echo $user['Name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Check</button>
    </form>

    <?php if ($orders): ?>
        <h2>Order Summary</h2>
        <table>
            <tr>
                <th>Order Date</th>
                <th>Amount</th>
            </tr>
            <?php
            $totalAmount = 0;
            foreach ($orders as $order): 
                $totalAmount += $order['Total_Amount'];
            ?>
                <tr>
                    <td><?php echo $order['Order_Date']; ?></td>
                    <td><?php echo $order['Total_Amount']; ?> EGP</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><strong>Total Amount</strong></td>
                <td><strong><?php echo $totalAmount; ?> EGP</strong></td>
            </tr>
        </table>
    <?php endif; ?>
</body>
</html>
