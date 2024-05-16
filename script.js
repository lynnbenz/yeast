// Variablen für Städte und zugehörige Pin-IDs
const locations = ['Dhopagachi', 'Kunjaban', 'Hanoi', 'Guangzhou', 'Mae Hong Son'];
const locationPins = ['Dhopagachi', 'Kunjaban', 'Hanoi', 'Guangzhou', 'Mae_Hong_Son'];

// Funktion zum Datenabruf über API
async function fetchData() {
    try {
        const response = await fetch('https://599768-3.web.fhgr.ch/endpoint.php');
        const fetchedData = await response.json();
        return fetchedData;
    } catch (error) {
        console.error(error);
        return null; // Bei Fehler null zurückgeben
    }
}

// Funktion zur Aktualisierung der Pin-Farben basierend auf den Daten
async function updatePinColors(data, formattedDate) {
    locations.forEach(async (location) => {
        const locationObject = data.find((element) => element.location === location && element.date === formattedDate);
        const pinId = `${location.replaceAll(' ', '_')}-pin`;
        const pinElement = document.getElementById(pinId);

        if (locationObject && pinElement) {
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
    });
}

// Hauptfunktion zur Initialisierung
async function main(dayDifference = 0) {
    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate() - dayDifference);
    const formattedDate = currentDate.toISOString().slice(0, 10);

    const data = await fetchData();

    if (data) {
        await updatePinColors(data, formattedDate);
        // Weitere Verarbeitung der Daten (z. B. Erstellung eines Liniendiagramms)
    }
}

// Initiale Ausführung der main-Funktion
main();

// Eventlistener für Änderungen am Input-Feld
const rangeInput = document.getElementById('myRange');
const daysAgoElement = document.getElementById('daysago');

rangeInput.addEventListener('input', async (event) => {
    daysAgoElement.textContent = event.target.value;
    await main(event.target.value);
});

// Eventlistener für Hover-Effekte auf Pins und Texte
locationPins.forEach(location => {
    const pinElement = document.getElementById(`${location}-pin`);
    const textElement = document.getElementById(`${location}-text`);

    if (pinElement && textElement) {
        pinElement.addEventListener('mouseenter', () => {
            textElement.style.display = 'block';
        });

        pinElement.addEventListener('mouseleave', () => {
            textElement.style.display = 'none';
        });
    }
});

// Funktionen zur Datenverarbeitung
function calculateAveragePM(data) {
    const sum = data.reduce((acc, city) => acc + city.lastValue, 0);
    return sum / data.length;
}

function findCityWithExtremumValue(data, comparator) {
    let extremumValue = comparator === 'max' ? Number.MIN_VALUE : Number.MAX_VALUE;
    let extremumCity = '';

    data.forEach(city => {
        if ((comparator === 'max' && city.lastValue > extremumValue) || 
            (comparator === 'min' && city.lastValue < extremumValue)) {
            extremumValue = city.lastValue;
            extremumCity = city.city;
        }
    });

    return extremumCity;
}

// Daten für die Berechnungen
const cityData = [
    { city: 'Dhopagachi', lastValue: 45 },
    { city: 'Kunjaban', lastValue: 60 },
    { city: 'Hanoi', lastValue: 35 },
    { city: 'Guangzhou', lastValue: 70 },
    { city: 'Mae Hong Son', lastValue: 25 }
];

// Berechnungen ausführen und Ergebnisse anzeigen
const averagePM = calculateAveragePM(cityData);
const cityWithLowestValue = findCityWithExtremumValue(cityData, 'min');
const cityWithHighestValue = findCityWithExtremumValue(cityData, 'max');

document.getElementById('lowestLastValue').textContent = cityWithLowestValue;
document.getElementById('highestLastValue').textContent = cityWithHighestValue;
