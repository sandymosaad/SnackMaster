<!-- <?php

//         while ($product = mysqli_fetch_assoc($result)) {
//             ?>
//             <tr>
//                 <td><?php echo $product['id']; ?></td>
//                 <td><?php echo $product['product_name']; ?></td>
//                 <td><?php echo $product['quantity']; ?></td>
//                 <td><?php echo $product['price']; ?></td>
//                 <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>"></td>
//                 <td><?php echo $product['category']; ?></td>
//                 <td>
//                     <form action="delete.php" method="POST">
//                         <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
//                         <button type="submit">Delete</button>
//                     </form>
//                 </td>
//             </tr>
//             <?php
//         }
//         ?>
//     </tbody>
// </table>

// <?php
// // Include the database connection file
// require_once 'database.php';

// // Get the product ID from the POST request
// $productId = $_POST['product_id'];

// // Delete the product
// $sql = "DELETE FROM Products WHERE Product_ID = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':id', $productId);

// if ($stmt->execute()) {
//     // Redirect back to the index page or display a success message
//     header('Location: index.php');
//     exit();
// } else {
//     // Handle deletion failure
//     echo 'Error deleting product.';
// }
// ?> -->



<?php
// Include the database connection file
// require_once 'database.php';

// // Get the product ID from the POST request
// $productId = $_POST['product_id'];

// // Delete the product
// $sql = "DELETE FROM Products WHERE Product_ID = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':id', $productId);

// if ($stmt->execute()) {
//     // Redirect back to the index page or display a success message
//     header('Location: index.php');
//     exit();
// } else {
//     // Handle deletion failure
//     echo 'Error deleting product.';
// }

// // Assuming you have a loop to iterate through your products
// $sql = "SELECT * FROM Products";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// if (count($result) > 0) {
//     while ($product = mysqli_fetch_assoc($result)) {
//         // ... your table row content here ...
//     }
// } else {
//     echo "No products found.";
// }


// // Check if the product is referenced by other tables
// $checkReferencesSql = "SELECT COUNT(*) FROM order_details WHERE Product_ID = :id";
// $checkReferencesStmt = $pdo->prepare($checkReferencesSql);
// $checkReferencesStmt->bindParam(':id', $productId);
// $checkReferencesStmt->execute();
// $referencesCount = $checkReferencesStmt->fetchColumn();

// if ($referencesCount > 0) {
//     // Product is referenced by other tables, prevent deletion
//     echo "Cannot delete product. It is referenced by other tables.";
// } else {
//     // Delete the product
//     $sql = "DELETE FROM Products WHERE Product_ID = :id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':id', $productId);
//     $stmt->execute();
// }
?>



<?php
// Include the database connection file
require("../module/DBconection.php");
$DB = new db();


// Get the product ID from the POST request
$productId = $_POST['product_id'];

// Delete the product
$sql = "DELETE FROM Products WHERE Product_ID = :id";
$stmt = $DB->get_connection()->prepare($sql);
$stmt->bindParam(':id', $productId);

if ($stmt->execute()) {
    // Redirect back to the index page or display a success message
    header('Location: ../view/admin/allProduct.php');
    exit();
} else {
    // Handle deletion failure
    echo 'Error deleting product.';
}
?>