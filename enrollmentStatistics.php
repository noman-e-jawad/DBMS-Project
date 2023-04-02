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
    <link rel="stylesheet" href="ES_semester_dropdown.css">
    <title>Student Enrollment Statistics Page</title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript"></script>  

  </head>

  <body>

  <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <div class="nav-title">
            SPMS 3.0
          </div>
        </div>
        <div class="nav-btn">
          <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
          </label>
        </div>
        
        <div class="nav-links">
            <ul>
          <li><a href="employee_dashboard.php" target="_self">Dashboard</a></li>
          <li><a href="ploAnalysis.php" target="_self">Student Wise PLO Analysis</a></li>
          <li><a href="ploAchieveStats" target="_self">PLO Achievement Statistics</a></li>
          <li><a href="dataEntry.php" target="_self">Data Entry</a></li>
          <li><a href="enrollmentStatistics.php" target="_self">Student Enrollment Statistics</a></li>
          <li><a href="performanceStats.php" target="_self">Student Performance Stats</a></li>
          <li><a href="logout.php" target="_self">Logout</a></li>
            </ul>
        </div>
      </div>
    
<div style="display:flex;justify-content:center;" class="row1">

    <form method="POST">
     <select style="margin-left:10px;" name="year" class="select">
       <option disabled selected>Year</option>
       <option value="2020">2020</option>
       <option value="2021">2021</option>
       <option value="2022">2022</option>
     </select>
       <input style="background:#00BFFF;border-radius:10px;border:none;outline:none;color:#fff;font-size:14px;letter-spacing:2px;
              text-transform:uppercase;cursor:pointer;font-weight:bold;margin-left:10px;height: 36px;width: 100px;"
              type="submit" name="submit" value="Submit"/>
    </form>  
</div>    
  
    <div class="background">
      <div class="row2">
        <button style="margin-bottom:0px;" onclick="schoolWiseEnrollment()" class="School-wise">School-wise</button>
        <button onclick="departmentWiseEnrollment()" class="Department-wise">Department-wise</button>
        <button onclick="programWiseEnrollment()" class="Program-wise">Program-wise</button>
    </div>
          <div style="width:1000px; margin:auto; margin-top:20px;">     
             <div id="piechart" style="width: 1000px; height: 530px; background-color:#155977;"></div>  
          </div>
  </div>

  <?php
    if(isset($_POST['submit'])){
    $year=$_POST['year'];
  }?>

    <script>
    
    function departmentWiseEnrollment(){
    <?php

    $sql="SELECT d.departmentName AS department, COUNT(s.studentID) AS studentNumber
    FROM department_t AS d, student_t AS s
    WHERE s.enrollmentYear='$year' AND d.departmentID=s.departmentID
    GROUP BY s.departmentID";

    $result=mysqli_query($con,$sql);
    ?>

      google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Department', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["department"]."', ".$row["studentNumber"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Student Enrollment Statistics' 
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data,{backgroundColor:{fill:"#87CEFA"}},);  
           }  
    }

    function schoolWiseEnrollment(){
    <?php

    $sql="SELECT sch.schoolName as schoolName, COUNT(s.studentID) AS number
    FROM student_t AS s INNER JOIN department_t AS d 
    ON s.departmentID=d.departmentID
    INNER JOIN school_t AS sch
    ON d.schoolID=sch.schoolID
    WHERE s.enrollmentYear='$year' AND d.departmentID=s.departmentID
    GROUP BY sch.schoolName";

    $result=mysqli_query($con,$sql);
    ?>

      google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['School', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["schoolName"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Student Enrollment Statistics' 
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data,{backgroundColor:{fill:"#87CEFA"}},);  
           }  
    }

    function programWiseEnrollment(){
    <?php

    $sql="SELECT p.programName AS programName,COUNT(s.studentID) AS number
    FROM student_t AS s,program_t AS p
    WHERE s.enrollmentYear='$year' AND s.programID=p.programID
    GROUP BY p.programName";

    $result=mysqli_query($con,$sql);
    ?>

      google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['ProgramName', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["programName"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  

                     var options = {
                     title: 'My Daily Activities',
                     is3D: true,
                    };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data,{backgroundColor:{fill:"#87CEFA"}},);  
           }  
    }

      </script>
   
 
 
  </body>

</html>