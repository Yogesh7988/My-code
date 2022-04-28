<?php
// require 'login_function.php';
include('login_function.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            #nav{
                margin: 0;
                padding: 0;
            }
            
            </style>
        <title>Login</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
    
    <nav class="navbar navbar-light bg-dark" id="nav">
    <div class="container-fluid">
    
    
    <a class="navbar-brand text-white-50 m-2 p-2" href="login.php" id='navtext'>
    <img src="address-book.jpg" alt="" width="50" height="50" class="d-inline-block ">
    CLIENT MANAGER
    </a>
  </div>
</nav><br><br>
        <div class="container">
            <h1>Client Address Book</h1>
            <p class=" text-muted h4">Log in to your account.</p>
            <?php echo $loginError; ?>
        <!-- <?php if ($_POST['post_email']) {echo $formEmail.' Is incorrect';} ?> -->
        <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="row">
            <div class="col-4">
              <Label for="login-email" class="sr-only"></Label><br>
              <input class="form-control" id="login-email"type="text" placeholder="Email" name ="post_email" value="<?php $formEmail; ?>">
              </div>
              <div class="col-4">
              <Label for="login-pass" class="sr-only"></Label>
              <input class="form-control" id ="login-pass"type="text" placeholder="Password" name ="post_password">
              </div>
            </div>
              <br>
              <input class="btn btn-primary" type="submit" name="login" value="Login">
              

            </form>
            
        
           <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
    </body>
</html>