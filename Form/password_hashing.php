<?php
include ('connection.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Password Hashing</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<div class="container">
            <h1>My SQL Select</h1>
        <?php
        $password=password_hash('mypassword',PASSWORD_DEFAULT);
        echo $password;

        // $hashedPassword='$2y$10$Gt4ly5Pux4R9mKy/DGR6muCW9CGP46zC/HrqCySkTY.sq9hlPCmTe';
        // if (password_verify('mypassword',$hashedPassword)){
        //     echo "Password is correct!";
        // }else{
        //     echo"Incorrect password!";
        // }

        ?>


        </div>

<body>

</html>