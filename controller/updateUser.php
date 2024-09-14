<?php

require("../module/DBconection.php");


$DB = new db();
$connection = $DB->get_connection();
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id']; 
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $room_number = $_POST['Room_Number'];

    $stmt = $connection->prepare("UPDATE Users SET Name = :name, Email = :email, Room_Number = :room_number WHERE User_ID = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':room_number', $room_number);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
     
        header("Location: ../view/admin/allUser.php"); 
        exit();
    } else {
        echo "Error updating user.";
    }
}
?>


