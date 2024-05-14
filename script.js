


async function fetchData() {
    try {
        const response = await fetch('https://599768-3.web.fhgr.ch/endpoint.php');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}

let data = null;
const locations = ['Dhopagachi', 'Kunjaban', 'Hanoi', 'Guangzhou', 'Mae Hong Son'];

async function fetchData() {
    try {
        const response = await fetch('https://599768-3.web.fhgr.ch/endpoint.php');
        const fetchedData = await response.json();
        return fetchedData;
    } catch (error) {
        console.error(error);
        return null; // Return null in case of error
    }
}

async function main(dayDifference = 0) {
    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate() - dayDifference);
    const formattedDate = currentDate.toISOString().slice(0, 10);

    // Fetch data based on the formatted date
    data = await fetchData();

    if (data) {
        // Iterate through locations and update pin colors based on fetched data
        locations.forEach(async (location) => {
            const locationObject = data.find((element) => element.location === location && element.date === formattedDate);

            if (locationObject) {
                const pinId = `${location.replaceAll(' ', '_')}-pin`;

                // Update pin color based on lastValue range
                const pinElement = document.getElementById(pinId);
                if (pinElement) {
                    if (locationObject.lastValue >= 0 && locationObject.lastValue <= 50) {
                        pinElement.style.fill = 'lightgreen';
                    } else if (locationObject.lastValue >= 51 && locationObject.lastValue <= 100) {
                        pinElement.style.fill = 'lightyellow';
                    } else if (locationObject.lastValue >= 101 && locationObject.lastValue <= 150) {
                        pinElement.style.fill = 'lightorange';
                    } else if (locationObject.lastValue >= 151 && locationObject.lastValue <= 200) {
                        pinElement.style.fill = 'red';
                    }
                }
            }
        });

        // Create line chart based on fetched data  

       
   
}
    const labels = data.map((element) => element.date);
    const values = data.map((element) => element.lastValue);

    createLineChart(labels, values);
}

// const ctx = document.getElementById('myChart').getContext('2d');

function createLineChart(labels, data) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Last Value',
                data: data,
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Last Value'
                    }
                }
            }
        }
    });
}
    



main();

