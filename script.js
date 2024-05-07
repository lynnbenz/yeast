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
console.log(data);
}

main();
