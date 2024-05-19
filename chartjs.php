<?php
// Require the header
require('header.php');

// Connecting to the database with error handling
require 'connect.php';
?>
<main>

<?php

session_start();
if (!isset($_SESSION['sessionId'])) {
    header('Location: adminlogin.php');
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if at least one checkbox is selected
    if (isset($_POST['clubId']) && count($_POST['clubId']) > 0) {
        // Get selected team IDs and use placeholders for prepared statement
        $selectedTeamIds = $_POST['clubId'];
        $placeholders = rtrim(str_repeat('?,', count($selectedTeamIds)), ',');

        // SQL query to select data for selected teams
        $sql = "SELECT * FROM team WHERE clubId IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($selectedTeamIds);

        // Check if there are any selected teams
        if ($stmt->rowCount() > 0) {
            // Output the data in a report format by creating a table to seperate the data
            echo "<h2>Report for Selected Teams</h2>";
            echo "<table border='1'>";
            //displaying the entire detailed report of the team
            $teamsData = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $teamsData[] = $row;

                echo "<h3>Team ID: " . htmlspecialchars($row['clubId']) . "</h3>";
                echo "<p><strong>Team Name:</strong> " . htmlspecialchars($row['clubName']) . "</p>";
                echo "<p><strong>Team's short name:</strong> " . htmlspecialchars($row['clubShortName']) . "</p>";
                echo "<p><strong>Points:</strong> " . htmlspecialchars($row['points']) . "</p>";
                echo "<p><strong>Position:</strong> " . htmlspecialchars($row['position']) . "</p>";
                echo "<p><strong>Total Number of Games Played:</strong> " . htmlspecialchars($row['played']) . "</p>";
                echo "<p><strong>Games won:</strong> " . htmlspecialchars($row['won']) . "</p>";
                echo "<p><strong>Games drawn:</strong> " . htmlspecialchars($row['drawn']) . "</p>";
                echo "<p><strong>Games lost:</strong> " . htmlspecialchars($row['lost']) . "</p>";
                echo "<p><strong>Goals for:</strong> " . htmlspecialchars($row['goalsFor']) . "</p>";
                echo "<p><strong>Goals against:</strong> " . htmlspecialchars($row['goalsAgainst']) . "</p>";
                echo "<p><strong>Goal difference:</strong> " . htmlspecialchars($row['goalDifference']) . "</p>";
                echo "<p><strong>Position changed:</strong> " . htmlspecialchars($row['positionChange']) . "</p>";
                echo "<p><strong>Recent Form:</strong> " . htmlspecialchars($row['recentForm']) . "</p>";
                echo "<p><strong>Crest Url:</strong> " . htmlspecialchars($row['crestUrl']) . "</p>";
                echo "<p><strong>Featured Team:</strong> " . htmlspecialchars($row['featuredTeam']) . "</p>";
                //require('pie.php'); 

                echo "<hr>";
            }
            echo "</table>";

            // Include the chart generation script
            require('bar.php');
        } else {
            echo "No teams found.";
        }
    } else {
        echo "No teams selected.";
    }
} else {
    echo "Invalid request method.";
}
?>
</main>
