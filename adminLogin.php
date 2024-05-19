<?php
session_start();

// If the session is already set, redirect to displayTeam.php
if (isset($_SESSION['sessionId'])) {
    header('Location: displayTeam.php');
    exit;
}

// Adding header
require 'header.php';

// Connecting the database
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to fetch the admin details
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $row = $stmt->fetch();

    // If the username is found and the password matches
    if ($row && password_verify($password, $row['password'])) {
        // Set the session ID and redirect to displayTeam.php
        $_SESSION['sessionId'] = $row['id'];
        header('Location: displayTeam.php');
        exit;
    } else {
        // Display an error message if the credentials do not match
        $error = 'Username or password is incorrect.';
    }
}
?>
<main>
    <article>
        <h2>Admin Login</h2>
        <!-- Admin login form -->
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="username">Username</label></td>
                    <td><input type="text" id="username" name="username" placeholder="Enter your username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                </tr>
            </table>
            <input type="submit" name="login" value="Login">
        </form>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </article>
    <div class="member">
        <p>Not yet a member? <a href="adminregister.php">Sign up</a></p>
    </div>
</main>
<!-- Adding footer -->
<?php require 'footer.php'; ?>
