<?php

ob_start();
?>
<div class="nav">

    <div class="nav-header">
        <div class="nav-title">
            SPMS 4.0
        </div>
    </div>

    <div class="nav-links">
        <ul>
            <li><a href="employee_dashboard.php" target="_self">Dashboard</a></li>
            <li><a href="ploAnalysis.php" target="_self">PLO Analysis</a></li>
            <li><a href="ploAchieveStats.php" target="_self">PLO Achievement Stats</a></li>
            <li><a href="spiderChart.php" target="_self">Spider Chart Analysis</a></li>
            <li><a href="exam.php" target="_self">Exam</a></li>
            <li><a href="viewCourseOutline.php" target="_self">View course Outline</a></li>
            <li><a href="enrollmentStatistics.php" target="_self">Enrollment Stats</a></li>
            <li><a href="performanceStats.php" target="_self">GPA Analysis</a></li>
            <li><a href="logout.php" target="_self">Logout</a></li>
        </ul>
    </div>
</div>
<?php

$html = ob_get_clean();

echo ($html);