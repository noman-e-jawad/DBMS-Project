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

<body>
  <?php require_once './template/header.php'; ?>
  <main>
    <?php require_once './template/sidebar.php'; ?>
    <div class="main">
      <form action="addExamConfig.php" method="POST"
        class="d-flex justify-content-center mb-5 flex-column align-items-center">
        <div class="btn-row">

          <input type="text" class="custom-input-field" placeholder="Exam Name" name="examName" />


          <select name="courseID" class="select selectNew mx-2">
            <option disabled selected>Course</option>
            <option value="CSC101">CSC101</option>
            <option value="EEE131">EEE131</option>
            <option value="ENG101">ENG101</option>
          </select>

          <select name="sectionNum" class="select selectNew mx-2">
            <option disabled selected>Section</option>
            <option value="1">section-1</option>
            <option value="2">section-2</option>
            <option value="3">section-3</option>
            <option value="4">section-4</option>
          </select>

        </div>

        <!-- div row-1 ends here -->

        <!-- div row-2 starts here -->

        <div class="btn-row">
          <select name="questionCount" class="select selectNew mx-2">
            <option disabled selected>No. of Questions</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
          </select>

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

        <div class="btn-rowm w-100">
          <div class="btn-row flex-column">
            <div class="btn-row w-100 my-2 bg-blue p-4">

              <label class="question-form">
                Question Number
                <input type="text" class="question-number" name="questionNum1">
              </label>

              <label class="question-form">
                Question Details
                <input type="text" class="question-details" name="questionDetails1">
              </label>

              <label class="question-form">
                Mark
                <input type="text" class="mark" name="mark1">
              </label>

              <label class="question-form">
                CO Number
                <input type="text" class="coNum" name="coNum1">
              </label>
            </div>

            <div class="btn-row w-100 my-2 bg-blue p-4">

              <label class="question-form">
                Question Number
                <input type="text" class="question-number" name="questionNum2">
              </label>

              <label class="question-form">
                Question Details
                <input type="text" class="question-details" name="questionDetails2">
              </label>

              <label class="question-form">
                Mark
                <input type="text" class="mark" name="mark2">
              </label>

              <label class="question-form">
                CO Number
                <input type="text" class="coNum" name="coNum2">
              </label>


            </div>

            <div class="btn-row w-100 my-2 bg-blue p-4">

              <label class="question-form">
                Question Number
                <input type="text" class="question-number" name="questionNum3">
              </label>

              <label class="question-form">
                Question Details
                <input type="text" class="question-details" name="questionDetails3">
              </label>

              <label class="question-form">
                Mark
                <input type="text" class="mark" name="mark3">
              </label>

              <label class="question-form">
                CO Number
                <input type="text" class="coNum" name="coNum3">
              </label>


            </div>

            <div class="btn-row w-100 my-2 bg-blue p-4">

              <label class="question-form">
                Question Number
                <input type="text" class="question-number" name="questionNum4">
              </label>

              <label class="question-form">
                Question Details
                <input type="text" class="question-details" name="questionDetails4">
              </label>

              <label class="question-form">
                Mark
                <input type="text" class="mark" name="mark4">
              </label>

              <label class="question-form">
                CO Number
                <input type="text" class="coNum" name="coNum4">
              </label>


            </div>

            <div class="btn-row w-100 my-2 bg-blue p-4">

              <label class="question-form">
                Question Number
                <input type="text" class="question-number" name="questionNum5">
              </label>

              <label class="question-form">
                Question Details
                <input type="text" class="question-details" name="questionDetails5">
              </label>

              <label class="question-form">
                Mark
                <input type="text" class="mark" name="mark5">
              </label>

              <label class="question-form">
                CO Number
                <input type="text" class="coNum" name="coNum5">
              </label>


            </div>

            <div class="btn-row w-100 my-2 bg-blue p-4">

              <label class="question-form">
                Question Number
                <input type="text" class="question-number" name="questionNum6">
              </label>

              <label class="question-form">
                Question Details
                <input type="text" class="question-details" name="questionDetails6">
              </label>

              <label class="question-form">
                Mark
                <input type="text" class="mark" name="mark6">
              </label>

              <label class="question-form">
                CO Number
                <input type="text" class="coNum" name="coNum6">
              </label>


            </div>

            <div class="btn-row w-100 my-2 bg-blue p-4">

              <label class="question-form">
                Question Number
                <input type="text" class="question-number" name="questionNum7">
              </label>

              <label class="question-form">
                Question Details
                <input type="text" class="question-details" name="questionDetails7">
              </label>

              <label class="question-form">
                Mark
                <input type="text" class="mark" name="mark7">
              </label>

              <label class="question-form">
                CO Number
                <input type="text" class="coNum" name="coNum7">
              </label>
            </div>
          </div>
          <div class="btn-row">

            <input type="submit" name="submit" value="Submit" class="custom-btn">
          </div>
        </div>
      </form>
    </div>
  </main>
  <!-- div row-1 starts here -->



</body>

</html>