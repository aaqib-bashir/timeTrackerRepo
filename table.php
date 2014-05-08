 <?php
 include('db.php');
// $userid=$_COOKIE["userid"];
 echo '<link rel="stylesheet" href="CSS/default.css">';
 echo '<table border = 1 id="table1" class="dashboard_table">';
        echo '<tr>';
            echo '<th>Task Name</th>';
            echo '<th>Project</th>';
            echo '<th>startdate</th>';
			echo ' <th>starttime</th>';
			echo ' <th>endtime</th>';
			echo ' <th>duration</th>';
        echo ' </tr>';
    $result = mysql_query("SELECT * FROM task where userid=1");
    while($row=mysql_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['taskname'] . "</td>";
        echo "<td>" . $row['project'] . "</td>";
        echo "<td>" . $row['startdate'] . "</td>";
		echo "<td>" . $row['starttime'] . "</td>"; 
		echo "<td>" . $row['endtime'] . "</td>";
		echo "<td>" . $row['duration'] . "</td>";  
        echo "</tr>";
    }
    echo '</table>';
?>