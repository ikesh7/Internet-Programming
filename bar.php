<?php
// Connecting to the database with error handling
require 'connect.php';



// Ensure selectedTeamIds is passed via session or post
if (!isset($_POST['clubId']) || count($_POST['clubId']) == 0) {
    die("No teams selected.");
}

// Get selected team IDs and use placeholders for prepared statement
$selectedTeamIds = $_POST['clubId'];
$placeholders = rtrim(str_repeat('?,', count($selectedTeamIds)), ',');

// SQL query to select data for selected teams
$sql = "SELECT * FROM team WHERE clubId IN ($placeholders)";
$stmt = $pdo->prepare($sql);
$stmt->execute($selectedTeamIds);
//creating some variable to hold the data retrived from team.
$name = [];
$played = [];
$won = [];
$drawn = [];
$lost = [];

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $name[] = $row["clubName"];
        $played[] = $row["played"];
        $won[] = $row["won"];
        $drawn[] = $row["drawn"];
        $lost[] = $row["lost"];
    }
} else {
    die("No data found for the selected teams.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Premier League Table</title>  
    <style>
        .chartbox {
            width: 700px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chartbox">
        <!--Creating a canvas to display bar chart -->
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script>
        // Set up Block and changing the sql format into json format to display bar chart
        const name = <?php echo json_encode($name); ?>;
        const played = <?php echo json_encode($played); ?>;
        const won = <?php echo json_encode($won); ?>;
        const drawn = <?php echo json_encode($drawn); ?>;
        const lost = <?php echo json_encode($lost); ?>;
        //displaying the label and data in the bar chart
        const data = {
            labels: name,
            //The data is used to adjust the chart and label for the name of each bar in the chart
            datasets: [
                {
                    label: 'Number of games played',
                    data: played,
                    borderWidth: 1
                },
                {
                    label: 'Number of games won',
                    data: won,
                    borderWidth: 1
                },
                {
                    label: 'Number of games drawn',
                    data: drawn,
                    borderWidth: 1
                },
                {
                    label: 'Number of games lost',
                    data: lost,
                    borderWidth: 1
                }
            ]
        };
        // Config Block to configure the barchart
        const config = {
            type: 'bar',
            data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        // Render Block to get the id of the canvas and prepare to configure it.
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>
</html>
