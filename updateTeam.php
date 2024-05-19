<?php
// Adding header
require 'header.php';
// Connecting to the database with error handling
require 'connect.php';
//Check to see if the user has logged in or not.
session_start();
if (!isset($_SESSION['sessionId'])) {
    header('Location: adminlogin.php');
    exit;
}
//check if the user send deleteclubId from the link
if (isset($_GET['deleteclubId'])) {
    $teamId = $_GET['deleteclubId'];
    // Query to delete data with the matching clubId 
    $stmt = $pdo->prepare("DELETE FROM team WHERE clubId = :clubId");
    $criteria = [
        'clubId' => $teamId
    ];
    $stmt->execute($criteria);
    //nav to displayTeam.php when finished deleting the data
    header('Location: displayTeam.php');
    exit;
}

// For edit check if the user send editclubId
if (isset($_GET['editclubId'])) {
    $teamId = $_GET['editclubId'];
    // Validating and sanitizing the updated input by the user.
    if (isset($_POST['update'])) {
        $played = filter_var($_POST['played'], FILTER_VALIDATE_INT);
        $won = filter_var($_POST['won'], FILTER_VALIDATE_INT);
        $drawn = filter_var($_POST['drawn'], FILTER_VALIDATE_INT);
        $lost = filter_var($_POST['lost'], FILTER_VALIDATE_INT);
        $goalsFor = filter_var($_POST['goalsFor'], FILTER_VALIDATE_INT);
        $goalsAgainst = filter_var($_POST['goalsAgainst'], FILTER_VALIDATE_INT);
        $goalDifference = filter_var($_POST['goalDifference'], FILTER_SANITIZE_STRING);
        $position = filter_var($_POST['position'], FILTER_VALIDATE_INT);
        $positionChange = filter_var($_POST['positionChange'], FILTER_SANITIZE_STRING);
        $recentForm = filter_var($_POST['recentForm'], FILTER_SANITIZE_STRING);
        $crestUrl = filter_var($_POST['crestUrl'], FILTER_SANITIZE_URL);
        $featuredTeam = filter_var($_POST['featuredTeam'], FILTER_VALIDATE_BOOLEAN);

        if ($played === false || $won === false || $drawn === false || $lost === false || $goalsFor === false || $goalsAgainst === false || $position === false) {
            echo "Invalid input data.";
            exit;
        }

        // Calculate points using a standard scoring system
        $points = ($won * 3) + ($drawn * 1);

        // Query to update the data with new data provided by the user
        $stmt = $pdo->prepare("UPDATE team SET clubName = :clubName, clubShortName = :clubShortName, points = :points, position = :position, played = :played, won = :won, drawn = :drawn, lost = :lost, goalsFor = :goalsFor, goalsAgainst = :goalsAgainst, goalDifference = :goalDifference, positionChange = :positionChange, recentForm = :recentForm, crestUrl = :crestUrl, featuredTeam = :featuredTeam WHERE clubId = :clubId");
        $criteria = [
            'clubName' => $_POST['clubName'],
            'clubShortName' => $_POST['clubShortName'],
            'points' => $points,
            'position' => $position,
            'played' => $played,
            'won' => $won,
            'drawn' => $drawn,
            'lost' => $lost,
            'goalsFor' => $goalsFor,
            'goalsAgainst' => $goalsAgainst,
            'goalDifference' => $goalDifference,
            'positionChange' => $positionChange,
            'recentForm' => $recentForm,
            'crestUrl' => $crestUrl,
            'featuredTeam' => $featuredTeam,
            'clubId' => $teamId
        ];
        $stmt->execute($criteria);
        //nav to displayTeam after executing the code.
        header('Location: displayTeam.php');
        exit;
    }

    // Fetch existing data for the team to display at the place holder of the form
    $stmt = $pdo->prepare("SELECT * FROM team WHERE clubId = :clubId");
    $stmt->execute(['clubId' => $teamId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        die("Team not found.");
    }
}
?>
<main>
    <article>
        <h2>Updating Team</h2>
        <!-- creating form to take input from the user and also displaying existing data in the placeholder -->
        <form method="POST" action="">
            <table>
                <tr>
                    <td><label>Name of the club:</label></td>
                    <td><input type="text" name="clubName" placeholder="Full name" value="<?php echo htmlspecialchars($row['clubName']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Club's short name:</label></td>
                    <td><input type="text" name="clubShortName" placeholder="Enter short name" value="<?php echo htmlspecialchars($row['clubShortName']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Club's Points:</label></td>
                    <td><input type="number" name="points" placeholder="Enter Club's points" value="<?php echo htmlspecialchars($row['points']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Club's position:</label></td>
                    <td><input type="number" name="position" placeholder="Enter Club's position" value="<?php echo htmlspecialchars($row['position']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Total Number of Games Played:</label></td>
                    <td><input type="number" name="played" placeholder="Total Games Played" value="<?php echo htmlspecialchars($row['played']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Number of Games won:</label></td>
                    <td><input type="number" name="won" placeholder="Games won" value="<?php echo htmlspecialchars($row['won']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Number of Games drawn:</label></td>
                    <td><input type="number" name="drawn" placeholder="Games drawn" value="<?php echo htmlspecialchars($row['drawn']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Number of Games lost:</label></td>
                    <td><input type="number" name="lost" placeholder="Games lost" value="<?php echo htmlspecialchars($row['lost']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Number of goals for:</label></td>
                    <td><input type="number" name="goalsFor" placeholder="Goals for" value="<?php echo htmlspecialchars($row['goalsFor']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Goals against:</label></td>
                    <td><input type="number" name="goalsAgainst" placeholder="Goals against" value="<?php echo htmlspecialchars($row['goalsAgainst']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Goal difference:</label></td>
                    <td><input type="text" name="goalDifference" placeholder="Goal difference" value="<?php echo htmlspecialchars($row['goalDifference']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Position Changed:</label></td>
                    <td><input type="text" name="positionChange" placeholder="Position Change" value="<?php echo htmlspecialchars($row['positionChange']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Recent Form:</label></td>
                    <td><input type="text" name="recentForm" placeholder="Recent Form" value="<?php echo htmlspecialchars($row['recentForm']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Crest Url:</label></td>
                    <td><input type="url" name="crestUrl" placeholder="Enter URL" value="<?php echo htmlspecialchars($row['crestUrl']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Featured Team:</label></td>
                    <td><input type="checkbox" name="featuredTeam" <?php echo $row['featuredTeam'] ? 'checked' : ''; ?>></td>
                </tr>
                <tr><td></td><td><input type="submit" name="update" value="Update"></td></tr>
            </table>
        </form>
    </article>
</main>
<!-- Adding footer -->
<?php
require 'footer.php';
?>
