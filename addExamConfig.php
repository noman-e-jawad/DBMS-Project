
  <?php
  include 'connect.php';

  if(isset($_POST['submit'])){

  $level1=array("arrange","count","define","describe","draw",
  "duplicate","identify","label","list","match","name",
  "order","point","quote","read","recall","recite",
  "recognize","record","repeat","reproduce","select",
  "state","write");

  $level2=array("associate","classify","compare","compute","contrast",
  "convert","describe","differentiate","discuss","distinguish","explain",
  "express","extend","generalize","give examples","identify","indicate",
  "locate","listing","matching","paraphrase","predict",
  "recognize","report","restate","review","rewrite","select","sort","summarize",
  "tell","translate");

  $level3=array("add","apply","calculate","choose","change","classify",
  "compete","compute","demonstrate","determine","develop","discover","divide",
  "dramatize","employ","examine","formulate","graph","illustrate","interpret","manipulate",
  "modify","multiply","operate","organize","perform","practice","predict","prepare",
  "produce","relate","schedule","sketch","shop","show","solve","subtract","translate","use");

  $level4=array("diagram","differentiate","discrimate","distinguish",
  "examine","estimate","experiment","extrapolet","formulate","identify",
  "illustrate","infer","inspect","inventory","outline","point out",
  "question","relate","select",
  "analyze","appraise","arrange","breakdown","calculate","combine",
  "contrast","compare","criticize","design","detect","determine",
  "develop","separate","subdivide","test","utilize");

  $level5=array("appraise","argue","assess","attack","choose",
  "compare","conclude","contrast","criticize","critique",
  "defend","determine","estimate","evaluate","grade","interpret",
  "judge","justify","measure","predict","rank","rate","revise",
  "score","select","support","test","value","weigh");

  $level6=array("arrange","assemble","categorize","collect",
  "combine","compile","compose","construct","create","debate",
  "derive","design","devise","explain","formulate","generate",
  "group","integrate","manage","modify","order","oragnize","plan",
  "prepare","prescribe","produce","propose","rearrange","reconstruct",
  "relate","reorganize","revise","rewrite","specify","summarize",
  "synthesize","tell","transform");

  $examName=$_POST['examName'];
  $sectionNum=$_POST['sectionNum'];
  $questionCount=$_POST['questionCount'];
  $courseID=$_POST['courseID'];
  $semester=$_POST['semester'];
  $year=$_POST['year'];

  //Getting section ID from database
  $result=mysqli_query($con,"SELECT sec.sectionID AS sectionID
  FROM section_t AS sec
  WHERE sec.sectionNum='$sectionNum' AND sec.courseID='$courseID' 
  AND sec.semester='$semester' AND sec.year='$year'");
  $row=mysqli_fetch_assoc($result); 
  $sectionID=$row['sectionID'];

  //storing exam in database
  $query="INSERT INTO `exam_t` (`examID`, `examName`, `sectionID`)
  VALUES (NULL, '$examName', '$sectionID')";
  $result=mysqli_query($con,$query);

  //getting the exam ID from database
  $result=mysqli_query($con,"SELECT MAX(examID) AS examID
  FROM exam_t");
  $row=mysqli_fetch_assoc($result); 
  $examID=$row['examID'];

  //Getting course ID from database
  $result=mysqli_query($con,"SELECT sec.courseID AS courseID
  FROM section_t AS sec
  WHERE sec.sectionID='$sectionID'");
  $row=mysqli_fetch_assoc($result); 
  $courseID=$row['courseID'];

  //Storing questions in database
  for($i=1;$i<=$questionCount;$i++){

    $difficultyLevel=0;

    $questionNum=$_POST["questionNum".$i];
    $questionDetails=$_POST["questionDetails".$i];
    $mark=$_POST["mark".$i];
    $coNum=$_POST["coNum".$i];
     
    if($difficultyLevel<=0){
        for($k=0;$k<sizeof($level1);$k++){
            if(strpos($questionDetails,$level1[$k])!==false){
                $difficultyLevel=1;
                break;
            }
        }
    }
    if($difficultyLevel<=0){
            for($k=0;$k<sizeof($level2);$k++){
                if(strpos($questionDetails,$level2[$k])!==false){
                    $difficultyLevel=2;
                    break;
                }
            } 
        }
    
    if($difficultyLevel<=0){
    for($k=0;$k<sizeof($level3);$k++){
        if(strpos($questionDetails,$level3[$k])!==false){
             $difficultyLevel=3;
             break;}
                } 
            }
    if($difficultyLevel<=0){
    for($k=0;$k<sizeof($level4);$k++){
        if(strpos($questionDetails,$level4[$k])!==false){
        $difficultyLevel=4;
        break;}
        } 
    }                
    if($difficultyLevel<=0){
     for($k=0;$k<sizeof($level5);$k++){
        if(strpos($questionDetails,$level5[$k])!==false){
            $difficultyLevel=5;
            break;
        }
         }
    } 
    if($difficultyLevel<=0){
        for($k=0;$k<sizeof($level6);$k++){
            if(strpos($questionDetails,$level6[$k])!==false){
                $difficultyLevel=6;
                break;
            }
        }  
    }           

    $query="insert into question_t (questionID,questionDetails,markPerQuestion,
    questionNum,difficultyLevel,examID,courseID,coNum)
    values('','$questionDetails','$mark','$questionNum',
    '$difficultyLevel','$examID','$courseID','$coNum')";

    $result=mysqli_query($con,$query);
  }
  header('location:addExam.php');
}
?>