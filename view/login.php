
<?php
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', '1');



if(empty($_SESSION['email'])){ 

?>





<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>login</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'><link rel="stylesheet" href="./login.style.css">

</head>


<body>
<!-- partial:index.partial.html -->

<form method= "POST">

  <div class="screen-1">

    <div class="Logo">
      <span> CAFETERIA </span>
    </div>


    <div class="email">
      <label for="email">Email Address</label>
      <div class="sec-2">
        <ion-icon name="mail-outline"></ion-icon>
        <input type="email" name="email" placeholder="Enter Your Email"/>
      </div>
    </div>


    <div class="password">
      <label for="password">Password</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input class="pas" type="password" name="password" placeholder="Enter The Password"/>
      </div>
    </div>

    <input class="login" type="submit" value='login'>

    
    <?php 
}
else {
    echo "you are login";
    echo "<a href='logout.php'>logout</a>";


    // header("Location: welcom.php");
}

if(!empty($_POST['email'])&&!empty($_POST['password'])){
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    require("../module/DBconection.php");
    $DB = new db();
    $result = $DB->get_data('Users'," Email='$email' ");
    // var_dump($result);
    // echo "it is enter condtion";


    if (count($result)>0){
      // echo "it is has data ";
    
      if ($email == $result[0]["Email"]  && $password == $result[0][ "Password"] ) {


        $_SESSION['email'] = $email;
        $_SESSION['User_ID'] = $result[0]["User_ID"];
        $_SESSION['Role'] = $result[0]["Role"];
        $_SESSION['Name'] = $result[0]["Name"];
        $_SESSION['user_image'] = $result[0]["Picture"];





        if($result[0]["Role"]=="Admin")
        {
          // echo "ss";
          // echo "<a href='logout.php'>logout</a>";
          header("Location: admin/orderByAdmain.php");

          
        }

        else{

          header("Location: user/orderByUser.php");

        }

      }
      else{
        echo "<div class='footer'><span style='  color: darkred;   font-size: 1.2em;'>Wrong username or password</span></div>";
      }
    }
    
    else{
      echo "<div class='footer'><span style='  color: darkred;   font-size: 1.2em;'>Wrong username or password</span></div>";
    }
  }
        


    ?>



</div>



</div>



</form>
<!-- partial -->
  
</body>
</html>


