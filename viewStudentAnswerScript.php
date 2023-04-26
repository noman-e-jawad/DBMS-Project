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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Employee Dashboard</title>
  <!--Google Font-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php require_once './template/header.php'; ?>
  <main>
    <?php require_once './template/sidebar.php'; ?>
    <div class="main">
      <form method="post" class="d-flex justify-content-center mb-5 flex-column align-items-center">
        <div class="btn-row">

          <input type="text" class="custom-input-field" placeholder="Exam Name" name="examName" />
          <select name="courseID" class="select selectNew mx-3">
            <option disabled selected>Course</option>
            <option value="CSC101">CSC101</option>
            <option value="EEE131">EEE131</option>
            <option value="ENG101">ENG101</option>
          </select>

          <select name="sectionNum" class="select selectNew">
            <option disabled selected>Section</option>
            <option value="1">section-1</option>
            <option value="2">section-2</option>
            <option value="3">section-3</option>
            <option value="4">section-4</option>
          </select>

        </div> <!-- div row-1 ends here -->



        <!-- div row-2 starts here -->

        <div class="btn-row">

          <select name="semester" class="select selectNew mx-2">
            <option disabled selected>Semester</option>
            <option value="spring">spring</option>
            <option value="summer">summer</option>
            <option value="autumn">autumn</option>
          </select>




          <select name="year" class="select selectNew mx-2">
            <option disabled selected>year</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
          </select>


        </div>
        <div class="btn-row">

          <input type="submit" name="submit" value="Submit" class="custom-btn">
        </div>


      </form>
    </div>
  </main>

  <?php
  if (isset($_POST['submit'])) {
    $_SESSION['examName'] = $_POST['examName'];
    $_SESSION['courseID'] = $_POST['courseID'];
    $_SESSION['sectionNum'] = $_POST['sectionNum'];
    $_SESSION['semester'] = $_POST['semester'];
    $_SESSION['year'] = $_POST['year'];

    header('location:answerScriptGrading.php');
  }
  ?>

</body>

</html>