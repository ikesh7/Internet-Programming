<?php
	session_start();
	if(isset($_SESSION['sessionId'])){
		header('location:displayTeam.php');
	}
//ading header
require 'header.php';
//connecting the database.
$pdo = new PDO('mysql:host=localhost;dbname=assignment','root','');
if(isset($_POST['login']))
{
	// code to login after getting username and password from database
$stmt = $pdo->prepare("SELECT * FROM admin WHERE username=:username;");
$criteria = ['username'=>$_POST['username']];
$stmt->execute($criteria);
$row=$stmt->fetch();
$_SESSION['sessionId']=$row['id'];
if(($row['username']==$_POST['username'])
&&($row['password']==$_POST['password']))
{
header('location:displayTeam.php');
}
else echo 'not match';
}
?>
<main>
	<article>
		<h2> Admin login</h2>
		<!-- admin login form-->
		<form action="" method="POST">
			<table>
				<tr>
					<td><label>username</label></td> <td><input type="text" name="username" placeholder="enter ur username" /></td></tr>
					<tr>
						<td><label>password</label></td> <td><input type="password" name="password" placeholder="password" /></td></tr>
					</table>
					<input type="submit" name="login" value="login" />
				</form>
			</article>
			<div class="member">
				<p>
					Not yet a member?? <a href="adminregister.php">sign up</a>
				</p>
			</div>
		</main>
		<!-- adding footer	 -->
		<?php
		require 'footer.php';