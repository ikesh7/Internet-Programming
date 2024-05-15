<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier League Table</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style type="text/css">
     .container{
        width: 90px;
        
     }
     </style>

</head>
<body>
    <div class="container">
        <h4>Pie chart of Matches Played</h2>
        <div style="width: 200px;">
            <canvas id="myPieChart"></canvas>
        </div>

        <?php
$stmt = "SELECT * FROM teams WHERE teamId IN ($selectedTeamIds)";
$result =$pdo->query($stmt);
if ($result->rowCount() > 0) {
    $name = array();
    $played = array();
    $won = array();
    $drawn = array();
    $lost = array();

    echo "<h2>Teams Details</h2>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $name[]= $row["name"];
        $played[]= $row["played"];
        $won[]= $row["won"];
        $drawn[]= $row["drawn"];
        $lost[]= $row["lost"];
    }
}
?>

        <script>
           const name = <?php echo json_encode($name); ?>;
            const played = <?php echo json_encode($played); ?>;
            const won = <?php echo json_encode($won); ?>;
            const drawn = <?php echo json_encode($drawn); ?>;
            const lost = <?php echo json_encode($lost); ?>;

            const myPieChart = new Chart(document.getElementById('myPieChart'), {
                type: 'pie',
                data: {
                    labels: name,
                    datasets: [{
                        data: played,
                        backgroundColor: ['green', 'yellow', 'red', 'grey']
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Percentage of Matches Played'
                    }
                }
            });
        </script>
    </div>
</body>
</html>
