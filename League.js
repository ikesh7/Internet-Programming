var xhr = new XMLHttpRequest();

// Configure the request: GET method and the URL to fetch
var apiUrl = "https://www.chelseafc.com/en/api/fixtures/league-table?entryId=30EGwHPO9uwBCc75RQY6kg";
xhr.open('GET', apiUrl, true);

// Define a callback function to handle the response
xhr.onload = function() {
  // Check if the request was successful
  if (xhr.status >= 200 && xhr.status < 300) {
    // Parse the JSON response
    var responseData = JSON.parse(xhr.responseText);
    // Process the data as needed
    console.log(responseData);
  } else {
    // Handle the error
    console.error('Request failed with status:', xhr.status);
  }
};

// Define a callback function to handle errors
xhr.onerror = function() {
  console.error('Request failed');
};

// Send the request
xhr.send();

// Function to fetch data from the API endpoint and update the league table
function fetchDataAndUpdateTable() {
    fetch(apiUrl)
        .then(response => {
            // Check if the request was successful
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            // Parse the JSON response
            return response.json();
        })
        .then(data => {
            // Process the data and update the league table
            updateTable(data);
        })
        .catch(error => {
            // Handle any errors that occurred during the fetch
            console.error('Error fetching data:', error);
        });
}

// Function to update Premier League table
function updateTable(data) {
    // Access the table element in League.html
    const table = document.querySelector('#league-table table');

    // Clear existing table data
    table.innerHTML = '';

    // Iterate through each team in the fetched data
    data.leagueTable.entries.forEach(function(team) {
        // Create a new row for each team
        const row = table.insertRow();
        // Add team data to the row
        row.insertCell(0).textContent = team.position;
        row.insertCell(1).textContent = team.team.name;
        row.insertCell(2).textContent = team.gamesPlayed;
        row.insertCell(3).textContent = team.gamesWon;
        row.insertCell(4).textContent = team.gamesDrawn;
        row.insertCell(5).textContent = team.gamesLost;
        row.insertCell(6).textContent = team.goalsFor;
        row.insertCell(7).textContent = team.goalsAgainst;
        row.insertCell(8).textContent = team.goalDifference;
        row.insertCell(9).textContent = team.points;
    });
}

// Call the fetchDataAndUpdateTable function initially
fetchDataAndUpdateTable();

// Update data every 5 minutes
setInterval(fetchDataAndUpdateTable, 300000); // 5 minutes in milliseconds







// Function to fetch data from League.json
/*
var manchester ={
    "points": 6,
    "games": 5,
    "won": 2,
    "loss":3
};


    
    
alert(module[1]);

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
}); */

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
