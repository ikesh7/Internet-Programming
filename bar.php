<?php
$pdo = new PDO('mysql:host=localhost;dbname=assignment','root','');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Premier League Table</title>  
    <style type="text/css">
     .chartbox{
        width: 700px;
     }
     </style>
</head>
<body>
    <div class="container">
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
    
    <div class="chartbox">
  <canvas id="myChart"></canvas>
</div>



<script>
//set up Block
const name = <?php echo json_encode($name); ?>;
const played = <?php echo json_encode($played); ?>;
const won = <?php echo json_encode($won); ?>;
const drawn = <?php echo json_encode($drawn); ?>;
const lost = <?php echo json_encode($lost); ?>;
const data ={
labels: name,
      datasets: [{
        label: 'number of games played',
        data: played,
        borderWidth: 1
      },
      {
        label: 'number of games won',
        data: won,
        borderWidth: 1
      },
      {
        label: 'number of games drawn',
        data: drawn,
        borderWidth: 1
      },
      {
        label: 'number of games lost',
        data: lost,
        borderWidth: 1
      }]
    };
//config Block
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

//Render block
    const myChart = new Chart(
        document.getElementById('myChart'),
        config

    );
  
</script>
</div>
</body>
</html>