<?php
require 'header.php';
?>
<main>
<?php
// Connecting to the database
require 'connect.php';
//Check to see if the user has logged in or not.
session_start();
if (!isset($_SESSION['sessionId'])) {
    header('Location: adminlogin.php');
    exit;
}

try {
    // Query to show all teams ordered by highest points to lowest
    $stmt = "SELECT * FROM team ORDER BY points DESC";
    $result = $pdo->query($stmt);

    if ($result->rowCount() > 0) {
        $counter = 1;
        echo "<h2>Teams Details</h2>";
        //creating a form with action when clicked sends teams id to chartjs.php 
        echo "<form method='post' action='chartjs.php'>";
        //creating a table to display data
        echo "<table border='1'>";
        echo "<tr><th>Select Teams</th><th>S.N</th><th>Team Name</th><th>Short Name</th><th>Recent Wins</th><th>Games Played</th><th>Games Won</th><th>Games Drawn</th><th>Games Lost</th><th>Position</th><th>Goals For</th><th>Goals Against</th><th>Goal Difference</th><th>Points</th><th>Update</th><th>Delete</th></tr>";
        //accessing each data and displaying it in table format
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='clubId[]' value='" . htmlspecialchars($row['clubId']) . "'></td>";
            echo "<td>" . htmlspecialchars($counter) . "</td>";
            echo "<td>" . htmlspecialchars($row['clubName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['clubShortName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['recentForm']) . "</td>";
            echo "<td>" . htmlspecialchars($row['played']) . "</td>";
            echo "<td>" . htmlspecialchars($row['won']) . "</td>";
            echo "<td>" . htmlspecialchars($row['drawn']) . "</td>";
            echo "<td>" . htmlspecialchars($row['lost']) . "</td>";
            echo "<td>" . htmlspecialchars($row['position']) . "</td>";
            echo "<td>" . htmlspecialchars($row['goalsFor']) . "</td>";
            echo "<td>" . htmlspecialchars($row['goalsAgainst']) . "</td>";
            echo "<td>" . htmlspecialchars($row['goalDifference']) . "</td>";
            echo "<td>" . htmlspecialchars($row['points']) . "</td>";
            echo '<td><a href="updateTeam.php?editclubId=' . htmlspecialchars($row['clubId']) . '">Edit</a></td>'; // creating a link when clicked sends clubId to updateTeam.php
            echo '<td><a href="updateTeam.php?deleteclubId=' . htmlspecialchars($row['clubId']) . '">Delete</a></td>'; // creating a link when clicked sends clubId to updateTeam.php
            echo "</tr>";

            $counter++;
        }
        echo "</table>";
        //button to create report
        echo "<button type='submit'>Create Report</button>";
        echo "</form>";
    } else {
        echo "No teams found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
</main>
<?php
// Including footer to the page
require 'footer.php';
?>
