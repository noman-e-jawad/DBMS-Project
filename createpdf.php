 <?php
 require_once __DIR__ . '/vendor/autoload.php';

 use Dompdf\Dompdf;

 session_start();

 include 'connect.php';

 $html=NULL;

 $sectionID=$_SESSION['sectionID'];

$res=mysqli_query($con,"SELECT sec.courseID AS courseCode, 
cot.semester AS semester, cot.creditValue AS creditValue, 
cot.courseTitle AS courseTitle, cot.prerequisiteCode 
AS prerequisite, cot.sectionNum AS sectionNum, 
cot.content AS courseContent, cot.objective AS courseObjective, cot.courseDescription AS courseDescription
FROM course_outline_t AS cot, section_t AS sec
WHERE cot.sectionID=sec.sectionID AND cot.sectionID='$sectionID'");

if(mysqli_num_rows($res)>0){
	$html='<style>.rectangle {
        height:22px;
        width:100%;
        background-color: rgb(51, 51, 230);
      }
      .text_of_headers{
        padding-left: 30px;
        font-size: 20px;
        color: white;
      }
      .course_outline_heading{
        padding-left:5px;
        background-color:#002db3;
        color:white;
        font-family: Arial, Helvetica, sans-serif;
        font-weight:bold;
        text-transform: uppercase;
        font-size:14px;
        height:20px;
        padding-top:5px;;
          
      }
      table {
        border-collapse: collapse;
        width:100%;
        border:1px solid rgb(255, 255, 255);
        table-layout:fixed;
      }
      th, td {
        border:1px solid black;
        width:100%;
        text-align:left;
        font-family: Arial, Helvetica, sans-serif;
        font-size:14px;
      }

      p{
        font-family: Arial, Helvetica, sans-serif;
        font-size:14px;
      }

      .courseDescription{
          padding-left:5px;
          background-color:#002db3;
          color:white;
          font-family: Arial, Helvetica, sans-serif;
          font-weight:bold;
          text-transform: uppercase;
          font-size:14px;
          height:20px;
          padding-top:5px;
      }
    </style>

      <div>
      <div><p class="course_outline_heading">Course Outline</p>
      </div>
      <table>';
		$html.='<tr>';
		while($row=mysqli_fetch_assoc($res)){
          $html.= '<th>Course Code</th>
            <td>'.$row['courseCode'].'</td>
            <th>Course Title</th>
            <td>'.$row['courseTitle'].'</td>
        </tr>
        <tr>
            <th>Section</th>
            <td>'.$row['sectionNum'].'</td>
            <th>Prerequisite</th>
            <td>'.$row['prerequisite'].'</td>
        </tr>
        <tr>
            <th>Credit Value</th>
            <td>'.$row['creditValue'].'</td>
            <th>Semester</th>
            <td>'.$row['semester'].'</td>
        </tr>';
	$html.='</table>
    </div>';

   $html.='<div style="margin-top:15px;">
    <div><p class="courseDescription">Course Description</p></div>
    <p style="margin-top:0px;">'.$row['courseDescription'].'</p>
  </div>';

  $html.='<div style="margin-top:15px;">
  <div><p class="courseDescription">Course Objective</p></div>
  <p>'.nl2br($row['courseObjective']).'</p>
</div>

<div style="margin-top:15px;">
  <div><p class="courseDescription">Course Policy</p></div>
  <p>1) It is the student’s responsibility to gather information about the assignments/project and cover topics 
      during the lectures missed. Regular class attendance is mandatory. Points will be taken off for missing 
      classes. Without 70% of attendance, sitting for the final exam is NOT allowed. Students should come on 
      time to get the attendance. In the event of failing 70% of attendance, a student will receive a W grade 
      automatically. 
      <br><br> 
      2) Same project work is assigned to all sections. Students should work in groups for the project. They are 
      required to prepare a final report on the project which will be incrementally developed through 
      assignments. 
      <br><br>
      3) The date and syllabus of class tests, Mid-Term and Final-Term will be announced in the class. There is NO 
      provision for make-up. 
      <br><br>
      4) Both the Mid-Term and Final-Term exams will be coordinated exams and will be held on a specific date 
      for all the sections. 
      <br><br>
      5) The reading materials for each class will be given prior to that class so that students may have a cursory 
      look into the materials. 
      <br><br>
      6) Class participation is vital for a better understanding of the topics of this course. Students are invited to 
      raise questions.
      <br><br>
      7) Students should take tutorials with the instructor during office hours. Prior appointment is required.
      <br><br>
      8) Students must maintain the IUB code of conduct and ethical guidelines offered by the school of computer 
      science and engineering.
      <br><br>
      9) No working mobile phones are allowed in class. Using one for any purpose will result in serious 
      consequences.
  </p>
</div>

