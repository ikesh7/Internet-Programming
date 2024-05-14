<?php
// <!-- adding header	 -->
require 'header.php';
//connecting the database.
require 'connect.php';
if (isset($_POST['submit']))
{
// code to insert the data in the table.
$stmt = $pdo->prepare('INSERT INTO teams(name,city,manager,totalPlayers)
VALUES(:name,:city,:manager,:totalPlayers)');
$criteria =
[
'name'=>$_POST['name'],
'city'=>$_POST['city'],
'manager'=>$_POST['manager'],
'totalPlayers'=>$_POST['total']

];
$result = $stmt->execute($criteria);
if($result) echo 'Added successfully.';
else echo '! Not Added. Try again.';

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
            <input type="text" id="club_name" name="name" required>
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
            <label for="total_players">Total Number of Players:</label>
            <input type="number" id="total_players" name="total" min="0" required>
        </div>
        <button type="submit" class="btn-submit">Submit</button>
    </form>
</div>
</main>
	<?php
		require 'footer.php';
	?>