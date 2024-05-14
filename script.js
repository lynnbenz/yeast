


async function fetchData() {
    try {
        const response = await fetch('https://599768-3.web.fhgr.ch/endpoint.php');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}
async function main() {
    let data = await fetchData();
    let date = data.dates;
    let location = data.locations;
    let lastValue = data.lastValues;

    console.log('Date: ' + date);
    console.log('Location: ' + location);
    console.log('Last Value: ' + lastValue);

    if (lastValue >= 0 && lastValue <= 50) {
        document.getElementById('dhopagachi-pin').style.fill = 'green';
    } else if (lastValue >= 51 && lastValue <= 100) {
        document.getElementById('dhopagachi-pin').style.fill = 'yellow';
    } else if (lastValue >= 101 && lastValue <= 150) {
        document.getElementById('dhopagachi-pin').style.fill = 'orange';
    } else if (lastValue > 150) {
        document.getElementById('dhopagachi-pin').style.fill = 'red';
    } else {
        // Handle the case when lastValue is outside the specified ranges
        // You can set a default color or handle it in a different way
    }
}



// const ctx = document.getElementById('myChart').getContext('2d');

async function fetchData() {
    try {
        const response = await fetch('https://599768-3.web.fhgr.ch/endpoint.php');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}

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

async function main() {
    let data = await fetchData();
    let date = data.dates;
    let lastValue = data.lastValues;

    console.log('Date: ' + date);
    console.log('Last Value: ' + lastValue);

    createLineChart(date, lastValue);
}



// Slider für die Auswahl des Datums

const airQualityData = [
    { date: "2024-05-01",},
    { date: "2024-05-02", },
    { date: "2024-05-03", },
    { date: "2024-05-04",  },
    { date: "2024-05-05",  },
    { date: "2024-05-06",  },
    { date: "2024-05-07",  },
    { date: "2024-05-08",  },
    { date: "2024-05-09",  },
    { date: "2024-05-10",  },
    { date: "2024-05-11",  },
    { date: "2024-05-12",  },
    { date: "2024-05-13",  },
    { date: "2024-05-14",  }
];

let currentDayIndex = airQualityData.length - 1;

// Funktion zum Aktualisieren der Luftqualität-Anzeige
function updateAirQuality() {
    const slider = document.getElementById("dateSlider");
    const airQualityDisplay = document.getElementById("air-quality");

    // Index des ausgewählten Tages aus dem Slider-Wert erhalten
    const selectedDayIndex = parseInt(slider.value);

    // Luftqualität für den ausgewählten Tag anzeigen
    const selectedDay = airQualityData[selectedDayIndex];
    airQualityDisplay.textContent = `Luftqualität am ${selectedDay.date}: ${selectedDay.quality}`;
}

// Funktion für den "Zurück"-Button
function prevDay() {
    const slider = document.getElementById("dateSlider");
    if (currentDayIndex > 0) {
        currentDayIndex--;
        slider.value = currentDayIndex;
        updateAirQuality();
    }
}

// Funktion für den "Vor"-Button
function nextDay() {
    const slider = document.getElementById("dateSlider");
    if (currentDayIndex < airQualityData.length - 1) {
        currentDayIndex++;
        slider.value = currentDayIndex;
        updateAirQuality();
    }
}

// Initialisierung der Luftqualität-Anzeige beim Laden der Seite
window.onload = function() {
    updateAirQuality();
};

main();

