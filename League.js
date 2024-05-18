async function fetchLeagueScorers() {
    try {
        const response = await fetch('league.json');
        const data = await response.json();
        return data.tables[0].rows; // Access the rows array directly
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

async function populateTable() {
    const topPoints = await fetchLeagueScorers();

    // Sort clubs array by points scored in descending order
    topPoints.sort((a, b) => b.points - a.points);

    const tableBody = document.getElementById("leagueTableBody");
    tableBody.innerHTML = ""; // Clear existing rows

    // Iterate through each team in the data
    topPoints.forEach((club, index) => {
        const totalPoints = club.won * 3 + club.drawn; // Calculate points
        const winsLast6 = club.recentForm.filter(result => result === "W").length; // Count wins in last 6 games
        const lossesLast6 = club.recentForm.filter(result => result === "L").length; // Count losses in last 6 games
        const row = document.createElement("tr");
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
        tableBody.appendChild(row);
    });
}

function generateLast6Icons(wins, losses) {
    let iconsHTML = '';
    for (let i = 0; i < wins; i++) {
        iconsHTML += '<img src="win_icon.png" alt="Win" class="result-icon" />';
    }
    for (let i = 0; i < losses; i++) {
        iconsHTML += '<img src="loss_icon.png" alt="Loss" class="result-icon" />';
    }
    // Assuming the remaining games were draws
    const draws = 6 - wins - losses;
    for (let i = 0; i < draws; i++) {
        iconsHTML += '<img src="draw_icon.png" alt="Draw" class="result-icon" />';
    }
    return iconsHTML;
}

async function updateTable() {
    await populateTable();
}

// Call the function to populate the table initially
populateTable();

// Set interval to update table every 50 seconds
setInterval(updateTable, 50000);
