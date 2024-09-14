
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> -->
       
       
        <link rel="stylesheet" href="../insertOrder.style.css">


        
        <!-- <link rel="stylesheet" href="../css/allIUser.style.css">  -->


        <style>
            
        </style>

    </head>
    <body>
    </body>
    </html>


  

    <?php

session_start();


    
    include ("../layout/adminHeader.php");

    require("../../module/DBconection.php");

    $DB = new db();

    

    try {
        // $DB = new db();
        // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>

   
    <br>

    <table class="tabl" style="position: absolute; top: 320px; left: 110px; width:80%">
    <body>
    

    <h2 class="text-center mt-4">All Users</h2>

    <a href='register.php' style="position: relativ; top: 100px; left: 150px; width:100% " class='btn btn-custom btn-sm mb-2 mr-2'>Add User</a>

    <!-- <a href="register.php" id="addUser" class="btn btn-custom btn-sm mb-2 mr-2" >Add User</a> -->

    <table class="table table-striped mx-auto" style="width:80%">
        <thead class="table-light">
            <tr>
                <th>User_ID</th>
                <th>Name</th>
                <th>Room_Number</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $connection = $DB->get_connection();
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $dataAll = $connection->query("SELECT User_ID, Name, Room_Number, Picture FROM Users");
                $data = $dataAll->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data as $row) {
                    echo "<tr>"; 
                    foreach ($row as $key => $value) {
                        if ($key == 'Picture') {
                            $imagePath = "../../uploads/" . basename($value); 
                            echo "<td class='Htd'><img src='$imagePath' alt='Profile Picture' style='width: 50px; height: 50px;'></td>";
                        } else {
                            echo "<td class='Htd'>" . htmlspecialchars($value) . "</td>"; 
                        }
                    }
                    echo "<td class='Htd'>
                    <a href=\"EditUser.php?id={$row['User_ID']}\" class='btn btn-warning btn-sm'>Edit</a>
                    <a href=\"javascript:void(0);\" onclick=\"confirmDelete({$row['User_ID']});\" class='btn btn-danger btn-sm ml-2'>Delete</a>
                </td>";
                echo "</tr>";
                }
            } catch (PDOException $e) {
                echo 'Query failed: ' . $e->getMessage();
            }
            ?>
        </tbody>
    </table>

    <script>
        
   
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "../../controller/DeleteUser.php?id=" + userId;
            }
        }
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
