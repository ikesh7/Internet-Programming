// Function to fetch data from JSON file
async function fetchTopScorers() {
    try {
        const response = await fetch('goal.json');
        const data = await response.json();
        return data.topScorers;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Function to populate the table with top goal scorers
async function populateTable() {
    const topScorers = await fetchTopScorers();

    // Sort topScorers array by goals scored in descending order
    topScorers.sort((a, b) => b.stats.goals - a.stats.goals);

    const tableBody = document.getElementById("goalScorersTableBody");
    tableBody.innerHTML = ""; // Clear existing rows

    // Update the rank based on the sorted array
    topScorers.forEach((scorer, index) => {
        scorer.rank = index + 1; // Update rank
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${scorer.rank}</td>
            <td>${scorer.name}</td>
            <td>${scorer.nationality}</td>
            <td>${scorer.team}</td>
            <td>${scorer.stats.goals}</td>
            <td>${scorer.stats.assists}</td>
        `;
        tableBody.appendChild(row);
    });
}

// Function to update table periodically
async function updateTable() {
    await populateTable();
}

// Call the function to populate the table initially
populateTable();

// Set interval to update table every 5 seconds
setInterval(updateTable, 5000);
