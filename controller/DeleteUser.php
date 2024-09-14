<?php
require("../module/DBconection.php");


$DB = new db();
$connection = $DB->get_connection();
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Start a transaction
        $connection->beginTransaction();

        // Delete orders related to the user
        $stmt = $connection->prepare("DELETE FROM Orders WHERE User_ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Delete the user
        $stmt = $connection->prepare("DELETE FROM Users WHERE User_ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Commit the transaction
        $connection->commit();

        // Redirect to AllUser.php
        header("Location: ../view/admin/allUser.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if something fails
        $connection->rollBack();
        echo "Error deleting record: " . $e->getMessage();
    }
} else {
    echo "ID parameter is missing.";
}
?>
