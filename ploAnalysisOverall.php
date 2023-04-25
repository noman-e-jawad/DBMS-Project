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
        <button onclick="overallPlo()" class="custom-btn">Overall PLO</button>
        <button onclick="coWisePlo()" class="custom-btn">CO Wise PLO</button>
        <button onclick="courseWisePlo()" class="custom-btn">Course Wise PLO</button>
      </div>

      <div id="Autumn" class="canvas"></div>
    </div>
  </main>

  <?php
  if (isset($_POST['submit'])) {
    $studentID = $_POST['studentID'];
  }
  ?>

  <!-- Overall plo -->
  <script>
    function overallPlo() {
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
      ?>

      google.charts.load('current', {
        'packages': ['bar']
      });
      google.charts.setOnLoadCallback(drawAutumnChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['ploNum', 'PLO Percentage'],

          <?php
          while ($data = mysqli_fetch_array($result)) {

            $ploNum = "PLO" . $data['ploNum'];
            $percent = $data['percent'];

          ?>

            ['<?php echo $ploNum; ?>', <?php echo $percent; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Overall PLO Analysis',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Autumn'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    }
  </script>


  <!-- Co wise plo -->
  <script>
    function coWisePlo() {

    }
  </script>

  <!-- course wise plo -->

  <script>
    function courseWisePlo() {


    }
  </script>

</body>

</html>