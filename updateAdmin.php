<?php
session_start();
if (!isset($_SESSION['sessionId'])) {
    header('Location: adminLogin.php');
    exit;
}

require 'header.php';
require 'connect.php';
//if id is not found then redirect to displayAdmin.php page
if (!isset($_GET['id'])) {
    header('Location: displayAdmin.php');
    exit;
}

$adminId = $_GET['id'];

// Fetch the admin details form the table whose id match with $adminId
$stmt = $pdo->prepare('SELECT * FROM admin WHERE id = :id');
$stmt->execute(['id' => $adminId]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
// if cannot find the data with id then redirect to displayAdmin.php page
if (!$admin) {
    header('Location: displayAdmin.php');
    exit;
}

// Code to update admin details with updated data provided by the user.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Password hash to protect the password
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('UPDATE admin SET firstname = :firstname, surname = :surname, username = :username, password = :password, gender = :gender, address = :address, mobile_no = :mobile_no, date_of_birth = :date_of_birth WHERE id = :id');
    $criteria = [
        'firstname' => $_POST['firstname'],
        'surname' => $_POST['surname'],
        'username' => $_POST['username'],
        'password' => $hashedPassword,
        'gender' => $_POST['gender'],
        'address' => $_POST['address'],
        'mobile_no' => $_POST['mobile_no'],
        'date_of_birth' => $_POST['date_of_birth'],
        'id' => $adminId
    ];
    $stmt->execute($criteria);
    //once updated redirect to displayAdmin.php
    header('Location: displayAdmin.php');
    exit;
}
?>
<!--form with method POST for the users to fill with updated data -->
<main>
    <article>
        <h2>Update Admin Details</h2>
        <form method="POST" action="">
            <table>
                <tr>
                    <td><label for="firstname">First Name:</label></td>
                    <td><input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($admin['firstname']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="surname">Surname:</label></td>
                    <td><input type="text" id="surname" name="surname" value="<?= htmlspecialchars($admin['surname']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="username" value="<?= htmlspecialchars($admin['username']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td><label>Select Gender:</label></td>
                    <td>
                        <label for="male">Male:</label>
                        <input type="radio" id="male" name="gender" value="male" <?= $admin['gender'] == 'male' ? 'checked' : '' ?> required>
                        <label for="female">Female:</label>
                        <input type="radio" id="female" name="gender" value="female" <?= $admin['gender'] == 'female' ? 'checked' : '' ?> required>
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" id="address" name="address" value="<?= htmlspecialchars($admin['address']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="mobile_no">Mobile Number:</label></td>
                    <td><input type="text" id="mobile_no" name="mobile_no" value="<?= htmlspecialchars($admin['mobile_no']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="date_of_birth">Date of Birth:</label></td>
                    <td><input type="date" id="date_of_birth" name="date_of_birth" value="<?= htmlspecialchars($admin['date_of_birth']) ?>" required></td>
                </tr>
            </table>
            <div class="button">
                <input type="submit" value="Update">
            </div>
        </form>
    </article>
</main>
<?php require 'footer.php'; ?>
