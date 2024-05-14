<?php
// <!-- adding header	 -->
require 'header.php';
//connecting the database.
$pdo = new PDO('mysql:host=localhost;dbname=assignment','root','');

function getTeamDetails($team_id) {
    
      
            $stmt = $pdo->prepare("SELECT * FROM teams WHERE teamId = :team_id");
            $stmt->bindParam(':team_id', $team_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
   

// Function to update team details
function updateTeamDetails($teamId, $name, $city, $manager, $totalPlayers) {
   
            $stmt = $pdo->prepare("UPDATE teams SET name = :name, city = :city, manager = :manager, totalPlayers = :totalPlayers WHERE teamId = :teamId");
            $stmt->bindParam(':teamId', $teamId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':manager', $manager);
            $stmt->bindParam(':totalPlayers', $totalPlayers);
            $stmt->execute();
            return true;
        }
        

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamId = $_POST['teamId'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $manager = $_POST['manager'];
    $totalPlayers = $_POST['totalPlayers'];

    // Update team details
    if (updateTeamDetails($teamId, $name, $city, $manager, $totalPlayers)) {
        echo "Team details updated successfully.";
    } else {
        echo "Error updating team details.";
    }
}

// Get team details by ID
$teamId = $_GET['teamId']; // Assuming team_id is passed via GET parameter
$teamDetails = getTeamDetails($teamId);
?>



<h2>Update Team Details</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
    <label for="team_name">Team Name:</label><br>
    <input type="text" id="team_name" name="team_name" value="<?php echo $teamDetails['team_name']; ?>"><br>
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" value="<?php echo $teamDetails['city']; ?>"><br>
    <label for="manager">Manager:</label><br>
    <input type="text" id="manager" name="manager" value="<?php echo $teamDetails['manager']; ?>"><br>
    <label for="total_players">Total Players:</label><br>
    <input type="number" id="total_players" name="total_players" value="<?php echo $teamDetails['total_players']; ?>"><br><br>
    <input type="submit" value="Update">
</form>
<?php
		require 'footer.php';
	?>