<?php
	require 'header.php';
    ?>
<?php
//connecting the database.
require 'connect.php';
//query to show all teams:
	$stmt = "SELECT * FROM teams ORDER BY points DESC";
	$result =$pdo->query($stmt);

        if ($result->rowCount() > 0) {
            $cooks=1;
            echo "<h2>Teams Details</h2>";
            echo "<form method='post' action='chartjs.php'>";
            echo "<table border='1'>";
            echo "<tr><th>Select Teams</th><th>Team ID</th><th>Team Name</th><th>City</th><th>Manager</th><th>Games Played</th><th>Games won</th><th>Games drawn</th><th>Games lost</th><th>Games for</th><th>Games against</th><th>Goal difference</th><th>Points</th><th>Update</th><th>Delete</th></tr>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='team_id[]' value='" . $row['teamId'] . "'></td>";
                echo "<td>" . $cooks . "</td>";
                //echo "<td>" . $row['teamId'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['manager'] . "</td>";
                echo "<td>" . $row['played'] . "</td>";
                echo "<td>" . $row['won'] . "</td>";
                echo "<td>" . $row['drawn'] . "</td>";
                echo "<td>" . $row['lost'] . "</td>";
                echo "<td>" . $row['for'] . "</td>";
                echo "<td>" . $row['against'] . "</td>";
                echo "<td>" . $row['gd'] . "</td>";
                echo "<td>" . $row['points'] . "</td>";
                echo '<td><a href="updateTeam.php?editTeam_id='.$row['teamId'].'">Edit</a></td>';
		echo '<td><a href="updateTeam.php?deleteTeam_id='.$row['teamId'].'">delete</a></td></tr>';
                $cooks++;
                
               
                echo "</tr>";
            }
            echo "</table>";
            echo "<button type='submit'>Create Report</button>";
    echo "</form>";
        } else {
            echo "No teams found.";
        }




 // including footer to the page  

require 'footer.php';
?>
