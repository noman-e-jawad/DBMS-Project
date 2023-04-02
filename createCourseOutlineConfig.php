<?php
session_start();
include 'connect.php';

if(isset($_POST['submit'])){

    $courseCode=NULL;
    $secNum=NULL;
    $courseTitle=NULL;
    $prerequisite=NULL;
    $creditValue=NULL;
    $semesterName=NULL;
    $courseDescription=NULL;
    $courseObjective=NULL;
    $sectionID=NULL;
    $refMaterials=NULL;
    $topic=NULL;
    $learningStrategy=NULL;
    $assessmentStrategy=NULL;
    $correspondingclo=NULL;
    $queryResult=NULL;
    $courseContent=NULL;

    

    $courseCode=$_POST['courseCode'];
    $secNum=$_POST['secNum'];
    $courseTitle=$_POST['courseTitle'];
    $prerequisite=$_POST['prerequisite'];
    $creditValue=$_POST['creditValue'];
    $semesterName=$_POST['semesterName'];
    $courseDescription=$_POST['courseDescription'];
    $courseObjective=$_POST['courseObjective'];
    $sectionID=$_SESSION['sectionID'];
    $refMaterials=$_POST['refMaterials'];
    $courseContent=$_POST['courseContent'];

    $queryResult=mysqli_query($con,"INSERT INTO `course_outline_t`
     (`courseOutlineID`, `sectionID`, `semester`, `courseDescription`,
      `objective`, `content`, `refMaterials`, `sectionNum`, `courseTitle`,
       `prerequisiteCode`, `creditValue`)
        VALUES (NULL, '$sectionID', '$semesterName', '$courseDescription', '$courseObjective',
         '$courseContent','$refMaterials', '$secNum', '$courseTitle',
          '$prerequisite', '$creditValue')");

          //Getting course Outline ID from Database
          $res=mysqli_query($con,"SELECT courseOutlineID
          FROM course_outline_t AS cot
          WHERE cot.sectionID='$sectionID'");
          $row=mysqli_fetch_assoc($res); 
          $courseOutlineID=$row['courseOutlineID'];

      for($i=1;$i<=$_POST['topicNum'];$i++){
      $queryResult=NULL;
      $topic=$_POST["topic".$i];
      $learningStrategy=$_POST["learningStrategy".$i];
      $assessmentStrategy=$_POST["assessmentStrategy".$i];
      $correspondingclo=$_POST["correspondingclo".$i];

      $queryResult=mysqli_query($con,"INSERT INTO `lesson_plan_strategy_t` (`lPSID`, 
      `week`, `topic`, `learningStrategy`, `assessmentStrategy`,
      `correspondingClo`, `courseOutlineID`) VALUES (NULL, '$i', '$topic', '$learningStrategy',
       '$assessmentStrategy', '$correspondingclo', '$courseOutlineID')");
      }

      $j=1;
      
      for($i=1;$i<=$_POST['assessmentCount'];$i++){
        $queryResult=NULL;
        $assessmentType=$_POST["assessmentType".$i];
        $subTotal=$_POST["subTotal".$i];
        
        $assessmentTool1=$_POST["assessmentTool".$j];
        $markDistribution1=$_POST["markDistribution".$j];
        $bloomsCategory1=$_POST["bloomsCategory".$j];
         
        $j++;

        $assessmentTool2=$_POST["assessmentTool".$j];
        $markDistribution2=$_POST["markDistribution".$j];
        $bloomsCategory2=$_POST["bloomsCategory".$j];
        
        $j++;

        $assessmentTool3=$_POST["assessmentTool".$j];
        $markDistribution3=$_POST["markDistribution".$j];
        $bloomsCategory3=$_POST["bloomsCategory".$j];

        $j++;
  
        $queryResult=mysqli_query($con,"INSERT INTO `evaluation_strategy_t` 
        (`eSID`, `assessmentTool1`, `markDistribution1`, `bloomsCategory1`, 
        `courseOutlineID`, `assessmentTool2`, `assessmentTool3`, 
        `markDistribution2`, `markDistribution3`, `bloomsCategory2`, 
        `bloomsCategory3`, `assessmentType`,`subTotal`) VALUES 
        (NULL, '$assessmentTool1', '$markDistribution1', '$bloomsCategory1', 
        '$courseOutlineID', '$assessmentTool2', '$assessmentTool3',
         '$markDistribution2', '$markDistribution3',
          '$bloomsCategory2', '$bloomsCategory3', '$assessmentType','$subTotal')");
        }

      for($i=1;$i<=$_POST['cloCount'];$i++){
        $queryResult=NULL;
        $cloNum=$_POST["cloNum".$i];
        $clo=$_POST["clo".$i];
        $c=$_POST["c".$i];
        $p=$_POST["p".$i];
        $a=$_POST["a".$i];
        $s=$_POST["s".$i];
        $plo=$_POST["plo".$i];
        $correlation=$_POST["correlation".$i];
  
        $queryResult=mysqli_query($con,"INSERT INTO `clo_matrix_t` 
        (`clo_MatID`, `cloNum`, `coDescription`, `ploAssessed`, 
        `correlation`, `courseOutlineID`, `c`, `p`, `a`, `s`) 
        VALUES (NULL, '$cloNum', '$clo', '$plo', '$correlation', '$courseOutlineID', '$c', '$p', '$a', '$s')");
        }

      header('location:createCourseOutline.php');
     }
  ?>