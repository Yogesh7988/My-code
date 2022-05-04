<?php
session_start();
include('login_function.php');
include('connection.php');
if(!$_SESSION['loggedInUser']){
    header('Location: login.php');
}

if (isset($_POST['add'])){
    //set all variables to empty by default
    $clientName=$clientEmail=$clientPhone=$clientAddress=$clientCompany=$clientNotes="";
    if (!$_POST["clientName"]){
        $nameError="Please enter a name<br>";
    }else{
        $clientName=validateFormData($_POST["clientName"]);
    }
    if (!$_POST["clientEmail"]){
        $emailError="Please enter a name<br>";
    }else{
        $clientEmail=validateFormData($_POST["clientEmail"]);
    }
    //these inpurs are not required
    //so we'll just store whatever has been entered
    $clientPhone=validateFormData($_POST["clientPhone"]);
    $clientAddress=validateFormData($_POST["clientAddress"]);
    $clientCompany=validateFormData($_POST["clientCompany"]);
    $clientNotes=validateFormData($_POST["clientNotes"]);

    //if requird fields have data
    if ($clientName && $clientEmail){
        $query="INSERT INTO clients (id,name,email,phone,address,company,notes,date_added)
        Values (NULL,'$clientName','$clientEmail','$clientPhone','$clientAddress','$clientCompany','$clientNotes',CURRENT_TIMESTAMP)";
        $result=mysqli_query($conn,$query);
        //if query was successful
        if($result){
            //refresh page with query string
            header("Location: profile.php?alert=success");
        }else{
            //something wet wrong
            echo "Error: ".$query."<br>".mysqli_error($conn);
        }
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            #nav{
                margin: 0;
                padding: 0;
            }
            #add_button{
                position: absolute;
  right:310px;
            }

            
            </style>
        <title>Add Client</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
    
    <nav class="navbar navbar-light bg-dark" id="nav">
    <div class="container-fluid">
    
    
    <a class="navbar-brand text-white-50 m-2 p-2" href="" id='navtext'>
    <img src="address-book.jpg" alt="" width="50" height="50" class="d-inline-block ">
    CLIENT MANAGER
    </a>
    <a class="navbar-brand text-white-50 m-2 p-2" href="profile.php" id=''>My Clients</a>
    <!-- <a class="navbar-brand text-white m-2 p-2" href="add.php" id=''>Add Client</a> -->
    <a class="navbar-brand text-white-50 m-2 p-2" href="" id=''><?php echo 'Welcome '.$_SESSION['loggedInUser'].' !' ?></a>
    <a class="navbar-brand text-white-50 m-2 p-2" href="logout.php" id=''>Logout</a>
  </div>
</nav><br><br>
        <div class="container">
            <h1>Add Client</h1>
            <br><hr>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row">


            <div class="form_group col-sm-6" >
        <label for="client-name">Name *</label>
        <input type="text" class="form-control input-lg" id="client-name"
        name="clientName" value="">
        </div>

        <div class="form_group col-sm-6" >
        <label for="client-email">Email *</label>
        <input type="email" class="form-control input-lg" id="client-email"
        name="clientEmail" value="">
        </div>

        <div class="form_group col-sm-6" >
        <label for="client-phone">Phone</label>
        <input type="text" class="form-control input-lg" id="client-phone"
        name="clientPhone" value="">
        </div>

        <div class="form_group col-sm-6" >
        <label for="client-address">Address</label>
        <input type="text" class="form-control input-lg" id="client-address"
        name="clientAddress" value="">
        </div>

        <div class="form_group col-sm-6" >
        <label for="client-company">Company</label>
        <input type="text" class="form-control input-lg" id="client-company"
        name="clientCompany" value="">
        </div>

        <div class="form_group col-sm-6" >
        <label for="client-notes">Notes</label>
        <textarea type="text" class="form-control input-lg" id="client-notes"
        name="clientNotes" value=""></textarea><br>
        </div>
        
        <div class="form_group col-sm-12 " >
            <hr>
            <a href="profile.php" type="button" class="btn btn-lg btn btn-secondary">Cancel</a>
            <button type="submit" id="add_button" class="btn  btn-lg btn-success" name="add">Add Client</button>
        </div>
        

        
    </form>
    </div>
              

   
            
        
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