<?php
session_start();
include('login_function.php');
include('connection.php');
if(!$_SESSION['loggedInUser']){
    header('Location: login.php');
}
$alertMessage=NULL;
//check for query string
if (isset($_GET['alert'])){
    //new client added
    if ($_GET['alert']=='success'){
        $alertMessage="<div class='alert alert-warning alert-dismissible fade show' role='alert'>New Database Added <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'> </button></div>";
//client Updated
    }else if ($_GET['alert']=='updatesuccess'){
        $alertMessage="<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        Client Updated
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    //client deleted
    elseif($_GET['alert']=='deleted'){
        $alertMessage="<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        Client Deleted!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }

}

// require ('p_function.php');
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
        <title>Profile Page</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- <div class="container">
            <h1>Profile Page</h1>
            <p class="lead"><?php echo "Welcome ".$_SESSION['loggedInUser'] ?></p>
            <p><a href="logout.php" class=" btn btn-danger">Log Out</a></p>
            
        </div> -->
        <nav class="navbar navbar-light bg-dark" id="nav">
    <div class="container-fluid">
    
    
    <a class="navbar-brand text-white-50 m-2 p-2" href="" id='navtext'>
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
            <h1>Client Address Book</h1><br>
            <?php echo $alertMessage; ?>
<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Notes</th>
        <th>Edit</th>
    </tr>

           <?php $query="SELECT * FROM clients";
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
    echo"<tr>";
    echo "<td>".$row['name']. "</td><td>". $row['email']."</td><td>".$row['phone']."</td><td>".$row['address']."</td><td>".$row['company']."</td><td>".$row['notes']."</td>";
    echo '<td><a href="edit.php?id='. $row['id'].'"type="button" class="btn btn-primary btn-sm"><i class="bi bi-clipboard-check"></i></a></td>';
    echo "</tr>";
    }
}else{
    echo "<div class='alert alert-warning'>You have no clients!</div>";
}

mysqli_close($conn);
?>
<tr>
    <td colspan="7"><div class="text-center"><a href="add.php" type="button"
    class="btn btn-success"><i class="bi bi-clipboard-plus"></i> Add Client</a></div></td>
</tr>
</table>
        </div>
            

    </body>
</html>