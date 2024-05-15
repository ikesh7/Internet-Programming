<?php
//require('header.php');
$pdo = new PDO('mysql:host=localhost;dbname=assignment','root','');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if at least two checkboxes are selected
    if (isset($_POST['team_id']) ) {
       

            // Get selected team IDs
            $selectedTeamIds = implode(",", $_POST['team_id']);

            // SQL query to select data for selected teams
            $sql = "SELECT * FROM teams WHERE teamId IN ($selectedTeamIds)";
            $stmt = $pdo->query($sql);
            $teamIdsArray = explode(",", $selectedTeamIds);

            // Check if there are any selected teams
           
                // Output the data in a report format
                echo "<h2>Report for Selected Teams</h2>";
                echo "<table border='1'>";
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<h3>Team ID: " . $row['teamId'] . "</h3>";
                    echo "<p><strong>Team Name:</strong> " . $row['name'] . "</p>";
                    echo "<p><strong>City:</strong> " . $row['city'] . "</p>";
                    echo "<p><strong>Manager:</strong> " . $row['manager'] . "</p>";
                    echo "<p><strong>Total Number of Games Played:</strong> " . $row['played'] . "</p>";
                    echo "<p><strong>Games won:</strong> " . $row['won'] . "</p>";
                    echo "<p><strong>Games drawn:</strong> " . $row['drawn'] . "</p>";
                    echo "<p><strong>Games lost:</strong> " . $row['lost'] . "</p>";
                    echo "<p><strong>Games for:</strong> " . $row['for'] . "</p>";
                    echo "<p><strong>Games against:</strong> " . $row['against'] . "</p>";
                    echo "<p><strong>Goal difference:</strong> " . $row['gd'] . "</p>";
                    echo "<p><strong>Points:</strong> " . $row['points'] . "</p>";
                   // require('report.php');

                    echo "<hr>";
                }
                echo "</table>";

                require('bar.php');
                
        } else {
    echo "No teams found.";
}
} 
?>