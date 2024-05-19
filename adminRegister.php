<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
    <link rel="stylesheet" href="layout.css">
    <!-- JavaScript code to alert if username or password is not inserted -->
    <script>
        function validate(fm) {
            if (fm.username.value === '') {
                alert('Please insert your username');
                fm.username.focus();
                return false;
            }
            if (fm.password.value === '') {
                alert('Please insert your password');
                fm.password.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<?php
require 'header.php';
// Connecting to the database
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    //encrypting the password for security
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Code to insert the data in the table
    $stmt = $pdo->prepare('INSERT INTO admin (firstname, surname, username, password, gender, address, mobile_no, date_of_birth) VALUES (:firstname, :surname, :username, :password, :gender, :address, :mobile_no, :date_of_birth)');
    $criteria = [
        'firstname' => $_POST['firstname'],
        'surname' => $_POST['surname'],
        'username' => $_POST['username'],
        'password' => $hashedPassword,
        'gender' => $_POST['gender'],
        'address' => $_POST['address'],
        'mobile_no' => $_POST['mobile_no'],
        'date_of_birth' => $_POST['date_of_birth']
    ];
    $result = $stmt->execute($criteria);

    if ($result) {
        echo 'Registered successfully. Congratulations.';
        // header('Location: adminLogin.php');
    } else {
        echo 'Registration failed. Please try again.';
    }
}
?>
<main>
    <article>
        <h2>Register for Admin</h2>
        <!-- Form to register the admin -->
        <form method="POST" action="" onsubmit="return validate(this)">
            <table>
                <tr>
                    <td><label for="firstname">First Name:</label></td>
                    <td><input type="text" id="firstname" name="firstname" placeholder="First Name" required></td>
                </tr>
                <tr>
                    <td><label for="surname">Surname:</label></td>
                    <td><input type="text" id="surname" name="surname" placeholder="Surname" required></td>
                </tr>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="username" placeholder="Username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td><label>Select Gender:</label></td>
                    <td>
                        <label for="male">Male:</label>
                        <input type="radio" id="male" name="gender" value="male" required>
                    </td>
                    <td>
                        <label for="female">Female:</label>
                        <input type="radio" id="female" name="gender" value="female" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" id="address" name="address" placeholder="Address" required></td>
                </tr>
                <tr>
                    <td><label for="mobile_no">Mobile Number:</label></td>
                    <td><input type="text" id="mobile_no" name="mobile_no" placeholder="Enter your number" required></td>
                </tr>
                <tr>
                    <td><label for="date_of_birth">Date of Birth:</label></td>
                    <td><input type="date" id="date_of_birth" name="date_of_birth" required></td>
                </tr>
            </table>
            <div class="button">
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
    </article>
</main>
<?php require 'footer.php'; ?>
</body>
</html>
