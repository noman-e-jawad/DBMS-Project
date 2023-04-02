<?php

include 'connect.php';

if(isset($_POST['submit'])){

    $examName=$_POST['examName'];
    $courseID=$_POST['courseID'];
    $sectionNum=$_POST['sectionNum'];
    $studentID=$_POST['studentID'];
    $semester=$_POST['semester'];
    $year=$_POST['year'];
   

  //Getting section ID from database
  $result=mysqli_query($con,"SELECT sec.sectionID AS sectionID
  FROM section_t AS sec
  WHERE sec.sectionNum='$sectionNum' AND sec.courseID='$courseID' 
  AND sec.semester='$semester' AND sec.year='$year'");
  $row=mysqli_fetch_assoc($result); 
  $sectionID=$row['sectionID'];

  //Getting exam ID from database
  $result=mysqli_query($con,"SELECT exam.examID AS examID
  FROM exam_t AS exam
  WHERE exam.examName='$examName' AND exam.sectionID='$sectionID'");
  $row=mysqli_fetch_assoc($result); 
  $examID=$row['examID'];

  //Getting questions from database
  $result=mysqli_query($con,"SELECT *
  FROM question_t AS q
  WHERE q.examID='$examID'");
   
      header('location:submitAnswerScript.php');
     }

?>