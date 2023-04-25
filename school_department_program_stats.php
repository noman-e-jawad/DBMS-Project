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
        <select name="year" class="select selectNew">
          <option disabled selected>Year</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
        </select>
        <input class="custom-btn" type="submit" name="submit" value="Submit" />
      </form>

      <div class="btn-row">
        <button onclick="schoolWiseGpa()" class="custom-btn">School-wise GPA Trend</button>
        <button onclick="departmentWiseGpa()" class="custom-btn">Department-wise GPA Trend</button>
        <button onclick="programWiseGpa()" class="custom-btn">Program-wise GPA Trend</button>
      </div>

      <div class="canvas">
        <div id="Spring" style="width: 500px; height: 500px; display:inline-block;"></div>
        <div id="Summer" style="width: 500px; height: 500px; display:inline-block;"></div>
        <div id="Autumn" style="width: 500px; height: 500px; display:inline-block;"></div>

      </div>
    </div>
  </main>

  <?php
  if (isset($_POST['submit'])) {
    $year = $_POST['year'];
  }
  ?>

  <!-- department wise function -->
  <script>
    function departmentWiseGpa() {
      <?php
      $sql = "SELECT s.departmentID AS department,AVG(scp.gradePoint) as GPA
    FROM student_t AS s,student_course_performance_t AS scp, 
    registration_t AS r, section_t AS sec
    WHERE r.registrationID=scp.registrationID 
    AND r.studentID=s.studentID AND r.sectionID=sec.sectionID 
    AND sec.semester='autumn' AND sec.year='$year'
    GROUP BY s.departmentID";
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
          ['Department', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $department = $data['department'];
            $GPA = $data['GPA'];
          ?>['<?php echo $department; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT s.departmentID AS department,AVG(scp.gradePoint) as GPA
FROM student_t AS s,student_course_performance_t AS scp, registration_t AS r, section_t AS sec
WHERE r.registrationID=scp.registrationID AND r.studentID=s.studentID AND r.sectionID=sec.sectionID AND sec.semester='summer' AND sec.year='$year'
GROUP BY s.departmentID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSummerChart() {
        var data = google.visualization.arrayToDataTable([
          ['Department', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $department = $data['department'];
            $GPA = $data['GPA'];
          ?>['<?php echo $department; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT s.departmentID AS department,AVG(scp.gradePoint) as GPA
FROM student_t AS s,student_course_performance_t AS scp, registration_t AS r, section_t AS sec
WHERE r.registrationID=scp.registrationID AND r.studentID=s.studentID AND r.sectionID=sec.sectionID 
AND sec.semester='spring' AND sec.year='$year'
GROUP BY s.departmentID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSpringChart() {
        var data = google.visualization.arrayToDataTable([
          ['Department', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $department = $data['department'];
            $GPA = $data['GPA'];
          ?>['<?php echo $department; ?>', <?php echo $GPA; ?>],
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


  <!-- program wise function -->
  <script>
    function programWiseGpa() {
      <?php
      $sql = "SELECT p.programName AS program, AVG(scp.gradePoint) AS GPA
    FROM registration_t AS r, student_t AS s, student_course_performance_t AS scp, program_t AS p, section_t AS sec
    WHERE r.studentID=s.studentID AND scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND s.programID=p.programID AND sec.semester='autumn' AND sec.year='$year'
    GROUP BY p.programID";
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
          ['Program', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $programName = $data['program'];
            $GPA = $data['GPA'];
          ?>['<?php echo $programName; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT p.programName AS program, AVG(scp.gradePoint) AS GPA
FROM registration_t AS r, student_t AS s, student_course_performance_t AS scp, program_t AS p, section_t AS sec
WHERE r.studentID=s.studentID AND scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND s.programID=p.programID AND sec.semester='summer' AND sec.year='$year'
GROUP BY p.programID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSummerChart() {
        var data = google.visualization.arrayToDataTable([
          ['Program', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $programName = $data['program'];
            $GPA = $data['GPA'];
          ?>['<?php echo $programName; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT p.programName AS program, AVG(scp.gradePoint) AS GPA
FROM registration_t AS r, student_t AS s, student_course_performance_t AS scp, program_t AS p, section_t AS sec
WHERE r.studentID=s.studentID AND scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID AND s.programID=p.programID AND sec.semester='spring' AND sec.year='$year'
GROUP BY p.programID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSpringChart() {
        var data = google.visualization.arrayToDataTable([
          ['Program', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $programName = $data['program'];
            $GPA = $data['GPA'];
          ?>['<?php echo $programName; ?>', <?php echo $GPA; ?>],
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

  <!-- school wise function -->
  <script>
    function schoolWiseGpa() {
      <?php
      $sql = "SELECT sch.schoolID AS school,AVG(scp.gradePoint) AS GPA
    FROM student_t AS s, registration_t AS r,department_t AS d,school_t AS sch,student_course_performance_t AS scp, section_t AS sec
    WHERE scp.registrationID=r.registrationID AND r.studentID=s.studentID AND r.sectionID=sec.sectionID AND s.departmentID=d.departmentID AND d.schoolID=sch.schoolID AND sec.semester='autumn' AND sec.year='$year'
    GROUP BY sch.schoolID";
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
          ['School', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $school = $data['school'];
            $GPA = $data['GPA'];
          ?>['<?php echo $school; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT sch.schoolID AS school,AVG(scp.gradePoint) AS GPA
FROM student_t AS s, registration_t AS r,department_t AS d,school_t AS sch,student_course_performance_t AS scp, section_t AS sec
WHERE scp.registrationID=r.registrationID AND r.studentID=s.studentID AND r.sectionID=sec.sectionID AND s.departmentID=d.departmentID AND d.schoolID=sch.schoolID AND sec.semester='summer' AND sec.year='$year'
GROUP BY sch.schoolID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSummerChart() {
        var data = google.visualization.arrayToDataTable([
          ['School', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $school = $data['school'];
            $GPA = $data['GPA'];
          ?>['<?php echo $school; ?>', <?php echo $GPA; ?>],
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
      $sql = "SELECT sch.schoolID AS school,AVG(scp.gradePoint) AS GPA
FROM student_t AS s, registration_t AS r,department_t AS d,school_t AS sch,student_course_performance_t AS scp, section_t AS sec
WHERE scp.registrationID=r.registrationID AND r.studentID=s.studentID AND r.sectionID=sec.sectionID AND s.departmentID=d.departmentID AND d.schoolID=sch.schoolID AND sec.semester='spring' AND sec.year='$year'
GROUP BY sch.schoolID";
      $result = mysqli_query($con, $sql);
      ?>

      function drawSpringChart() {
        var data = google.visualization.arrayToDataTable([
          ['School', 'GPA'],

          <?php
          while ($data = mysqli_fetch_array($result)) {
            $school = $data['school'];
            $GPA = $data['GPA'];
          ?>['<?php echo $school; ?>', <?php echo $GPA; ?>],
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