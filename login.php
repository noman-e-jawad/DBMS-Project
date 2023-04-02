<?php

$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  include 'connect.php';

  $userType = $_POST['userType'];
  $ID = $_POST['ID'];
  $password = $_POST['password'];

  if ($userType != 'student') {
    $sql = "SELECT * from employee_t where employeeID='$ID' and password='$password'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        $invalid = 0;
        session_start();
        $_SESSION['ID'] = $ID;
        header('location:employee_dashboard.php');
      }
    }
  } elseif ($userType == 'student') {
    $sql = "SELECT * from student_t where studentID='$ID' and password='$password'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        $invalid = 0;
        session_start();
        $_SESSION['ID'] = $ID;
        header('location:employee_dashboard.php');
      }
    }
  } else {
    $invalid = 1;
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <title>Login page</title>

  <style>
    body {
      background-image: url('LOGO.png');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 15%;
      background-position: top;
    }

    .mainContainer {
      margin-top: 15%;
      width: 30%;
    }

    .ID {
      font-size: 30px;
      border-radius: 10px;
      border: none;
      text-align: center;
      width: 100%;
    }

    .ID:active {
      opacity: 0.5;
    }

    .ID:focus-visible {
      outline: none;
    }

    .submitButton {
      height: 46px;
      width: 200px;
      display: inline-block;
      border-radius: 10px;
      border: none;
      outline: none;
      background: #20A4F3;
      font-size: 22px;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      font-weight: bold;
      margin-left: 35%;
      margin-top: 15px;
      color: #E8E9F3
    }

    .submitButton:active {
      opacity: 0.5;
    }

    .selectNew {
      height: 46px;
      width: 100%;
      display: inline-block;
      border-radius: 10px;
      border: none;
      outline: none;
      background: #20A4F3;
      font-size: 22px;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      font-weight: bold;
      margin: 0px;
      padding: 10px 20px;
      color: #E8E9F3
    }
  </style>


</head>

<body>

  <?php
  if ($invalid == 1) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong></strong> Invalid credentials!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>

  <div class="d-flex justify-content-center align-items-center h-100">
    <div class="mainContainer">
      <form action="login.php" method="post">
        <div class="form-group d-flex justify-content-center">
          <select name="userType" class="select selectNew">
            <option disabled selected>User Type</option>
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
            <option value="department head">Department Head</option>
            <option value="dean">Dean</option>
          </select>
        </div>
        <div class="form-group d-flex justify-content-center">
          <input class="ID" type="text" name="ID" placeholder="Enter Your ID">
        </div>
        <div class="form-group d-flex justify-content-center">
          <input class="ID" type="password" name="password" placeholder="Enter Your Password"><br>
        </div>

        <input type="submit" name="submit" value="Login" class="submitButton">
      </form>
    </div>
  </div>


</body>

</html>