console.log('Hello, world!');


async function fetchData() {
    try {
        const response = await fetch('https://599768-3.web.fhgr.ch/endpoint.php');
        const data = await response.json();
        return data;
        return data;
    } catch (error) {
        console.error(error);
    }
}

async function main() {
let data = await fetchData();
let date = data.date;
let location = data.location;
let lastValue = data.lastValue;

console.log ('Date: ' + date);
console.log ('Location: ' + location);      
console.log ('Last Value: ' + lastValue);




const ctx = document.getElementById('myChart').getContext('2d');

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

main();
}

