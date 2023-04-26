<?php
session_start();
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="courseOutline.css">

</head>

<body>
  <?php require_once './template/header.php'; ?>
  <main>
    <?php require_once './template/sidebar.php'; ?>
    <div class="main">

      <form method="post" class="d-flex justify-content-center mb-5 flex-column align-items-center">

        <div class="btn-row">

          <select name="courseID" class="select selectNew">
            <option disabled selected>Course</option>
            <option value="CSC101">CSC101</option>
            <option value="CSC303">CSC303</option>
            <option value="MIS430">MIS430</option>
            <option value="ENG101">ENG101</option>
          </select>

          <select name="sectionNum" class="select selectNew mx-3">
            <option disabled selected>Section</option>
            <option value="1">Section-1</option>
            <option value="2">Section-2</option>
            <option value="3">Section-3</option>
          </select>

          <select name="semester" class="select selectNew mx-3">
            <option disabled selected>Semester</option>
            <option value="spring">spring</option>
            <option value="summer">summer</option>
            <option value="autumn">autumn</option>
          </select>

          <select name="year" class="select selectNew">
            <option disabled selected>year</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
          </select>
        </div>

        <div class="btn-row">
          <input type="submit" value="Submit" name="submit" class="custom-btn">
        </div>

      </form>
    </div>
  </main>


  <?php

  include 'connect.php';

  if (isset($_POST['submit'])) {

    $sectionNum = $_POST['sectionNum'];
    $courseID = $_POST['courseID'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];

    //Getting section ID from database
    $result = mysqli_query($con, "SELECT sec.sectionID AS sectionID
  FROM section_t AS sec
  WHERE sec.sectionNum='$sectionNum' AND sec.courseID='$courseID' 
  AND sec.semester='$semester' AND sec.year='$year'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['sectionID'] = $row['sectionID'];

    header('location:createpdf.php');

  } ?>



</body>

</html>