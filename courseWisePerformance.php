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

      <form method="POST" class="d-flex justify-content-center mb-5 flex-column align-items-center">
        <div class="btn-row">
          <select name="year" class="select selectNew">
            <option disabled selected>Year</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
          </select>
        </div>

        <!-- div row-2 -->

        <div class="btn-row">
          <input class="custom-input-field mx-3" type="text" placeholder="Enter course code" name="course1" />
          <input class="custom-input-field mx-3" type="text" placeholder="Enter course code" name="course2" />
          <input class="custom-input-field mx-3" type="text" placeholder="Enter course code" name="course3" />
        </div>
        <input class="custom-btn" type="submit" name="submitCourseCode" value="Submit" />
      </form>

      <div class="btn-row">
        <button onclick="viewCourseWise()" class="custom-btn"> view </button>
      </div>

      <div class="canvas">
        <div id="Spring" style="width: 500px; height: 500px; display:inline-block;"></div>
        <div id="Summer" style="width: 500px; height: 500px; display:inline-block;"></div>
        <div id="Autumn" style="width: 500px; height: 500px; display:inline-block;"></div>
      </div>
    </div>
  </main>

  <?php
  if (isset($_POST['submitCourseCode'])) {
    $year = $_POST['year'];
    $course1 = $_POST['course1'];
    $course2 = $_POST['course2'];
    $course3 = $_POST['course3'];
  } ?>


  <!-- course wise function -->

  <script>
    function viewCourseWise() {

      <?php
      $sql = "SELECT sec.courseID AS course, AVG(scp.gradePoint) as GPA
    FROM student_course_performance_t AS scp,registration_t AS r,section_t AS sec
    WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND 
    sec.courseID IN ('$course1','$course2','$course3') AND sec.semester='autumn' AND sec.year='$year'
    GROUP BY sec.courseID";
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
          ['course', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $course = $data['course'];
            $GPA = $data['GPA'];
          ?>['<?php echo $course; ?>', <?php echo $GPA; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Autumn',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Autumn'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }


      <?php
      $sql = "SELECT sec.courseID AS course, AVG(scp.gradePoint) as GPA
FROM student_course_performance_t AS scp,registration_t AS r,section_t AS sec
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND sec.courseID IN ('$course1','$course2','$course3') AND sec.semester='summer' AND sec.year='$year'
GROUP BY sec.courseID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSummerChart() {
        var data = google.visualization.arrayToDataTable([
          ['course', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $course = $data['course'];
            $GPA = $data['GPA'];
          ?>['<?php echo $course; ?>', <?php echo $GPA; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Summer',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Summer'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      <?php
      $sql = "SELECT sec.courseID AS course, AVG(scp.gradePoint) as GPA
FROM student_course_performance_t AS scp,registration_t AS r,section_t AS sec
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND sec.courseID IN ('$course1','$course2','$course3') AND sec.semester='spring' AND sec.year='$year'
GROUP BY sec.courseID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSpringChart() {
        var data = google.visualization.arrayToDataTable([
          ['course', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $course = $data['course'];
            $GPA = $data['GPA'];
          ?>['<?php echo $course; ?>', <?php echo $GPA; ?>],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Spring',
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