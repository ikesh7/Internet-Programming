<?php
	require 'header.php';
    ?>
<?php
//connecting the database.
require 'connect.php';
//query to show all teams:
	$stmt = "SELECT * FROM teams";
	$result =$pdo->query($stmt);

        if ($result->rowCount() > 0) {
            echo "<h2>Teams Details</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Team ID</th><th>Team Name</th><th>City</th><th>Manager</th><th>Total Players</th><th>Update</th><th>Delete</th></tr>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['teamId'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['manager'] . "</td>";
                echo "<td>" . $row['totalPlayers'] . "</td>";
                echo "<td>" . $row['totalPlayers'] . "</td>";
               // echo "<td>" . "<li><a href=""updateTeam.php/$row['teamId']">Update</a></li>" . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No teams found.";
        }




 // including footer to the page  

require 'footer.php';
?>