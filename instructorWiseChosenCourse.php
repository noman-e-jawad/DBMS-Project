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
  <link rel="stylesheet" href="style.css">

  <title>Employee Dashboard</title>
  <!--Google Font-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">



  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript"></script>

</head>

<body>
  <?php require_once './template/header.php'; ?>
  <main>
    <?php require_once './template/sidebar.php'; ?>

    <div class="main">
      <!-- div row-1 -->

      <form method="POST" class="d-flex justify-content-center mb-5">

        <select name="courseCode" class="select selectNew mx-2">
          <option disabled selected>Course Code</option>
          <option value="EEE131">EEE131</option>
          <option value="EEE231">EEE231</option>
          <option value="EEE233">EEE233</option>
          <option value="ENG101">ENG101</option>
          <option value="CSC101">CSC101</option>
          <option value="MKT101">MKT101</option>
        </select>

        <select name="year" class="select selectNew mx-2">
          <option disabled selected>Year</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
        </select>
        <input class="custom-btn" type="submit" name="submitCourseCode" value="Submit" />
      </form>

      <div class="btn-row">
        <button onclick="viewInstructorWiseChosenCourse()" class="custom-btn">
          view</button>
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
    $courseCode = $_POST['courseCode'];
  } ?>


  <!-- instructor wise for chosen function -->

  <script>
    function viewInstructorWiseChosenCourse() {

      <?php
      $sql = "SELECT e.firstName AS firstName,e.lastName AS lastName, AVG(scp.gradePoint) AS GPA
    FROM student_course_performance_t AS scp, registration_t AS r, section_t AS sec, 
    employee_t AS e
    WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND
    sec.facultyID=e.employeeID AND sec.courseID='$courseCode' AND sec.year='$year' 
    AND sec.semester='autumn'
    GROUP BY sec.facultyID";
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
          ['Course Instructor', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $courseInstructor = $data['firstName'] . " " . $data['lastName'];
            $GPA = $data['GPA'];
          ?>['<?php echo $courseInstructor; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT e.firstName AS firstName,e.lastName AS lastName, AVG(scp.gradePoint) AS GPA
FROM student_course_performance_t AS scp, registration_t AS r, section_t AS sec, 
employee_t AS e
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND
sec.facultyID=e.employeeID AND sec.courseID='$courseCode' AND sec.year='$year' 
AND sec.semester='summer'
GROUP BY sec.facultyID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSummerChart() {
        var data = google.visualization.arrayToDataTable([
          ['Course Instructor', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $courseInstructor = $data['firstName'] . " " . $data['lastName'];
            $GPA = $data['GPA'];
          ?>['<?php echo $courseInstructor; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT e.firstName AS firstName,e.lastName AS lastName, AVG(scp.gradePoint) AS GPA
FROM student_course_performance_t AS scp, registration_t AS r, section_t AS sec, 
employee_t AS e
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND
sec.facultyID=e.employeeID AND sec.courseID='$courseCode' AND sec.year='$year' 
AND sec.semester='spring'
GROUP BY sec.facultyID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSpringChart() {
        var data = google.visualization.arrayToDataTable([
          ['Course Instructor', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $courseInstructor = $data['firstName'] . " " . $data['lastName'];
            $GPA = $data['GPA'];
          ?>['<?php echo $courseInstructor; ?>', <?php echo $GPA; ?>],
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