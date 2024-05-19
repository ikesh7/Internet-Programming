<?php
// adding header
require 'header.php';

// connecting to the database
require 'connect.php';
//Check to see if the user has logged in or not.
session_start();
if (!isset($_SESSION['sessionId'])) {
    header('Location: adminlogin.php');
    exit;
}

if (isset($_POST['submit'])) {
    // Validating and sanitizing input by the user.
    $played = filter_var($_POST['played'], FILTER_VALIDATE_INT);
    $won = filter_var($_POST['won'], FILTER_VALIDATE_INT);
    $drawn = filter_var($_POST['drawn'], FILTER_VALIDATE_INT);
    $lost = filter_var($_POST['lost'], FILTER_VALIDATE_INT);
    $goalsFor = filter_var($_POST['for'], FILTER_VALIDATE_INT);
    $goalsAgainst = filter_var($_POST['against'], FILTER_VALIDATE_INT);
    $goalDifference = filter_var($_POST['gd'], FILTER_VALIDATE_INT);
    $position = filter_var($_POST['position'], FILTER_VALIDATE_INT);
    $positionChange = filter_var($_POST['positionChange'], FILTER_SANITIZE_STRING);
    $featuredTeam = filter_var($_POST['featuredTeam'], FILTER_VALIDATE_BOOLEAN);
    
    if ($played === false || $won === false || $drawn === false || $lost === false || $goalsFor === false || $goalsAgainst === false || $goalDifference === false || $position === false) {
        echo "Invalid input data.";
        exit;
    }

    // Calculate points using a standard scoring system given at the assignment brief
    $points = ($won * 3) + ($drawn * 1);

    // Prepare and execute the SQL query to insert data into table name team
    $stmt = $pdo->prepare('INSERT INTO team (clubName, clubShortName, recentForm, played, won, drawn, lost, position, goalsFor, goalsAgainst, positionChange, goalDifference, points, crestUrl, featuredTeam)
                           VALUES (:clubName, :clubShortName, :recentForm, :played, :won, :drawn, :lost, :position, :goalsFor, :goalsAgainst, :positionChange, :goalDifference, :points, :crestUrl, :featuredTeam)');
    $criteria = [
        'clubName' => $_POST['clubName'],
        'clubShortName' => $_POST['clubShortName'],
        'recentForm' => $_POST['recentForm'],
        'played' => $played,
        'won' => $won,
        'drawn' => $drawn,
        'lost' => $lost,
        'position' => $position,
        'goalsFor' => $goalsFor,
        'goalsAgainst' => $goalsAgainst,
        'positionChange' => $positionChange,
        'goalDifference' => $goalDifference,
        'points' => $points,
        'crestUrl' => $_POST['crestUrl'],
        'featuredTeam' => $featuredTeam
    ];

    try {
        //inserting the data into the table team
        $result = $stmt->execute($criteria);
        if ($result) { // check if the data is inserted into the table
            echo 'Added successfully.';
        } else {
            echo '! Not Added. Try again.';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!--Creating a form with method post which takes data from the user -->
<main>
    <div class="container">
        <h2>Club Information Form</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="club_name">Club Name:</label>
                <input type="text" id="club_name" name="clubName" required>
            </div>
            <div class="form-group">
                <label for="club_short_name">Club's Short Name:</label>
                <input type="text" id="club_short_name" name="clubShortName" required>
            </div>
            <div class="form-group">
                <label for="recent_form">Club Last Six Results (W/D/L):</label>
                <input type="text" id="recent_form" name="recentForm" required>
            </div>
            <div class="form-group">
                <label for="total_played">Total Number of Games Played:</label>
                <input type="number" id="total_played" name="played" min="0" required>
            </div>
            <div class="form-group">
                <label for="won">Games Won:</label>
                <input type="number" id="won" name="won" min="0" required>
            </div>
            <div class="form-group">
                <label for="drawn">Games Drawn:</label>
                <input type="number" id="drawn" name="drawn" min="0" required>
            </div>
            <div class="form-group">
                <label for="lost">Games Lost:</label>
                <input type="number" id="lost" name="lost" min="0" required>
            </div>
            <div class="form-group">
                <label for="position">Enter Club's Position:</label>
                <input type="number" id="position" name="position" min="0" required>
            </div>
            <div class="form-group">
                <label for="goals_for">Goals For:</label>
                <input type="number" id="goals_for" name="for" min="0" required>
            </div>
            <div class="form-group">
                <label for="goals_against">Goals Against:</label>
                <input type="number" id="goals_against" name="against" min="0" required>
            </div>
            <div class="form-group">
                <label for="position_change">Position Change (Up/Down):</label>
                <input type="text" id="position_change" name="positionChange" required>
            </div>
            <div class="form-group">
                <label for="goal_difference">Goal Difference:</label>
                <input type="number" id="goal_difference" name="gd" min="0" required>
            </div>
            <div class="form-group">
                <label for="crest_url">Enter Crest URL:</label>
                <input type="text" id="crest_url" name="crestUrl" required>
            </div>
            <div class="form-group">
                <label for="featured_team">Featured Team (1 for Yes, 0 for No):</label>
                <input type="number" id="featured_team" name="featuredTeam" min="0" max="1" required>
            </div>
            <button type="submit" class="btn-submit" name="submit">Submit</button>
        </form>
    </div>
</main>

<?php
//adding footer
 require 'footer.php';
?>
