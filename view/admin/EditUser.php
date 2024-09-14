

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="../css/user.style.css"> 
        <link rel="stylesheet" href="../insertOrder.style.css">

    </head>
    <body>
    </body>
    </html>



<?php  
session_start();


require("../../module/DBconection.php");

$DB = new db();
$connection = $DB->get_connection();
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];

$stmt = $connection->prepare("SELECT * FROM Users WHERE User_ID = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$stu = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stu) {
    // include("../layout/adminHeader.php");
    ?>
    
    <form method="POST" action="../../controller/updateUser.php?id=<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="Name" value="<?php echo $stu['Name']; ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="Email" value="<?php echo $stu['Email']; ?>" required>
        
        <label for="roomNumber">Room Number:</label>
        <input type="text" id="roomNumber" name="Room_Number" value="<?php echo $stu['Room_Number']; ?>" required>
        
        <input type="submit" value="Save Changes">
    </form>
    <?php
} else {
    echo "User not found.";
}


