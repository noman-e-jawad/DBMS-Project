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


    <style>
        body{
            background-color:#155977;
        }

        ::placeholder{
          color:white;
        }

        ::-ms-input-placeholder{
          color:white;
        }

        :-ms-input-placeholder{
          color:white;
        }

    </style>

  </head>

  <body>
    <!--
    <div class="container" id="logoutbutton">
    <a href="logout.php" class="btn btn-primary mb-5">Logout</a>
    </div>
    -->

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
          <li><a href="ploAnalysisDepartmentProgramSchoolAverage.php" target="_self">PLO Analysis With Department/Program/School Average</a></li>
          <li><a href="ploAnalysisOverall.php" target="_self">PLO Analysis (Overall, CO Wise, Course Wise)</a></li>
          <li><a href="logout.php" target="_self">Logout</a></li>
            </ul>
        </div>
      </div>

<div class="background">

      <div style="height:80px;"class="row1">
        <form method="POST">
        <input style="background-color:#6698FF;height:50px;border: 1px solid;cursor: pointer;border-radius: 5px;font-size: 14px;letter-spacing:2px;
                      font-weight: bold;text-transform:uppercase; border: none;outline: none;text-align: center;margin-right:20px;
                      color:white;margin-left:43%;margin-top:13px;" type="text" placeholder="Enter Student ID" name="studentID"/>
             
        <input style="background:#00BFFF;border-radius:10px; border:none;outline:none;color:#fff;font-size:14px;
                    letter-spacing:2px;text-transform:uppercase;cursor:pointer;font-weight:bold;margin-left:5px;height: 36px;width: 100px;"
              
        type="submit" name="submit" value="Submit"/>
        </form>
        </div>

      <div style="display:flex;justify-content:space-around" class="row2">
        <button onclick="ploAnalysisWithDepartmentAverage()" style="width:300px;margin-left:0px;" class="School-wise">PLO Analysis with Department Average</button>
        <button onclick="ploAnalysisWithProgramAverage()" style="width:300px;" class="Department-wise">PLO Analysis with Program Average</button>
        <button onclick="ploAnalysisWithSchoolAverage()" style="width:300px;" class="Program-wise">PLO Analysis with School Average</button>
      </div>
    
     <div style="display:flex;justify-content:center;" class="row3" style="margin-top:20px;"> 
       <div id="Autumn" style="width: 65%; height: 500px; display:inline-block;margin-top:23px;"></div>
       
     </div>
</div>    

<?php
if(isset($_POST['submit'])){
  $studentID=$_POST['studentID'];
}
?>

<!-- Analysis with Department Average -->
<script>
    function ploAnalysisWithDepartmentAverage(){
    <?php

    $sql="SELECT plo.ploNum AS ploNum, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo
    WHERE r.registrationID=ans.registrationID 
    AND ans.examID=q.examID AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND r.studentID='$studentID'
    GROUP BY plo.ploNum,r.studentID";

    $result=mysqli_query($con,$sql);

    $sql2="SELECT plo.ploNum AS ploNum, AVG((ans.markObtained/q.markPerQuestion)*100) 
    AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo, student_t AS s WHERE r.studentID=s.studentID 
    AND r.registrationID=ans.registrationID AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum 
    AND q.coNum=co.coNum AND q.courseID=co.courseID AND co.ploID=plo.ploID
    AND s.departmentID=(SELECT s.departmentID FROM student_t AS s 
    WHERE s.studentID='$studentID')
    GROUP BY plo.ploNum";

    $result2=mysqli_query($con,$sql2);

    ?>
    
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawAutumnChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['ploNum','Individual','Dept Average'],
          
          <?php
            while($data=mysqli_fetch_array($result)){
              $data2=mysqli_fetch_array($result2);
              $ploNum="PLO".$data['ploNum'];
              $percent=$data['percent'];
              $percent2=$data2['percent'];
           ?>

           ['<?php echo $ploNum;?>',<?php echo $percent;?>,<?php echo $percent2;?>],   
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
function ploAnalysisWithProgramAverage(){
    <?php

    $sql="SELECT plo.ploNum AS ploNum, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo
    WHERE r.registrationID=ans.registrationID 
    AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND r.studentID='$studentID'
    GROUP BY plo.ploNum,r.studentID";

    $result=mysqli_query($con,$sql);

    $sql2="SELECT plo.ploNum AS ploNum, 
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

    $result2=mysqli_query($con,$sql2);

    ?>
    
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawAutumnChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['ploNum','Individual','Program Average'],
          
          <?php
            while($data=mysqli_fetch_array($result)){
              $data2=mysqli_fetch_array($result2);
              $ploNum="PLO".$data['ploNum'];
              $percent=$data['percent'];
              $percent2=$data2['percent'];
           ?>

           ['<?php echo $ploNum;?>',<?php echo $percent;?>,<?php echo $percent2;?>],   
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
function ploAnalysisWithSchoolAverage(){

    <?php

$sql="SELECT plo.ploNum AS ploNum, 
AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
FROM registration_t AS r, answer_t AS ans, question_t AS q, 
co_t AS co, plo_t AS plo
WHERE r.registrationID=ans.registrationID 
AND ans.examID=q.examID
AND ans.answerNum=q.questionNum  AND q.coNum=co.coNum 
AND q.courseID=co.courseID AND co.ploID=plo.ploID 
AND r.studentID='$studentID'
GROUP BY plo.ploNum,r.studentID";

$result=mysqli_query($con,$sql);

$sql2="SELECT plo.ploNum AS ploNum, 
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

$result2=mysqli_query($con,$sql2);

?>

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawAutumnChart);

  function drawAutumnChart() {
    var data = google.visualization.arrayToDataTable([
      ['ploNum','Individual','School Average'],
      
      <?php
        while($data=mysqli_fetch_array($result)){
          $data2=mysqli_fetch_array($result2);
          $ploNum="PLO".$data['ploNum'];
          $percent=$data['percent'];
          $percent2=$data2['percent'];
       ?>

       ['<?php echo $ploNum;?>',<?php echo $percent;?>,<?php echo $percent2;?>],   
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