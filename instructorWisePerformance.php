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

        <div class="btn-row flex-column">

          <select name="courseInstructor1" class="select selectNew my-2">
            <option disabled selected>Course Instructor</option>
            <option value="4275">Tahsin F.Ara Nayna</option>
            <option value="4361">Shovasis Kumar Biswas</option>
            <option value="4351">Nabila Rahman Nodi</option>
            <option value="2518">Mubash-Shera Karishma Mobarok</option>
            <option value="2344">Nadira Sultana Mirza</option>
            <option value="2259">Mainuddin Chowdhury</option>
            <option value="2483">Kazi Mubinul Hasan Shanto</option>
            <option value="4449">Sheikh Abujar</option>
            <option value="3329">Abul Khair jyote</option>
          </select>


          <select name="courseInstructor2" class="select selectNew my-2">
            <option disabled selected>Course Instructor</option>
            <option value="4275">Tahsin F.Ara Nayna</option>
            <option value="4361">Shovasis Kumar Biswas</option>
            <option value="4351">Nabila Rahman Nodi</option>
            <option value="2518">Mubash-Shera Karishma Mobarok</option>
            <option value="2344">Nadira Sultana Mirza</option>
            <option value="2259">Mainuddin Chowdhury</option>
            <option value="2483">Kazi Mubinul Hasan Shanto</option>
            <option value="4449">Sheikh Abujar</option>
            <option value="3329">Abul Khair jyote</option>
          </select>

          <select name="courseInstructor3" class="select selectNew my-2">
            <option disabled selected>Course Instructor</option>
            <option value="4275">Tahsin F.Ara Nayna</option>
            <option value="4361">Shovasis Kumar Biswas</option>
            <option value="4351">Nabila Rahman Nodi</option>
            <option value="2518">Mubash-Shera Karishma Mobarok</option>
            <option value="2344">Nadira Sultana Mirza</option>
            <option value="2259">Mainuddin Chowdhury</option>
            <option value="2483">Kazi Mubinul Hasan Shanto</option>
            <option value="4449">Sheikh Abujar</option>
            <option value="3329">Abul Khair jyote</option>
          </select>

        </div>
        <input class="custom-btn" type="submit" name="submitInstructorName" value="Submit" />

      </form>

      <div class="btn-row">
        <button onclick="viewInstructorWise()" class="custom-btn">view</button>
      </div>

      <div class="canvas">
        <div id="Spring" style="width: 500px; height: 500px; display:inline-block;"></div>
        <div id="Summer" style="width: 500px; height: 500px; display:inline-block;"></div>
        <div id="Autumn" style="width: 500px; height: 500px; display:inline-block;"></div>
      </div>
    </div>
  </main>

  <?php
  if (isset($_POST['submitInstructorName'])) {
    $year = $_POST['year'];
    $instructor1 = $_POST['courseInstructor1'];
    $instructor2 = $_POST['courseInstructor2'];
    $instructor3 = $_POST['courseInstructor3'];
  } ?>


  <!-- chosen instructor wise function -->

  <script>
    function viewInstructorWise() {

      <?php
      $sql = "SELECT e.firstName AS firstName,e.lastName AS lastName, AVG(scp.gradePoint) AS GPA
    FROM student_course_performance_t AS scp,section_t AS sec, registration_t AS r,
    employee_t AS e
    WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID
    AND sec.facultyID=e.employeeID AND sec.year='$year' AND sec.semester='autumn'
    AND sec.facultyID IN ('$instructor1','$instructor2','$instructor3')
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
FROM student_course_performance_t AS scp,section_t AS sec, registration_t AS r,
employee_t AS e
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID
AND sec.facultyID=e.employeeID AND sec.year='$year' AND sec.semester='summer'
AND sec.facultyID IN ('$instructor1','$instructor2','$instructor3')
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
FROM student_course_performance_t AS scp,section_t AS sec, registration_t AS r,
employee_t AS e
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID
AND sec.facultyID=e.employeeID AND sec.year='$year' AND sec.semester='spring'
AND sec.facultyID IN ('$instructor1','$instructor2','$instructor3')
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