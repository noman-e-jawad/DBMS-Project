<?php
$success=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';

    $employeeID=$_POST['employeeID'];
    $password=$_POST['password'];

    $sql="SELECT*from employee_t where employeeID='$employeeID'";
    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
            $user=1;
        }
        else{
            $sql="insert into employee_t (employeeID,password)
             values('$employeeID','$password')";
            $result=mysqli_query($con,$sql);
            if($result){
                $success=1;
            }
            else{
                die(mysqli_error($con));
            }
        }
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Signup page</title>
  </head>
  <body>

<?php
if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Oh no</strong> User already exists!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>

<?php
if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> You are successfully signed up!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>


<h3 class="text-center"> Sign up page </h3>
    <div class="container mt-5">
    <form action="signup.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Employee ID</label>
    <input type="text" class="form-control" placeholder="Enter Employee ID" name="employeeID">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" placeholder="Enter Password" name="password">
  </div>
  <button type="submit" class="btn btn-primary w-100">Sign Up</button>

</form>

    </div>

  </body>
</html>