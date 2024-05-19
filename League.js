// Creating Async function which fetches league scorers data from league.JSON file
async function fetchLeagueScorers() {
    try {
        const response = await fetch('league.json');
        // Parse the JSON data
        const data = await response.json();
        return data.tables[0].rows; // Access the rows array directly
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
// Creating Async function which populates league table with league scorers data from league.JSON file
async function populateTable() {
    // Fetching the league scorers data
    const topPoints = await fetchLeagueScorers();

    // Sorting clubs array by points scored in descending order
    topPoints.sort((a, b) => b.points - a.points);

    //Getting table body element from the html file where data will be displayed
    const tableBody = document.getElementById("leagueTableBody");
    tableBody.innerHTML = ""; // Clear existing rows

    // Loop through each team in the data
    topPoints.forEach((club, index) => {
        const totalPoints = club.won * 3 + club.drawn; // Calculating points automatically with wins and draw
        const winsLast6 = club.recentForm.filter(result => result === "W").length; // Counting wins in last 6 games
        const lossesLast6 = club.recentForm.filter(result => result === "L").length; // Counting losses in last 6 games
        const row = document.createElement("tr");         // Creating a new table row element
        // Setting the inner HTML of the row with the team's data
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${club.clubName}</td>
            <td>${club.played}</td>
            <td>${club.won}</td>
            <td>${club.lost}</td>
            <td>${club.drawn}</td>
            <td>${club.goalsFor}</td>
            <td>${club.goalsAgainst}</td>
            <td>${club.goalDifference}</td>
            <td>${totalPoints}</td>
            <td>${generateLast6Icons(winsLast6, lossesLast6)}</td>
        `;
         // Appending the row to the table body
        tableBody.appendChild(row);
    });
}
//Generating html for last 6 games result.
function generateLast6Icons(wins, losses) {
    let iconsHTML = '';
    for (let i = 0; i < wins; i++) {
        //adding win icon for every won game
        iconsHTML += '<img src="win_icon.png" alt="Win" class="result-icon" />';
    }
    for (let i = 0; i < losses; i++) {
        //adding loss icon for every lost game
        iconsHTML += '<img src="loss_icon.png" alt="Loss" class="result-icon" />';
    }
    // Assuming the remaining games were draws
    const draws = 6 - wins - losses;
    for (let i = 0; i < draws; i++) {
        iconsHTML += '<img src="draw_icon.png" alt="Draw" class="result-icon" />';
    }
    return iconsHTML;
}
// Asynchronously updating the table by repopulating it with data
async function updateTable() {
    await populateTable();
}

// Call the function to populate the table initially
populateTable();

// Set interval to update table every 50 seconds
setInterval(updateTable, 50000);
