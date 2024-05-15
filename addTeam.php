<?php
// <!-- adding header	 -->
require 'header.php';
//connecting the database.
$pdo = new PDO('mysql:host=localhost;dbname=assignment','root','');
?>

<?php
  
  if (isset($_POST['submit'])) {
    // Validate and sanitize input
    $played = filter_var($_POST['played'], FILTER_VALIDATE_INT);
    $won = filter_var($_POST['won'], FILTER_VALIDATE_INT);
    $drawn = filter_var($_POST['drawn'], FILTER_VALIDATE_INT);
    $lost = filter_var($_POST['lost'], FILTER_VALIDATE_INT);
    $for = filter_var($_POST['for'], FILTER_VALIDATE_INT);
    $gd = filter_var($_POST['gd'], FILTER_SANITIZE_STRING);
    
    if ($played === false || $won === false || $drawn === false || $lost === false || $for === false) {
        echo "Invalid input data.";
        exit;
    }
    
    // Calculate points using a standard scoring system
    $points = ($won * 3) + ($drawn * 1);

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare('INSERT INTO teams(name, city, manager, played, won, drawn, lost, `for`, against, gd, points)
                           VALUES(:name, :city, :manager, :played, :won, :drawn, :lost, :for, :against, :gd, :points)');
    $criteria = [
        'name' => $_POST['title'],
        'city' => $_POST['city'],
        'manager' => $_POST['manager'],
        'played' => $played,
        'won' => $won,
        'drawn' => $drawn,
        'lost' => $lost,
        'for' => $for,
        'against' => $_POST['against'],
        'gd' => $_POST['gd'],
        'points' => $points
    ];

    try {
        $result = $stmt->execute($criteria);
        if ($result) {
            echo 'Added successfully.';
        } else {
            echo '! Not Added. Try again.';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<main>
	<!--
	<article>
		<h2>Adding New Football Clubs</h2>
		 form to add teams 
		<form action="" method="POST">
			<table>
				<tr>
					<td><label>Name of the club</label></td> <td><input type="text" name="title" placeholder="enter the name of the football club" /></td></tr><p>
                    <td><label>Name of the City</label></td> <td><input type="text" name="city" placeholder="enter the name of the city" /></td></tr><p>
                    <td><label>Name of the Manager</label></td> <td><input type="text" name="manager" placeholder="enter the name of the football club's manager" /></td></tr>
					<td><label>Total numbers of Players</label></td> <td><input type="integer" name="total" placeholder="enter the total numbers of players" /></td></tr>
					
					<tr><td></td><td><input type="submit" name="submit" value="Add football team" /></td></tr>
				</table>
			</form>
		</article>
	</main> -->



    <div class="container">
    <h2>Club Information Form</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="club_name">Club Name:</label>
            <input type="text" id="club_name" name="title" required>
        </div>
        <div class="form-group">
            <label for="club_city">Club City:</label>
            <input type="text" id="club_city" name="city" required>
        </div>
        <div class="form-group">
            <label for="club_manager">Club Manager:</label>
            <input type="text" id="club_manager" name="manager" required>
        </div>
        <div class="form-group">
            <label for="total_played">Total Number of Games Played:</label>
            <input type="number" id="total_played" name="played" min="0" required>
        </div>
        <div class="form-group">
            <label for="won">Games won:</label>
            <input type="number" id="won" name="won" min="0" required>
        </div>
        <div class="form-group">
            <label for="drawn">Games drawn:</label>
            <input type="number" id="drawn" name="drawn" min="0" required>
        </div>
        <div class="form-group">
            <label for="lost">Games lost:</label>
            <input type="number" id="lost" name="lost" min="0" required>
        </div>
        <div class="form-group">
            <label for="for">Games for:</label>
            <input type="number" id="for" name="for" min="0" required>
        </div>
        <div class="form-group">
            <label for="against">Games against:</label>
            <input type="number" id="against" name="against" min="0" required>
        </div>
        <div class="form-group">
            <label for="gd">Goal difference:</label>
            <input type="text" id="gd" name="gd" required>
        </div>
        <button type="submit" class="btn-submit" name="submit">Submit</button>
    </form>
</div>

</main>
	<?php
//		require 'footer.php';
	?>
