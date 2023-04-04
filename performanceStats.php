<?php
include 'connect.php';
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

  <title>Employee Dashboard</title>
  <!--Google Font-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

</head>

<body class="dash-body">
  <?php require_once './template/header.php' ?>
  <div class="p-3">
    <h1>GPA Analysis</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <h3><a href="school_department_program_stats.php"
            class="text-decoration-none">School/Department/Program-wise</a></h3>
      </div>
      <div class="col">
        <h3><a href="courseWisePerformance.php" class="text-decoration-none">Course-Wise</a></h3>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h3><a href="instructorWisePerformance.php" class="text-decoration-none">Intrustor-wise</a></h3>
      </div>
      <div class="col">
        <h3><a href="instructorWiseChosenCourse.php" class="text-decoration-none">Instrustor-Wise (Chosen Course)</a>
        </h3>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h3>
          <a href="VC/Dean/Head-wise" class="text-decoration-none">VC/Dean/Head-wise</a>
        </h3>
      </div>
    </div>
  </div>
</body>

</html>