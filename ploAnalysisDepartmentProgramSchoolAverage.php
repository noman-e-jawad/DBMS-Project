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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Employee Dashboard</title>
  <!--Google Font-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript"></script>
</head>

<body>
  <?php require_once './template/header.php'; ?>
  <main>
    <?php require_once './template/sidebar.php'; ?>
    <div class="main">
      <form method="POST" class="d-flex justify-content-center mb-5">
        <input class="custom-input-field mx-3" type="text" placeholder="Enter Student ID" name="studentID" />

        <input class="custom-btn mx-3" type="submit" name="submit" value="Submit" />
      </form>

      <div class="btn-row">
        <button onclick="ploAnalysisWithDepartmentAverage()" class="custom-btn">PLO Analysis with Department Average</button>
        <button onclick="ploAnalysisWithProgramAverage()" class="custom-btn">PLO Analysis with Program Average</button>
        <button onclick="ploAnalysisWithSchoolAverage()" class="custom-btn">PLO Analysis with School Average</button>
      </div>
      <div id="Autumn" class="canvas"></div>
    </div>
  </main>

  <?php
  if (isset($_POST['submit'])) {
    $studentID = $_POST['studentID'];
  }
  ?>

  <!-- Analysis with Department Average -->
  <script>
    function ploAnalysisWithDepartmentAverage() {
      <?php

      $sql = "SELECT plo.ploNum AS ploNum, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo
    WHERE r.registrationID=ans.registrationID 
    AND ans.examID=q.examID AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND r.studentID='$studentID'
    GROUP BY plo.ploNum,r.studentID";

      $result = mysqli_query($con, $sql);

      $sql2 = "SELECT plo.ploNum AS ploNum, AVG((ans.markObtained/q.markPerQuestion)*100) 
    AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo, student_t AS s WHERE r.studentID=s.studentID 
    AND r.registrationID=ans.registrationID AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum 
    AND q.coNum=co.coNum AND q.courseID=co.courseID AND co.ploID=plo.ploID
    AND s.departmentID=(SELECT s.departmentID FROM student_t AS s 
    WHERE s.studentID='$studentID')
    GROUP BY plo.ploNum";

      $result2 = mysqli_query($con, $sql2);

      ?>

      google.charts.load('current', {
        'packages': ['bar']
      });
      google.charts.setOnLoadCallback(drawAutumnChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['ploNum', 'Individual', 'Dept Average'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $data2 = mysqli_fetch_array($result2);
            $ploNum = "PLO" . $data['ploNum'];
            $percent = $data['percent'];
            $percent2 = $data2['percent'];
          ?>

            ['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo $percent2; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'PLO Analysis with Department Average',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Autumn'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    }
  </script>


  <!-- Analysis with Program Average -->
  <script>
    function ploAnalysisWithProgramAverage() {
      <?php

      $sql = "SELECT plo.ploNum AS ploNum, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo
    WHERE r.registrationID=ans.registrationID 
    AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND r.studentID='$studentID'
    GROUP BY plo.ploNum,r.studentID";

      $result = mysqli_query($con, $sql);

      $sql2 = "SELECT plo.ploNum AS ploNum, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo, student_t AS s, program_t AS p
    WHERE r.studentID=s.studentID 
    AND r.registrationID=ans.registrationID AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum  
    AND q.coNum=co.coNum AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND s.programID=p.programID
    AND s.programID=(SELECT s.programID FROM student_t AS s WHERE s.studentID='$studentID')
    GROUP BY plo.ploNum";

      $result2 = mysqli_query($con, $sql2);

      ?>

      google.charts.load('current', {
        'packages': ['bar']
      });
      google.charts.setOnLoadCallback(drawAutumnChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['ploNum', 'Individual', 'Program Average'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $data2 = mysqli_fetch_array($result2);
            $ploNum = "PLO" . $data['ploNum'];
            $percent = $data['percent'];
            $percent2 = $data2['percent'];
          ?>

            ['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo $percent2; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'PLO Analysis with Program Average',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Autumn'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    }
  </script>

  <!-- Analysis with School Average -->
  <script>
    function ploAnalysisWithSchoolAverage() {

      <?php

      $sql = "SELECT plo.ploNum AS ploNum, 
AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
FROM registration_t AS r, answer_t AS ans, question_t AS q, 
co_t AS co, plo_t AS plo
WHERE r.registrationID=ans.registrationID 
AND ans.examID=q.examID
AND ans.answerNum=q.questionNum  AND q.coNum=co.coNum 
AND q.courseID=co.courseID AND co.ploID=plo.ploID 
AND r.studentID='$studentID'
GROUP BY plo.ploNum,r.studentID";

      $result = mysqli_query($con, $sql);

      $sql2 = "SELECT plo.ploNum AS ploNum, 
AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
FROM registration_t AS r, answer_t AS ans, question_t AS q, 
co_t AS co, plo_t AS plo, student_t AS s, program_t AS p, department_t AS d
WHERE r.studentID=s.studentID 
AND r.registrationID=ans.registrationID AND ans.examID=q.examID
AND ans.answerNum=q.questionNum  
AND q.coNum=co.coNum AND q.courseID=co.courseID AND co.ploID=plo.ploID 
AND s.departmentID=d.departmentID
AND d.schoolID=(SELECT d.schoolID FROM student_t AS s, 
department_t AS d WHERE s.studentID='$studentID' 
AND s.departmentID=d.departmentID)
GROUP BY plo.ploNum";

      $result2 = mysqli_query($con, $sql2);

      ?>

      google.charts.load('current', {
        'packages': ['bar']
      });
      google.charts.setOnLoadCallback(drawAutumnChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['ploNum', 'Individual', 'School Average'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $data2 = mysqli_fetch_array($result2);
            $ploNum = "PLO" . $data['ploNum'];
            $percent = $data['percent'];
            $percent2 = $data2['percent'];
          ?>

            ['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo $percent2; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'PLO Analysis with School Average',
          },
          bars: 'vertical',
        };

        var chart = new google.charts.Bar(document.getElementById('Autumn'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

    }
  </script>

</body>

</html>