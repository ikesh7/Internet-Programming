<?php
require 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if at least two checkboxes are selected
    if (isset($_POST['team_id']) && count($_POST['team_id']) >= 2) {
       

            // Get selected team IDs
            $selectedTeamIds = implode(",", $_POST['team_id']);

            // SQL query to select data for selected teams
            $sql = "SELECT * FROM teams WHERE teamId IN ($selectedTeamIds)";
            $stmt = $pdo->query($sql);

            // Check if there are any selected teams
            if ($stmt->rowCount() > 0) {
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
                    echo "<hr>";
                }
                echo "</table>";
            } else {
                echo "No teams found.";
            }
            } else {
        echo "Please select at least two teams.";
    }
} else {
    // Redirect if form is not submitted
    header("Location: displayTeam.php");
    exit();
}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    
    <title>Football Team Report</title>
</head>
<body>
    <h1>Football Team Report</h1>

    <!-- Display the pie chart -->
    <canvas id="pieChart" width="400" height="400"></canvas>

    <!-- Display the bar chart (if applicable) -->
    <canvas id="barChart" width="600" height="400"></canvas>

    <script>
        // Embedding data directly into JavaScript code
        var pieChartData = <?php echo json_encode($pieChartData); ?>;
        var barChartData = <?php echo json_encode($barChartData); ?>;

        // Now you can use pieChartData and barChartData to render the charts using a library like Chart.js
        // Example:
        var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
        var barChartCanvas = document.getElementById('barChart').getContext('2d');

        // Render the pie chart
        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: {
                labels: ['Wins', 'Draws', 'Losses', 'Remaining Games'],
                datasets: [{
                    data: pieChartData,
                    backgroundColor: ['green', 'yellow', 'red', 'grey']
                }]
            }
        });

        // Render the bar chart (if applicable)
        if (barChartData.labels.length > 1) {
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: {
                    labels: barChartData.labels,
                    datasets: [{
                        label: 'Wins',
                        data: barChartData.wins,
                        backgroundColor: 'green'
                    }, {
                        label: 'Draws',
                        data: barChartData.draws,
                        backgroundColor: 'yellow'
                    }, {
                        label: 'Losses',
                        data: barChartData.losses,
                        backgroundColor: 'red'
                    }, {
                        label: 'Remaining Games',
                        data: barChartData.remaining_games,
                        backgroundColor: 'grey'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    </script>
</body>
</html>