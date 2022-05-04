<?php

session_start();
if(!$_SESSION['loggedInUser']){
    header('Location: login.php');
}
//get id
$clientID=$_GET['id'];
$alertMessage=NULL;
//include function file
include('login_function.php');
//include connection file
include('connection.php');

//query the database with client id
$query="SELECT * FROM clients WHERE id='$clientID'";
$result=mysqli_query($conn,$query);

// if result is returned
if(mysqli_num_rows($result)>0){
    //we have data
    // set some variables
    while($row=mysqli_fetch_assoc($result)){
        $clientName=$row['name'];
        $clientEmail=$row['email'];
        $clientPhone=$row['phone'];
        $clientAddress=$row['address'];
        $clientCompany=$row['company'];
        $clientNotes=$row['notes'];
    }
}else{
    $alertMessage="<div class='alert alert-warning'>Nothinf to see here. <a href ='profile.php'>Head Back</a></div>";
}
//if update button was submitted
if(isset($_POST['update'])){
    echo $clientID;
    // $clientID=$_GET['id'];
    //set variables
    $clientName=validateFormData($_POST["clientName"]);
    $clientEmail=validateFormData($_POST["clientEmail"]);
    $clientPhone=validateFormData($_POST["clientPhone"]);
    $clientAddress=validateFormData($_POST["clientAddress"]);
    $clientCompany=validateFormData($_POST["clientCompany"]);
    $clientNotes=validateFormData($_POST["clientNotes"]);

    
    //new databse query and result
    $query="UPDATE clients SET name='$clientName',email='$clientEmail',phone='$clientPhone',address='$clientAddress',company='$clientCompany',notes='$clientNotes' WHERE id='$clientID'"
    ;
    $result=mysqli_query($conn,$query);
    if ($result){
        //redirect to profile
        header("Location: profile.php?alert=updatesuccess");
        
        // echo $clientID;
    }else{
        echo "Error updating record: ".mysqli_error($conn);
    }

}
// if delete button was submitted
if (isset($_POST['delete'])){
    $alertMessage="<div class='alert alert-danger'>
    <p>Are you sure you want to delete this client? No take backs!</p><br>
    <form action='".htmlspecialchars($_SERVER['PHP_SELF']) ."?id=$clientID' method='post'>
    <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete!'>
    <button class='btn btn-light btn-sm' value='Oops, no thanks!'>Oops, no thanks!</button>
    </form>
    </div>";
}
// if confirm delete button was submitted
if (isset($_POST['confirm-delete'])){
    $query="DELETE FROM clients WHERE id='$clientID'";
    $result=mysqli_query($conn,$query);

    if ($result){
        // redirect to profile 
        header("Location:profile.php?alert=deleted");
    }else{
        echo "Error updating record: ".mysqli_error($conn);
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
            
            </style>
        <title>Edit</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
    
    <nav class="navbar navbar-light bg-dark" id="nav">
    <div class="container-fluid">
    
    
    <a class="navbar-brand text-white m-2 p-2" href="" id='navtext'>
    <img src="address-book.jpg" alt="" width="50" height="50" class="d-inline-block ">
    CLIENT MANAGER
    </a>
    <a class="navbar-brand text-white-50 m-2 p-2" href="profile.php" id=''>My Clients</a>
    <a class="navbar-brand text-white-50 m-2 p-2" href="add.php" id=''>Add Client</a>
    <a class="navbar-brand text-white-50 m-2 p-2" href="" id=''><?php echo 'Welcome '.$_SESSION['loggedInUser'].' !' ?></a>
    <a class="navbar-brand text-white-50 m-2 p-2" href="logout.php" id=''>Logout</a>
  </div>
</nav><br><br>

<div class="container">
            <h1>Edit Client</h1><br>
            <?php echo $alertMessage; ?>
            <hr>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $clientID; ?>" method="post" class="row">


<div class="form_group col-sm-6" >
<label for="client-name">Name *</label>
<input type="text" class="form-control input-lg" id="client-name"
name="clientName" value="<?php echo $clientName; ?>">
</div>

<div class="form_group col-sm-6" >
<label for="client-email">Email *</label>
<input type="email" class="form-control input-lg" id="client-email"
name="clientEmail" value="<?php echo $clientEmail; ?>">
</div>

<div class="form_group col-sm-6" >
<label for="client-phone">Phone</label>
<input type="text" class="form-control input-lg" id="client-phone"
name="clientPhone" value="<?php echo $clientPhone; ?>">
</div>

<div class="form_group col-sm-6" >
<label for="client-address">Address</label>
<input type="text" class="form-control input-lg" id="client-address"
name="clientAddress" value="<?php echo $clientAddress; ?>">
</div>

<div class="form_group col-sm-6" >
<label for="client-company">Company</label>
<input type="text" class="form-control input-lg" id="client-company"
name="clientCompany" value="<?php echo $clientCompany; ?>">
</div>

<div class="form_group col-sm-6" >
<label for="client-notes">Notes</label>
<textarea type="text" class="form-control input-lg" id="client-notes"
name="clientNotes"><?php echo $clientNotes; ?></textarea><br>
</div>

<div class="form_group col-sm-12 text-center" >
    <hr>
    <button type="submit" id="add_button" class="btn  btn-lg btn-danger" name="delete">Delete</button>
<a href="profile.php" type="button" class="btn btn-lg btn btn-secondary ">Cancel</a>
<button type="submit" id="add_button" class="btn  btn-lg btn-success " name="update">Update</button>
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