<div style="margin-top:15px;">
<div><p class="courseDescription">Academic Dishonesty</p></div>
  <p> 1) A student who cheats, plagiarizes, or furnishes false, misleading information in the course is subject to 
      disciplinary action up to and including an F grade in the course and/or suspension/expulsion from the 
      University.
      <br><br>
      2) Students must maintain the code of IUB.
      <br><br>
      3) The goal of homework is to give you practice in mastering the course material. Consequently, you are 
      encouraged to collaborate on problem sets. In fact, students who form study groups generally do better on 
      exams than do students who work alone. If you do work in a study group, however, you owe it to yourself 
      and your group to be prepared for your study group meeting. Specifically, you should spend at least 30-45 
      minutes trying to solve each problem beforehand by yourself. If your group is unable to solve a problem, 
      talk to other groups or ask your recitation instructor or teaching assistant assigned to your class.
      <br><br>
      4) You must write up each problem solution by yourself without assistance. It is a violation of this policy to 
      submit a problem solution that you cannot orally explain to a member of the course staff.
      <br><br>
      5) No collaboration whatsoever is permitted during examination.
      <br><br>
      6) Plagiarism and other anti-intellectual behavior cannot be tolerated in any academic environment that 
      prides itself on individual accomplishment. If you have any questions about the collaboration policy, or if 
      you feel that you may have violated the policy, please talk to one of the course staff. Although the course 
      staff is obligated to deal with cheating appropriately, we are more understanding and lenient if we find out 
      from the transgressor himself or herself rather than from a third party or by ourselves.
  </p>

</div>

<div style="margin-top:15px;">
<div><p class="courseDescription">student with disabilities and stress</p></div>
  <p>Students with disabilities are required to inform the Department of Computer Science & Engineering of any 
      specific requirement for classes or examination as soon as possible. Additionally, if you experience significant 
      stress or worry, changes in mood, or problems eating or sleeping this semester, whether because of this or 
      any other courses or factors, please do not hesitate to reach out immediately, at any hour, to any of the 
      course’s heads to discuss.
      </p>
</div>

<div style="margin-top:15px;">
<div><p class="courseDescription">non discremination policy</p></div>
  <p>The course and University policy prohibit discrimination based on race, color, religion, sex, marital or parental 
      status, national origin or ancestry, age, mental or physical disability, sexual orientation, military status. If you 
      see either by course instructor or any other person related to course showing any form of discrimination, 
      please inform the proctors office of the wrongdoing.
      </p>
</div>

<div style="margin-top:15px;">
<div><p class="courseDescription">Course content</p></div>
  <p>'.nl2br(nl2br($row['courseContent'])).'</p>
</div>';
}
}

 //Getting course Outline ID from Database
 $res=mysqli_query($con,"SELECT courseOutlineID
 FROM course_outline_t AS cot
 WHERE cot.sectionID='$sectionID'");
 $row=mysqli_fetch_assoc($res); 
 $courseOutlineID=$row['courseOutlineID'];

 //Getting Clo matrix details from Database
 $res=mysqli_query($con,"SELECT clomat.cloNum AS cloNum, 
 clomat.codescription AS coDescription, clomat.ploAssessed 
 AS ploAssessed, clomat.correlation AS correlation, clomat.c 
 AS c,clomat.p AS p,clomat.a AS a,clomat.s AS s
 FROM clo_matrix_t AS clomat, course_outline_t AS cot
 WHERE clomat.courseOutlineID=cot.courseOutlineID AND cot.courseOutlineID='$courseOutlineID'");

$html.='<div style="margin-top:15px;">
    <div><p class="courseDescription">COURSE LEARNING OUTCOME (CLO) MATRIX</p></div>
    <table>
        <tr >
            <th style="background-color:#002db3;color:white;text-align:center;" rowspan="2">CLOs</th>
            <th style="background-color:#002db3;color:white;text-align:center;" rowspan="2">CO Description</th>
            <th style="background-color:#002db3;color:white;text-align:center;" colspan="4">Blooms Taxonomy</th>
            <th style="background-color:#002db3;color:white;text-align:center;" rowspan="2">PLO Assessed</th>
            <th style="background-color:#002db3;color:white;text-align:center;" rowspan="2">CLO – PLO Correlation **</th>
        </tr>
        <tr >
          <th style="background-color:#002db3;color:white;text-align:center;">C</th>
          <th style="background-color:#002db3;color:white;text-align:center;">P</th>
          <th style="background-color:#002db3;color:white;text-align:center;">A</th>
          <th style="background-color:#002db3;color:white;text-align:center;">S</th>
        </tr>';

   if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_assoc($res)){
     $html.='<tr>
          <th>'."CLO".$row['cloNum'].'</th>
          <th>'.$row['cloNum'].'</th>
          <th>'.$row['c'].'</th>
          <th>'.$row['p'].'</th>
          <th>'.$row['a'].'</th>
          <th>'.$row['s'].'</th>
          <th>'.$row['ploAssessed'].'</th>
          <th>'.$row['correlation'].'</th>
        </tr>';
    }
    $html.='<th colspan="8">*Blooms Learning Level: Numbers signifies the Level of Blooms skills.<br> **CLO – PLO Correlation: 3 – high, 2 – medium, 1- low</th>
    </tr>
    </table>
    </div>';

   $res=mysqli_query($con,"SELECT lsp.week AS week, lsp.topic 
   AS topic, lsp.learningStrategy AS learningStrategy, lsp.assessmentStrategy 
   AS assessmentStrategy, lsp.correspondingClo AS correspondingClo
   FROM lesson_plan_strategy_t AS lsp, course_outline_t AS cot
   WHERE lsp.courseOutlineID=cot.courseOutlineID AND cot.courseOutlineID='$courseOutlineID'");

    $html.='<div style="margin-top:20px;">
    <div><p class="courseDescription">lesson planning with mapping of clo,teaching and assessment strategies</p></div>
    <table>
        <tr>
            <th style="text-align:center;">Week</th>
            <th style="text-align:center;">Topic</th>
            <th style="text-align:center;">Teaching-Learning Strategy</th>
            <th style="text-align:center;">Assessment Stetragy</th>
            <th style="text-align:center;">Corresponding CLOs</th>
        </tr>';

        if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_assoc($res)){
        $html.='<tr>
            <td style="text-align:center;">'.$row['week'].'</td>
            <td>'.nl2br($row['topic']).'</td>
            <td style="text-align:center;">'.$row['learningStrategy'].'</td>
            <td style="text-align:center;">'.$row['assessmentStrategy'].'</td>
            <td style="text-align:center;">'.$row['correspondingClo'].'</td>
        </tr>';
    }    
  $html.='</div><br><br><br><br><br>';
}

