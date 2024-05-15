<?php
// <!-- adding header	 -->
require 'header.php';
//connecting the database.
$pdo = new PDO('mysql:host=localhost;dbname=assignment','root','');
if(isset($_GET['deleteTeam_id']))
{
$teamId=$_GET['deleteTeam_id'];
// query to delete data.
$stmt = $pdo->prepare("DELETE FROM teams WHERE teamId=:teamId");
$criteria=[
'teamId'=>$teamId
];
$stmt->execute($criteria);
header ('location:displayTeam.php');
}
//for edit
if(isset($_GET['editTeam_id']))
{
$teamId=$_GET['editTeam_id'];
if(isset($_POST['update'])){
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

// query to update the data.
$stmt = $pdo->prepare("UPDATE teams SET name=:name,city=:city,manager=:manager,played=:played,won=:won,drawn=:drawn,lost=:lost,`for`=:for,`against`=:against,gd=:gd,points=:points WHERE teamId=:teamId;");
$criteria=[
'name'=>$_POST['name'],
'city'=>$_POST['city'],
'manager'=>$_POST['manager'],
'played'=>$_POST['played'],
'won'=>$_POST['won'],
'drawn'=>$_POST['drawn'],
'lost'=>$_POST['lost'],
'for'=>$_POST['for'],
'against'=>$_POST['against'],
'gd'=>$_POST['gd'],
'points'=>$points,
'teamId'=>$teamId

];
$stmt->execute($criteria);
}
header ('location:displayTeam.php');
}
?>
<main>
	
	<article>
		<?php
		$stmt=$pdo->prepare("SELECT * FROM teams WHERE teamId=".$_GET['editTeam_id']."
			");
		$stmt->execute();
		$row=$stmt->fetch();
		?>
		<h2>updating users</h2>
		<!-- editing users -->
		<form method="POST" action="">
			<table>
				<tr>
					<td><label>Name of the club:</label></td>
                    <td><input type="text" name="name" placeholder="full name" value="<?php echo $row['name']?>"></td>
				</tr>
				<tr>
					<td><label>City:</label></td>
                    <td><input type="text" name="city" placeholder="enter City" value="<?php echo $row['city']?>"></td>
				</tr>
				<tr>
					<td><label>Manager:</label></td>
                    <td><input type="text" name="manager" placeholder="enter Manager name" value="<?php echo $row['manager']?>"></td>
                </tr>
					
				<tr>
					<td><label>Total Number of Games Played:</label></td>
                    <td><input type="text" name="played" placeholder="Total Games Played" value="<?php echo $row['played']?>" /></td>
                </tr>
				<tr>
					<td><label>Games won:</label></td>
                    <td><input type="text" name="won" placeholder="Games won" value="<?php echo $row['won']?>"></td>
				</tr>
				<tr>
					<td><label>Games drawn:</label></td>
                    <td><input type="text" name="drawn" placeholder="Games drawn" value="<?php echo $row['drawn']?>"></td>
				</tr>
				<tr>
					<td><label>Games lost:</label></td>
                    <td><input type="text" name="lost" placeholder="Games lost" value="<?php echo $row['lost']?>"></td>
                </tr>
					
				<tr>
					<td><label>Games for:</label></td>
                    <td><input type="text" name="for" placeholder="Games for" value="<?php echo $row['for']?>" /></td>
                </tr>
                <tr>
					<td><label>Games against:</label></td>
                    <td><input type="text" name="against" placeholder="Games against" value="<?php echo $row['against']?>"></td>
				</tr>
				<tr>
					<td><label>Goal difference:</label></td>
                    <td><input type="text" name="gd" placeholder="Goal difference" value="<?php echo $row['gd']?>"></td>
				</tr>
				<tr>
					<td><label>Points:</label></td>
                    <td><span id="points"><?php echo $row['points']; ?></span></td>
                    
                </tr>	
				<tr><td></td><td><input type="submit" name="update" value="update" /></td></tr>
			</table>
		</form>
	</article>
</main>
<!-- adding footer	 -->
<?php
	require 'footer.php';
?>
