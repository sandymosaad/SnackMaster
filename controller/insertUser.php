<?php


try {



    $DB = new db();
    $sql = 'INSERT INTO Users (Name, Email, Password, Room_Number,  Picture, Role ) VALUES (?, ?, ?, ?, ?, ? )';
    $stmt = $DB->get_connection()->prepare($sql);
    // var_dump($stmt);
    $stmt->execute([
        $_POST['Name'], 
        $_POST['Email'],
        $_POST['Password'],
        // password_hash($_POST['Password'], PASSWORD_DEFAULT),
        $_POST['Room_Number'],
        $targetFile,
        $_POST['Role']
        
    ]);

   
    $result = $stmt->rowCount();
    
    $id = $DB->get_connection()->lastInsertId();



    header("Location: allUser.php");     

    echo '======= Rows affected: ' . $result . ', Last Insert ID: ' . $id;

    echo "aaa";

} catch (PDOException $e) {
   
    echo 'Connection failed: ' . $e->getMessage();
}

?>