//Getting Evaluation Strategy details from Database
$res=mysqli_query($con,"SELECT e.assessmentType, 
e.assessmentTool1, e.assessmentTool2, e.assessmentTool3, 
e.markDistribution1,e.markDistribution2,e.markDistribution3,
e.bloomsCategory1,e.bloomsCategory2,e.bloomsCategory3,e.subTotal
FROM evaluation_strategy_t AS e, course_outline_t AS cot
WHERE e.courseOutlineID=cot.courseOutlineID AND cot.courseOutlineID='$courseOutlineID'");

$html.='<div style="margin-top:20px;">
<div><p class="courseDescription">Assessment and Evaluation</p></div>
<table>
<tr>
  <th>Assessment Type</th>
  <th>Assessment Tools</th>
  <th>Marks Distribution</th>
  <th>Blooms Category</th>
  <th>Sub Total</th>
</tr>';

  if(mysqli_num_rows($res)>0){
  while($row=mysqli_fetch_assoc($res)){

  $html.='<tr>
  <td rowspan="3">'.$row['assessmentType'].'</td>
  <td>'.$row['assessmentTool1'].'</td>
  <td>'.$row['markDistribution1'].'</td>
  <td>'.$row['bloomsCategory1'].'</td>
  <td rowspan="3">'.$row['subTotal'].'%</td>
</tr>
<tr>

  <td>'.$row['assessmentTool2'].'</td>
  <td>'.$row['markDistribution2'].'</td>
  <td>'.$row['bloomsCategory2'].'</td>
</tr>
<tr>
  
  <td>'.$row['assessmentTool3'].'</td>
  <td>'.$row['markDistribution3'].'</td>
  <td>'.$row['bloomsCategory3'].'</td>
</tr>';
  }
}
$html.='<tr>
<td td colspan="4" style="text-align:right;"></td>
<td style="font-weight:bolder;text-align:center;">Total : 100%</td>
</tr>
</table>
</div>';


  
$html.='<div style="margin-top:15px;">
    <p style="text-align:center;font-weight:bold;">The following chart will be followed for grading. Please note that for each category.<br>
    * Numbers are inclusive<br></p>

    </div>

    <div style="margin-top:15px;">
      <table>
    <tr>
        <th>A</th>
        <th>A-</th>
        <th>B+</th>
        <th>B</th>
        <th>B-</th>
        <th>C+</th>
        <th>C</th>
        <th>C-</th>
        <th>D+</th>
        <th>D</th>
        <th>F</th>
    </tr>
    <tr>
      <td>90-100</td>
      <td>85-89</td>
      <td>80-84</td>
      <td>75-79</td>
      <td>70-74</td>
      <td>65-69</td>
      <td>60-64</td>
      <td>55-59</td>
      <td>50-54</td>
      <td>45-49</td>
      <td>0-44</td>
    </tr>
    </table>
    </div>';

    $res=mysqli_query($con,"SELECT cot.refMaterials AS refMaterials
    FROM course_outline_t AS cot, section_t AS sec
    WHERE cot.sectionID=sec.sectionID AND cot.sectionID='$sectionID'");

    $row=mysqli_fetch_assoc($res);

    $html.='<div style="margin-top:15px;" >
    <div><p class="courseDescription">REFERENCE BOOK AND ADDITIONAL MATERIALS</p></div>
    <p>'.nl2br(nl2br($row['refMaterials'])).'</p>
  </div>';
}

else{
	$html="Data not found";
}

$dompdf= new Dompdf;

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream("courseOutline.pdf",["Attachment"=>0]);

?>