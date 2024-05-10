// Function to fetch data from League.json
document.addEventListener("DOMContentLoaded", function () {
    fetch('C:\Users\ikesh\OneDrive\Documents\Internet Programming Assignment\League.json')
        .then(response => response.json())
        .then(data => {
            const dataDisplay = document.getElementById("table-container");

            // Create HTML elements to display the JSON data
            const nameElement = document.createElement("p");
            nameElement.textContent = "Name: " + data.name;

            const ageElement = document.createElement("p");
            ageElement.textContent = "Played: " + data.played;

            const cityElement = document.createElement("p");
            cityElement.textContent = "Points: " + data.points;

            // Append the elements to the "dataDisplay" div
            dataDisplay.appendChild(nameElement);
            dataDisplay.appendChild(playedElement);
            dataDisplay.appendChild(pointsElement);
        })
        .catch(error => console.error("Error fetching JSON data:", error));
});
/*
document.addEventListener("DOMContentLoaded", function () {
    fetch('League.json')
        .then(response => response.json())
        .then(data => {
            const dataDisplay = document.getElementById("table-container");

            // Create HTML elements to display the JSON data
            const nameElement = document.createElement("p");
            nameElement.textContent = "Name: " + data.name;

            const ageElement = document.createElement("p");
            ageElement.textContent = "Played: " + data.played;

            const cityElement = document.createElement("p");
            cityElement.textContent = "GoalDifference: " + data.goalDifference;

            // Append the elements to the "dataDisplay" div
            dataDisplay.appendChild(nameElement);
            dataDisplay.appendChild(ageElement);
            dataDisplay.appendChild(cityElement);
        })
        .catch(error => console.error('Error fetching data:', error));
});

// Function to update Premier League Table
function updateLeagueTable(teams) {
    const tableContainer = document.getElementById('table-container');
    let tableHTML = '<table>';
    tableHTML += '<tr><th>Position</th><th>Team</th><th>Played</th><th>Goal Difference</th><th>Points</th></tr>';

    teams.forEach(team => {
        tableHTML += `<tr><td>${team.position}</td><td>${team.name}</td><td>${team.played}</td><td>${team.goalDifference}</td><td>${team.points}</td></tr>`;
    });

    tableHTML += '</table>';
    tableContainer.innerHTML = tableHTML;
}

// Function to update Top Scorers Table
function updateTopScorersTable(topScorers) {
    const topScorersContainer = document.getElementById('top-scorers-container');
    let tableHTML = '<table>';
    tableHTML += '<tr><th>Rank</th><th>Name</th><th>Team</th><th>Goals</th></tr>';

    topScorers.forEach(scorer => {
        tableHTML += `<tr><td>${scorer.rank}</td><td>${scorer.name}</td><td>${scorer.team}</td><td>${scorer.goals}</td></tr>`;
    });

    tableHTML += '</table>';
    topScorersContainer.innerHTML = tableHTML;
}

// Call fetchData() initially
fetchData();

// Update data every 5 minutes
setInterval(fetchData, 300000); // 5 minutes in milliseconds
*/