


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
console.log(data[8]);
let date = data.dates;
let location = data.locations;
let lastValue = data.lastValues;

console.log ('Date: ' + date);
console.log ('Location: ' + location);      
console.log ('Last Value: ' + lastValue);


if (lastValue >= 0 && lastValue <= 50) {
    document.getElementById('dhopagachi-pin').style.fill = 'green';
} else if (lastValue >= 51 && lastValue <= 100) {
    document.getElementById('dhopagachi-pin').style.fill = 'yellow';
} else if (lastValue >= 101 && lastValue <= 150) {
    document.getElementById('dhopagachi-pin').style.fill = 'orange';
} else if (lastValue >= 151 && lastValue <= 200) {
    document.getElementById('dhopagachi-pin').style.fill = 'red';
} else {
    // Handle the case when lastValue is outside the specified ranges
    // You can set a default color or handle it in a different way
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

async function main() {
    let data = await fetchData();
    let date = data.date;
    let lastValue = data.lastValue;

    console.log('Date: ' + date);
    console.log('Last Value: ' + lastValue);

    createLineChart(date, lastValue);
}
}

main();

