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
          <li><a href="school_department_program_stats.php" target="_self">School/Department/Program-wise</a></li>
          <li><a href="courseWisePerformance.php" target="_self">Course-wise</a></li>
          <li><a href="instructorWisePerformance.php" target="_self">Instructor-wise</a></li>
          <li><a href="instructorWiseChosenCourse.php" target="_self">Instructor-wise(Chosen Course)</a></li>
          <li><a href="" target="_self">Dean/Head-wise</a></li>
          <li><a href="logout.php" target="_self">Logout</a></li>
            </ul>
        </div>
      </div>

      <div class="background">

      <!-- div row-1 -->
      <div class="row1">
        <form method="POST">
         <select name="year" class="select">
            <option disabled selected>Year</option>
             <option value="2020">2020</option>
             <option value="2021">2021</option>
             <option value="2022">2022</option>
         </select>
             <input style="background:#00BFFF;
              border-radius:10px;
              border:none;
              outline:none;
              color:#fff;
              font-size:14px;
              letter-spacing:2px;
              text-transform:uppercase;
              cursor:pointer;
              font-weight:bold;
              margin-left:5px;
              height: 36px;
              width: 100px;"
              
             type="submit" name="submitInstructorName" value="Submit"/>
         
      </div>

                   <!-- div row-2 -->

      <div
      style="height:50px;display:flex;justify-content:space-around;">
      
        <select name="courseInstructor1" class="select"
        style="margin-left:0px;width:250px;height:100%;margin-top:0px;">
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


         <select name="courseInstructor2" class="select"
            style="margin-left:0px;width:250px;height:100%;margin-top:0px;">
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
      
         <select name="courseInstructor3" class="select"
            style="margin-left:0px;width:250px;height:100%;margin-top:0px;">
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

      </form>              
      </div>

      <div style="height:50px;padding-left:43%;margin-top:15px;">
      <button onclick="viewInstructorWise()" style="height: 46px;width: 100px;margin-left:50px;display:inline-block; border-radius: 10px; border: none;outline: none;background:#00BFFF;color: #fff;font-size: 14px;letter-spacing:2px;text-transform: uppercase;cursor:pointer;font-weight: bold;">
        view</button>
      </div>
    
    <div class="row3" style="margin-top:5px;"> 
       <div id="Spring" style="width: 500px; height: 500px; display:inline-block;"></div>
       <div id="Summer" style="width: 500px; height: 500px; display:inline-block;"></div>
       <div id="Autumn" style="width: 500px; height: 500px; display:inline-block;"></div>
     </div>
</div>  

<?php
if(isset($_POST['submitInstructorName'])){
    $year=$_POST['year'];
    $instructor1=$_POST['courseInstructor1'];
    $instructor2=$_POST['courseInstructor2'];
    $instructor3=$_POST['courseInstructor3'];
  }?>


<!-- chosen instructor wise function -->

<script>
    function viewInstructorWise(){
     
    <?php
    $sql="SELECT e.firstName AS firstName,e.lastName AS lastName, AVG(scp.gradePoint) AS GPA
    FROM student_course_performance_t AS scp,section_t AS sec, registration_t AS r,
    employee_t AS e
    WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID
    AND sec.facultyID=e.employeeID AND sec.year='$year' AND sec.semester='autumn'
    AND sec.facultyID IN ('$instructor1','$instructor2','$instructor3')
    GROUP BY sec.facultyID";
    $result=mysqli_query($con,$sql);
    ?>
    
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawAutumnChart);
    google.charts.setOnLoadCallback(drawSummerChart);
    google.charts.setOnLoadCallback(drawSpringChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['Course Instructor','GPA'],
          
          <?php
            while($data=mysqli_fetch_array($result)){
              $courseInstructor=$data['firstName']." ".$data['lastName'];
              $GPA=$data['GPA'];
           ?>
           ['<?php echo $courseInstructor;?>',<?php echo $GPA;?>],   
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
$sql="SELECT e.firstName AS firstName,e.lastName AS lastName, AVG(scp.gradePoint) AS GPA
FROM student_course_performance_t AS scp,section_t AS sec, registration_t AS r,
employee_t AS e
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID
AND sec.facultyID=e.employeeID AND sec.year='$year' AND sec.semester='summer'
AND sec.facultyID IN ('$instructor1','$instructor2','$instructor3')
GROUP BY sec.facultyID";
$result=mysqli_query($con,$sql);
?>

      function drawSummerChart() {
        var data = google.visualization.arrayToDataTable([
          ['Course Instructor','GPA'],
          
          <?php
            while($data=mysqli_fetch_array($result)){
                $courseInstructor=$data['firstName']." ".$data['lastName'];
              $GPA=$data['GPA'];
           ?>
           ['<?php echo $courseInstructor;?>',<?php echo $GPA;?>],   
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
$sql="SELECT e.firstName AS firstName,e.lastName AS lastName, AVG(scp.gradePoint) AS GPA
FROM student_course_performance_t AS scp,section_t AS sec, registration_t AS r,
employee_t AS e
WHERE scp.registrationID=r.registrationID AND r.sectionID=sec.sectionID
AND sec.facultyID=e.employeeID AND sec.year='$year' AND sec.semester='spring'
AND sec.facultyID IN ('$instructor1','$instructor2','$instructor3')
GROUP BY sec.facultyID";
$result=mysqli_query($con,$sql);
?>

function drawSpringChart() {
        var data = google.visualization.arrayToDataTable([
          ['Course Instructor','GPA'],
          
          <?php
            while($data=mysqli_fetch_array($result)){
                $courseInstructor=$data['firstName']." ".$data['lastName'];
              $GPA=$data['GPA'];
           ?>
           ['<?php echo $courseInstructor;?>',<?php echo $GPA;?>],   
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