<?php
session_start();
if (!isset($_SESSION['sessionId'])) {
    header('Location: adminLogin.php');
    exit;
}

require 'header.php';
require 'connect.php';

// Delete admin
if (isset($_GET['delete'])) {
    $adminId = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM admin WHERE id = :id');
    $stmt->execute(['id' => $adminId]);
    header('Location: displayAdmin.php');
    exit;
}

// Fetch all the data form the table admin
$stmt = $pdo->query('SELECT * FROM admin');
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
    <article>
        <h2>Registered Admins</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Mobile Number</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!--Displaying all the fetched data form the table admin -->
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?= htmlspecialchars($admin['id']) ?></td>
                        <td><?= htmlspecialchars($admin['firstname']) ?></td>
                        <td><?= htmlspecialchars($admin['surname']) ?></td>
                        <td><?= htmlspecialchars($admin['username']) ?></td>
                        <td><?= htmlspecialchars($admin['gender']) ?></td>
                        <td><?= htmlspecialchars($admin['address']) ?></td>
                        <td><?= htmlspecialchars($admin['mobile_no']) ?></td>
                        <td><?= htmlspecialchars($admin['date_of_birth']) ?></td>
                        <td>
                            <a href="updateAdmin.php?id=<?= $admin['id'] ?>">Update</a> <!--code to redirect to updateAdmin.php page with id.-->
                            <a href="displayAdmin.php?delete=<?= $admin['id'] ?>" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a> <!--code to redirect to displayAdmin.php page with id.-->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</main>
<?php require 'footer.php'; ?>
