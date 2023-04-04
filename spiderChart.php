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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Employee Dashboard</title>



  <!--Google Font-->
  <link rel="stylesheet" href="style.css">

  <!-- JS Charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    #chartdiv {
      width: 100%;
      height: 500px;
      background-color: pink;
    }

    .studentID:active {
      opacity: 0.5;
    }

    .enterButton {
      background: #6698FF;
      border-radius: 10px;
      border: none;
      outline: none;
      color: #fff;
      font-size: 14px;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      font-weight: bold;
      margin-left: 10px;
      height: 36px;
      width: 100px;

    }

    .enterButton:hover {
      background: linear-gradient(90deg, #87CEFA, #00BFFF);
    }

    .enterButton:active {
      opacity: 0.5;
    }
  </style>

</head>

<body class="dash-body">
  <?php require_once './template/header.php' ?>
  <div class="p-3">
    <h1>Spider Chart Analysis</h1>
  </div>

  <div class="container">

    <!-- div row-1 starts here -->
    <div class="row justify-content-center align-items-center pb-4">
      <form method="POST">

        <input class="studentID" type="text" placeholder="Enter Student ID" name="studentID" />

        <input class="btn-submit" type="submit" name="submit" value="Enter" />

      </form>
    </div> <!-- div row-1 ends here -->


    <!-- div row-2 -->
    <div style="display:flex;justify-content:center;margin-bottom:10px;">

      <button onclick="poView()" class="viewButton">view PO analysis</button>
      <button onclick="coView()" class="viewButton">View CO analysis</button>

    </div> <!-- div row-2 ends here -->

    <div class="container d-flex justify-content-center align-items-center">
      <canvas class="w-50 h-100 bg-transparent min-h-600px" id="myChart"></canvas>
    </div> <!-- div row-3 ends here -->

  </div> <!-- background div ends here -->

  <?php
  if (isset($_POST['submit'])) {
    $studentID = $_POST['studentID'];
  } ?>


  <script>

    function poView() {
      <?php
      $sql = "SELECT po.poNum AS poNum, 
   AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
   FROM registration_t AS r, answer_t AS ans, question_t AS q, 
   co_t AS co, po_t AS po
   WHERE r.registrationID=ans.registrationID 
   AND ans.examID=q.examID
   AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
   AND q.courseID=co.courseID AND co.poID=po.poID 
   AND r.studentID='$studentID'
   GROUP BY po.poNum";

      $result = mysqli_query($con, $sql);

      $po = array();
      $percent = array();

      while ($data = mysqli_fetch_array($result)) {

        array_push($po, "PO " . $data['poNum']);
        array_push($percent, $data['percent']);

      }

      ?>


      var po = <?php echo json_encode($po); ?>;
      var percent = <?php echo json_encode($percent); ?>;

      for (var i = 0; i < percent.length; i++) {
        percent[i] = parseFloat(percent[i]);
      }

      const ctx = document.getElementById('myChart');

      new Chart(ctx, {
        type: 'radar',
        data: {
          labels: po,
          datasets: [{
            label: 'PO Achieved',
            data: percent,
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
          }]
        },
        options: {
          elements: {
            line: {
              borderWidth: 3
            }
          }
        }
      });

    }

    function coView() {
      <?php
      $sql = "SELECT q.coNum, 
   AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
   FROM registration_t AS r, answer_t AS ans, question_t AS q, 
   co_t AS co, po_t AS po
   WHERE r.registrationID=ans.registrationID 
   AND ans.examID=q.examID
   AND ans.answerNum=q.questionNum AND q.coNum=co.coNum
   AND r.studentID='$studentID'
   GROUP BY q.coNum";

      $result = mysqli_query($con, $sql);

      $co = array();
      $percent = array();

      while ($data = mysqli_fetch_array($result)) {

        array_push($co, "CO " . $data['coNum']);
        array_push($percent, $data['percent']);

      }

      ?>


      var co = <?php echo json_encode($co); ?>;
      var percent = <?php echo json_encode($percent); ?>;

      for (var i = 0; i < percent.length; i++) {
        percent[i] = parseFloat(percent[i]);
      }

      const ctx = document.getElementById('myChart');

      new Chart(ctx, {
        type: 'radar',
        data: {
          labels: co,
          datasets: [{
            label: 'CO Achieved',
            data: percent,
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
          }]
        },
        options: {
          elements: {
            line: {
              borderWidth: 3
            }
          }
        }
      });

    }


  </script>



</body>

</html>