<?php
// Include the database connection file
require("../layout/adminHeader.php");
require("../../module/DBconection.php");
$DB = new db();

// Get the product ID from the URL
$productId = $_GET['id'];

// Fetch the product data
$sql = "SELECT * FROM Products WHERE Product_ID = :id";
$stmt = $DB->get_connection()->prepare($sql);
$stmt->bindParam(':id', $productId);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission (if the edit form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update product data
    $updatedName = $_POST['name'];
    $updatedCategory = $_POST['category'];
    $updatedPrice = $_POST['price'];
    $updatedStatus = $_POST['status'];

    // Image handling
    $targetDir = "../../uploads/"; // Assuming uploads folder is in the htdocs directory
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = ['jpg', 'png', 'jpeg', 'gif']; // Allowed image file types

    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        // Validate file type
        if (in_array($fileType, $allowTypes)) {
            // Check if image file is uploaded without errors
            if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                // Upload image
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    echo "Image uploaded successfully.";

                    // Update the database with the new image path
                    $updateSql = "UPDATE Products SET Name = :name, Category = :category, Price = :price, Status = :status, Picture = :image WHERE Product_ID = :id";
                    $updateStmt = $DB->get_connection()->prepare($updateSql);
                    $updateStmt->bindParam(':name', $updatedName);
                    $updateStmt->bindParam(':category', $updatedCategory);
                    $updateStmt->bindParam(':price', $updatedPrice);
                    $updateStmt->bindParam(':status', $updatedStatus);
                    $updateStmt->bindParam(':image', $targetFilePath); // Bind the image file name
                    $updateStmt->bindParam(':id', $productId);

                    if ($updateStmt->execute()) {
                        // Redirect back to the index page
                        header('Location: allProduct.php');
                        exit();
                    } else {
                        // Handle update failure
                        echo 'Error updating product.';
                    }
                } else {
                    echo "Sorry, there was an error uploading your image.";
                }
            } else {
                echo "Sorry, there was an error uploading your image.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        // If no image is uploaded, use the existing image path from the database (if available)
        $fileName = $product['Picture'];
    }

    // ... rest of the code remains the same
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/product.style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Product</h1>

        <form method="post" action="" enctype="multipart/form-data" class="p-4 bg-light rounded shadow-sm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['Name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($product['Category']); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="available" <?php if ($product['Status'] === 'available') echo 'selected'; ?>>Available</option>
                    <option value="unavailable" <?php if ($product['Status'] === 'unavailable') echo 'selected'; ?>>Unavailable</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <?php if (!empty($product['Product_Image'])): // Display existing image if available ?>
                <div class="form-group">
                    <label for="current_image">Current Image:</label>
                    <img src="<?php echo $targetDir . $product['Product_Image']; ?>" alt="Product Image" class="img-fluid">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-custom btn-block mt-4">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>