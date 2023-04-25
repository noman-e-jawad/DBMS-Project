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

        <select class="select selectNew mx-3" name="programID">
          <option disabled selected>Program</option>
          <option value="13">BSc in CSC</option>
          <option value="9">BSc in EEE</option>
        </select>


        <select class="select selectNew mx-3" name="year">
          <option disabled selected>Year</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
        </select>
        <input class="custom-btn mx-3" type="submit" name="submit" value="Submit" />
      </form>
      <!-- div row-1 ends here -->


      <!-- div row-2 -->
      <div class="btn-row">
        <button onclick="view()" class="custom-btn">view</button>
      </div> <!-- div row-2 ends here -->

      <div class="canvas">
        <div id="Spring" style="width: 500px; height: 500px; display:inline-block;margin-top:15px;"></div>
        <div id="Summer" style="width: 500px; height: 500px; display:inline-block;"></div>
        <div id="Autumn" style="width: 500px; height: 500px; display:inline-block;"></div>
      </div>
      <!-- div row-3 ends here -->

    </div> <!-- background div ends here -->
  </main>


  <?php
  if (isset($_POST['submit'])) {
    $year = $_POST['year'];
    $programID = $_POST['programID'];
  } ?>

  <script>
    function view() {

      <?php

      $sql = "SELECT plo.ploNum AS ploNum, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
    registration_t AS r, co_t AS co, student_t AS s
    WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
    AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND sec.year='$year' AND r.studentID=s.studentID AND s.programID='$programID' AND sec.semester='spring'
    GROUP BY plo.ploNum
    ORDER BY plo.ploNum";
      $result = mysqli_query($con, $sql);
      ?>

      google.charts.load('current', {
        'packages': ['bar']
      });
      google.charts.setOnLoadCallback(drawAutumnChart);
      google.charts.setOnLoadCallback(drawSummerChart);
      google.charts.setOnLoadCallback(drawSpringChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['PLO', 'Achieved', 'Expected'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $ploNum = "PLO" . $data['ploNum'];
            $percent = $data['percent'];
          ?>['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo '70'; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Semester Wise PLO Achievement for Program (Autumn)',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Autumn'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }


      <?php
      $sql = "SELECT plo.ploNum AS ploNum, 
AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
registration_t AS r, co_t AS co, student_t AS s
WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
AND ans.examID=q.examID
AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
AND q.courseID=co.courseID AND co.ploID=plo.ploID 
AND sec.year='$year' AND r.studentID=s.studentID AND s.programID='$programID' AND sec.semester='summer'
GROUP BY plo.ploNum
ORDER BY plo.ploNum";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSummerChart() {
        var data = google.visualization.arrayToDataTable([
          ['PLO', 'Achieved', 'Expected'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $ploNum = "PLO" . $data['ploNum'];
            $percent = $data['percent'];
          ?>['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo '70'; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Semester Wise PLO Achievement for Program (Summer)',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Summer'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      <?php
      $sql = "SELECT plo.ploNum AS ploNum, 
AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
registration_t AS r, co_t AS co, student_t AS s
WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
AND ans.examID=q.examID
AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
AND q.courseID=co.courseID AND co.ploID=plo.ploID 
AND sec.year='$year' AND r.studentID=s.studentID AND s.programID='$programID' AND sec.semester='autumn'
GROUP BY plo.ploNum
ORDER BY plo.ploNum";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSpringChart() {
        var data = google.visualization.arrayToDataTable([
          ['PLO', 'Achieved', 'Expected'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $ploNum = "PLO" . $data['ploNum'];
            $percent = $data['percent'];
          ?>['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo '70'; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Semester Wise PLO Achievement for Program (Spring)',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Spring'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

    }
  </script>



</body>

</html>