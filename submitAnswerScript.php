
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
   $studentID=$_SESSION['studentID'];
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
    
    //Getting questions from database
    $result=mysqli_query($con,"SELECT *
    FROM question_t AS q
    WHERE q.examID='$examID'"); 

    //Getting number of questions
    $queryResultReturn=mysqli_query($con,"SELECT COUNT(*) AS num
    FROM question_t AS q
    WHERE q.examID='$examID'
    GROUP BY q.examID"); 
    $resultRow=mysqli_fetch_assoc($queryResultReturn); 
    $answerNum=$resultRow['num'];
    $_SESSION['answerNum']=$answerNum;

    //Getting registration ID from database
    $queryResultReturn=mysqli_query($con,"SELECT reg.registrationID 
    AS registrationID
    FROM registration_t AS reg
    WHERE reg.studentID='$studentID' AND reg.sectionID='$sectionID'"); 
    $resultRow=mysqli_fetch_assoc($queryResultReturn); 
    $registrationID=$resultRow['registrationID'];
    
    //Using loop to display all the questions 
    while($row=mysqli_fetch_assoc($result)){
    
    $questionNum=$row['questionNum'];
    $difficultyLevel=$row['difficultyLevel'];
    $mark=$row['markPerQuestion'];
    $questionDetails=$row['questionDetails'];

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
    
      </div>
      </div>'; 
    }

  //loop php part ends here
  ?>
  <form method="post">
       <div style="display:flex;justify-content:center;">
       <div style="border:3px solid #6698FF;width:75%;">
       <textarea style="width:100%;" name="answer1" cols="30" rows="10" placeholder="Enter your answer"></textarea>
       </div>

       </div>

       <div style="display:flex;justify-content:center;">
       <div style="border:3px solid #6698FF;width:75%;">
       <textarea style="width:100%;" name="answer2" cols="30" rows="10" placeholder="Enter your answer"></textarea>
       </div>

       </div>

       <div style="display:flex;justify-content:center;">
       <div style="border:3px solid #6698FF;width:75%;">
       <textarea style="width:100%;" name="answer3" cols="30" rows="10" placeholder="Enter your answer"></textarea>
       </div>

       </div>

       <div style="display:flex;justify-content:center;">
       <div style="border:3px solid #6698FF;width:75%;">
       <textarea style="width:100%;" name="answer4" cols="30" rows="10" placeholder="Enter your answer"></textarea>
       </div>

       </div>

       <div style="display:flex;justify-content:center;">
       <div style="border:3px solid #6698FF;width:75%;">
       <textarea style="width:100%;" name="answer5" cols="30" rows="10" placeholder="Enter your answer"></textarea>
       </div>

       </div>

       <div style="display:flex;justify-content:center;">
       <div style="border:3px solid #6698FF;width:75%;">
       <textarea style="width:100%;" name="answer6" cols="30" rows="10" placeholder="Enter your answer"></textarea>
       </div>

       </div>

       <div style="display:flex;justify-content:center;">
       <div style="border:3px solid #6698FF;width:75%;">
       <textarea style="width:100%;" name="answer7" cols="30" rows="10" placeholder="Enter your answer"></textarea>
       </div>

       </div>

  <div style="display:flex;justify-content:center;margin-bottom:25px;">
  <input type="submit" style="margin-top:20px;margin-left:0px;" name="submitAnswerScript" value="Submit" class="submitButton">
  </div>

  </form>

  <?php
    if(isset($_POST['submitAnswerScript'])){
       for($i=1;$i<=$_SESSION['answerNum'];$i++){
          
        $answerDetails=$_POST["answer".$i];
  
        $queryResult=mysqli_query($con,"INSERT INTO `answer_t` 
        (`answerID`, `answerDetails`, `answerNum`, `markObtained`, 
        `registrationID`, `questionID`, `examID`) 
        VALUES (NULL, '$answerDetails', '$i', NULL, '$registrationID', '', '$examID')");

       }
       header('location:submitAnswerScript.php');
       }
    ?>

  </body>

</html>