<?php

$loginError=NULL;
$formemail=NULL;
$formPass=NULL;
//build a function to validate data
function validateFormData($formData){
    $formData=trim(stripslashes(htmlspecialchars($formData)));
    return $formData;
}

if (isset($_POST['login'])){
    
    
    //create variables
    $formEmail=validateFormData($_POST['post_email']);
    $formpass=validateFormData($_POST['post_password']);
    
    //connect to database
    include('connection.php');

    //create sql query
    $query="SELECT username,password FROM users Where email='$formEmail'";
    //store the result
    $result=mysqli_query($conn,$query);

    //verify if result is returned
    if (mysqli_num_rows($result)>0){
        //store basic user data in variable
        while($row=mysqli_fetch_assoc($result)){
            
            $user=$row['username'];
            $hashedPass=$row['password'];
        }
        //verify hashed password with typed password
        
        // echo $hashedPass;
        if(password_verify($formpass,$hashedPass)){
            //correct login details!
            //start the session
            echo $formpass;
            session_start();
            $_SESSION['loggedInUser']=$user;
            header("Location: profile.php");
        }else{
            $loginError="<div class='alert alert-danger'>Wrong Email / Password Combination. Try Again.</div>";
        }
    }else{// there is no result in datatbase
        $loginError="<div class='alert alert-warning alert-dismissible fade show' role='alert'>No such user in database.Please try Again. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

    }
mysqli_close($conn);
}

?>