<?php

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
    <h1>Welcome to SPMS 4.0</h1>
  </div>
  <div class="container">
    <div class="row pb-3">
      <div class="col">
        <h3>PLO Analysis</h3>
        <ul>
          <li>
            <a href="ploAnalysisDepartmentProgramSchoolAverage.php">PLO Analysis With Department/Program/School
              Average</a>
          </li>
          <li>
            <a href="ploAnalysisOverall.php">PLO Analysis (Overall, CO Wise, Course Wise)</a>
          </li>
        </ul>
      </div>
      <div class="col">
        <h3>PLO Achivement Stats</h3>
        <ul>
          <li><a href="ploComparisonStudent.php">PLO Comparison (Student)</a></li>
          <li><a href="ploComparisonCourse.php">PLO Comparison (Course)</a></li>
          <li><a href="ploComparisonProgram.php">PLO Comparison (Program)</a></li>
          <li><a href="ploComparisonSchool.php">PLO Comparison (School)</a></li>
          <li><a href="ploComparisonDepartment.php">PLO Comparison (Department)</a></li>
        </ul>
      </div>
    </div>
    <div class="row py-2">
      <div class="col">
        <h3>Exam</h3>
        <ul>
          <li><a href="addExam.php">Add Exam</a></li>
          <li><a href="viewExam.php">View Exam</a></li>
          <li><a href="viewStudentAnswerScript.php">Evaluate Exam Script</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>GPA Analysis</h3>
        <ul>
          <li><a href="school_department_program_stats.php">School/Department/Program-wise</a></li>
          <li><a href="courseWisePerformance.php">Course-Wise</a></li>
          <li><a href="instructorWisePerformance.php">Intrustor-wise</a></li>
          <li><a href="instructorWiseChosenCourse.php">Instrustor-Wise (Chosen Course)</a></li>
          <li><a href="VC/Dean/Head-wise">VC/Dean/Head-wise</a></li>
        </ul>
      </div>
    </div>
    <div class="row py-2">
      <div class="col">
        <h3>Course Outline</h3>
        <ul>
          <li><a href="createCourseOutline.php">Create Course Outline</a></li>
          <li><a href="viewCourseOutline.php">View Course Outline</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>Enrollment Stats</h3>
        <ul>
          <li><a href="enrollmentStatistics.php">View Enrollment Stats</a></li>
        </ul>
      </div>
    </div>
    <div class="row pt-3">
      <div class="col">
        <h3>
          Spider Chart
        </h3>
        <ul>
          <li><a href="spiderChart.php">Spider Chart Analysis</a></li>
        </ul>
      </div>

    </div>
  </div>

</body>

</html>