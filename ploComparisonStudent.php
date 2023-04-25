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

        <select name="year" class="select selectNew mx-2">
          <option disabled selected>Year</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
        </select>
        <input class="custom-btn" type="submit" name="submit" value="Submit" />
      </form>
      <!-- div row-1 ends here -->


      <!-- div row-2 -->
      <div class="btn-row">
        <button onclick="view()" class="custom-btn">view</button>
      </div> <!-- div row-2 ends here -->

      <div class="canvas">
        <div id="curve_chart" style="width: 900px; height: 500px"></div>
      </div> <!-- div row-3 ends here -->

    </div> <!-- background div ends here -->
  </main>


  <?php
  if (isset($_POST['submit'])) {
    $year = $_POST['year'];
    $studentID = $_POST['studentID'];
  } ?>

  <script>
    function view() {

      <?php

      $sql = "SELECT sec.semester AS semester, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
    registration_t AS r, co_t AS co
    WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
    AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND r.studentID='$studentID' AND sec.year='$year'
    GROUP BY semester";

      $result = mysqli_query($con, $sql);
      ?>

      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Semester', 'PLO'],
          <?php
          while ($data = mysqli_fetch_array($result)) {
            $semester = $data['semester'];
            $PLO = $data['PLO'];
          ?>['<?php echo $semester; ?>', <?php echo $PLO; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: {
            position: 'bottom'
          }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }


    }
  </script>



</body>

</html>