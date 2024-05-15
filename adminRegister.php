<!-- javaseript code to alert if username or password is not inserted -->
<script>
	function validate(fm){
		if(fm.username.value == ''){
			alert('please insert your username');
			fm.username.focus();
			return false;
		}
		if(fm.password.value == ''){
			alert('please insert your password');
			fm.password.focus();
			return false;
		}
		
	}
</script>
<?php
		require 'header.php';
//connecting the database.
$pdo = new PDO('mysql:host=localhost;dbname=assignment','root','');
		if (isset($_POST['submit']))
		{
			// code to insert the data in the table.
		$stmt = $pdo->prepare('INSERT INTO admin(firstname,surname,username,password,gender,address,mobile_no,
date_of_birth)
VALUES(:firstname,:surname,:username,:password,:gender,
:address,:mobile_no,:date_of_birth)');
	$criteria =
	[
'firstname'=>$_POST['firstname'],
'surname'=>$_POST['surname'],
'username'=>$_POST['username'],
'password'=>$_POST['password'],
'gender'=>$_POST['gender'],
'address'=>$_POST['address'],
'mobile_no'=>$_POST['mobile_no'],
'date_of_birth'=>date('Y-m-d')
		];
	$result = $stmt->execute($criteria);
		if($result) 
        {
            echo 'Registered successfully. Congratulations.';
       // header ('location:adminLogin.php');
        }
else echo '! Not inserted. Try again.';

	}
?>
<main>
	<article>
		<h2>Register for admin</h2>
		<!-- form to register the admin -->
		<form method="POST" action="" onsubmit="return validate(this)">
			<table>
				<tr>
					<td><label>Name:</label></td> <td><input type="text" name="firstname" placeholder="firstname" ></td>
					<td><input type="text" name="surname" placeholder="surname" ></td>
				</tr>
				<tr>
					<td><label>Username:</label></td> <td><input type="text" name="username" placeholder="enter username" ></td>
				</tr>
				<tr>
					<td><label>Password:</label></td> <td><input type="text" name="password" placeholder="enter password" ></td></tr>
					<tr>
						<td><label>  Select gender :</label></td>
						
						<td><label> Male:</label>	<input type="radio" name="gender" value="male"></td>
						<td><label>  Female:</label>	<input type="radio" name="gender" value="female" checked></td></tr>
						<tr>
							<td><label>Address:</label></td> <td><input type="text" name="address" placeholder="address" /></td></tr>
							<tr>
								<td><label>mobile number:</label></td> <td><input type="text" name="mobile_no" placeholder="enter your number" /></td></tr>
								<tr>
									<td><label>Date of birth:</label></td> <td><input type="Date" name="date_of_birth"></td></tr>
								</table>
								<div class="button">
									<tr><td><input type="submit" name="submit" value="Register" /></td></tr>
								</div>
							</form>
						</article>
					</main>
					<?php
					require 'footer.php';
					?>