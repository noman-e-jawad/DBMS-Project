
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
    <link rel="stylesheet" href="questionform.css">
    
  <style>

  body{
    background-color:#155977;
  }

  .paragraph{
    display:inline-block;
    font-family: Arial, Helvetica, sans-serif;
    font-weight:bold;
    color:white;
    font-size:20px;
  }

  label{
    font-size:20px;
    font-family: Arial, Helvetica, sans-serif;
    text-transform: uppercase;
  }

  .main-container{
    border:3px solid #6698FF;
    margin-top:15px;
    margin-bottom:15px;
    width:75%;
   
  }

  .form-container{
   
    margin-top:15px;
    margin-bottom:15px;
    width:45%;
  }

  .studentID{
    width:100%;
    margin-bottom:10px;
    font-family: Arial, Helvetica, sans-serif;
    font-size:25px;
    border:4px solid #87CEFA;
    background-color:#6698FF;
    color:white;
  }

  .studentID:hover{
    background:linear-gradient(90deg,#87CEFA,#00BFFF);
    }
    .studentID:active{
    opacity: 0.5;
    }

    .heading{
        margin-top:10px;
        font-family: Arial, Helvetica, sans-serif;
        font-size:30px;
        text-align:center;
        color:#87CEFA;
        font-weight:bolder;

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
          <li><a href="addExam.php" target="_self">Add Exam</a></li>
          <li><a href="exam.php" target="_self">View Exam</a></li>
          <li><a href="logout.php" target="_self">Logout</a></li>
            </ul>
        </div>
      </div>

  <!-- div row-1 starts here -->
  
  <?php

  session_start();

  include 'connect.php';

   $examName=$_SESSION['examName'];
   $courseID=$_SESSION['courseID'];
   $sectionNum=$_SESSION['sectionNum'];
   $semester=$_SESSION['semester'];
   $year=$_SESSION['year'];

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
    
    //Getting Answer Scripts from database
    $result=mysqli_query($con,"SELECT q.questionNum 
    AS questionNum,q.difficultyLevel AS difficultyLevel,
    q.markPerQuestion AS mark, q.questionDetails 
    AS questionDetails,reg.studentID AS studentID, 
    ans.answerDetails
    FROM registration_t AS reg, question_t AS q, answer_t AS ans
    WHERE reg.registrationID=ans.registrationID 
    AND ans.examID=q.examID AND ans.answerNum=q.questionNum 
    AND q.examID='$examID'"); 

    //Getting number of questions
    $queryResultReturn=mysqli_query($con,"SELECT COUNT(*) AS num
    FROM question_t AS q
    WHERE q.examID='$examID'
    GROUP BY q.examID"); 
    $resultRow=mysqli_fetch_assoc($queryResultReturn); 
    $answerNum=$resultRow['num'];
    $_SESSION['answerNum']=$answerNum;

    //Using loop to display all the questions 
    while($row=mysqli_fetch_assoc($result)){
    
    $questionNum=$row['questionNum'];
    $difficultyLevel=$row['difficultyLevel'];
    $mark=$row['mark'];
    $questionDetails=$row['questionDetails'];
    $studentID=$row['studentID'];
    $answerScript=$row['answerDetails'];

      echo '<div style="display:flex;justify-content:center;">
      <div class="main-container">   

      <div style="display:flex;justify-content:space-evenly;padding-top:10px;">
       
      <div>
         <label class="question-form">
         Question No.  
         </label>
         <p class="paragraph">'.$questionNum.'</p>
         </div>
         
         <div>
         <label class="question-form">
          Domain :
         </label>
         <p class="paragraph">Cognitive</p>
         </div>

         <div>
         <label class="question-form">
           level :
         </label>
         <p class="paragraph">'.$difficultyLevel.'</p>
         </div>

         <div>
         <label class="question-form">
           Mark :
         </label>
         <p class="paragraph">'. $mark.'</p>
         </div>

      </div>  
       
       <div style="padding-top:10px;border:3px solid #6698FF;">
         <label class="question-form">
           Question :
         </label>
         <p class="paragraph">'.$questionDetails.'</p>
       </div> 

       <div style="padding-top:10px;border:3px solid #6698FF;">
         <label class="question-form">
           Student ID :
         </label>
         <p class="paragraph">'.$studentID.'</p><br>
         <label class="question-form">
           Answer :
         </label>
         <p class="paragraph">'.$answerScript.'</p>
       </div> 
    
      </div>
      </div>'; 
    }

  //loop php part ends here
    ?>

    <p class="heading">Exam Evaluation</p>

      <form method="post">

    <div style="display:flex;justify-content:center;">
      <div class="form-container">  
      <input class="studentID" type="text" placeholder="Enter Student ID" name="studentID"/>
      <input class="studentID" type="text" placeholder="Enter Mark Obtained for Question-1" name="ansMark1"/>
      <input class="studentID" type="text" placeholder="Enter Mark Obtained for Question-2" name="ansMark2"/>
      <input class="studentID" type="text" placeholder="Enter Mark Obtained for Question-3" name="ansMark3"/>
      <input class="studentID" type="text" placeholder="Enter Mark Obtained for Question-4" name="ansMark4"/>
      <input class="studentID" type="text" placeholder="Enter Mark Obtained for Question-5" name="ansMark5"/>
      <input class="studentID" type="text" placeholder="Enter Mark Obtained for Question-6" name="ansMark6"/>
      <input style="margin-bottom:0px;" class="studentID" type="text" placeholder="Enter Mark Obtained for Question-7" name="ansMark7"/>
      </div>  
    </div>

      <div style="display:flex;justify-content:center;margin-bottom:25px;">
      <input type="submit" style="margin-top:20px;margin-left:0px;" name="submitMark" value="Submit" class="submitButton">
      </div>

      </form>

  <?php
    if(isset($_POST['submitMark'])){

        $studentID=$_POST["studentID"];

        //Getting registration ID from database
        $queryResultReturn=mysqli_query($con,"SELECT reg.registrationID 
        AS registrationID
        FROM registration_t AS reg
        WHERE reg.studentID='$studentID' AND reg.sectionID='$sectionID'"); 
        $resultRow=mysqli_fetch_assoc($queryResultReturn); 
        $registrationID=$resultRow['registrationID'];

       for($i=1;$i<=$_SESSION['answerNum'];$i++){

        $obtainedMark=$_POST["ansMark".$i];

        $queryResult=mysqli_query($con,"UPDATE answer_t
        SET markObtained=$obtainedMark
        WHERE registrationID='$registrationID' 
        AND examID='$examID' AND answerNum='$i'");

       }
       header('location:answerScriptGrading.php');
       }
    ?>

  </body>

</html>