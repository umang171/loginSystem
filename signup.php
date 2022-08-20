<?php
$insert=false;
$error=false;

require 'partials/_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $existSql="SELECT * FROM `users` WHERE `username`='$username'";
    $result=mysqli_query($conn,$existSql);
    $numrows=mysqli_num_rows($result);
    if ($numrows>0) {
        $error="Username already exists";
    }
    else {
        if($password==$cpassword)
        {
            $password=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$password')";
            $result=mysqli_query($conn,$sql);
            if($result){
                // echo 'Record inserted';
                $insert=true;
            }
            // else{
            //     echo 'Not inserted';
            // }
        }
        else{
            $error="Please enter same password in confirm password field";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>sign up</title>
</head>

<body>
    <?php
    require 'partials/_nav.php';
    ?>
    <?php
    if ($insert) {   
        echo '<div class="alert alert-success alert-dismissible fade show" style="margin-bottom:0px" role="alert">
        <strong>Success!</strong> Your account has been successfully created.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($error){
        echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-bottom:0px" role="alert">
        <strong>Sorry!</strong> '.$error.'.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <div class="container">
        <h1 class="text-center my-3">Sign up</h1>
        <form method="post" action="signup.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="11" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="11" class="form-control" id="cpassword" name="cpassword">
                <div class="form-text">Please enter same password in confirm password</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>