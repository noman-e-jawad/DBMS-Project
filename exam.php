<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Employee Dashboard</title>
  <!--Google Font-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

</head>

<body class="dash-body">
  <?php require_once './template/header.php' ?>
  <main>
    <?php require_once './template/sidebar.php'; ?>
    <div class="main">
      <div class="p-3">
        <h1>Exam</h1>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <h3> <a href="addExam.php" class="text-decoration-none">Add Exam</a> </h3>
          </div>
          <div class="col">
            <h3><a href="viewExam.php" class="text-decoration-none">View Exam</a></h3>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <h3><a href="viewStudentAnswerScript.php" class="text-decoration-none">Evaluate Exam Script</a></h3>
          </div>
        </div>
      </div>
    </div>
  </main>


</body>

</html>