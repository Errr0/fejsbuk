function get_data() {
    fetch('script.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            get_data: "get_data"
        })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('result').innerText = data.output;
    })
    .catch(error => console.error('Error:', error));
}

function send_data() {
    fetch('script.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            send_data: "send_data"
        })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('result').innerText = data.output;
    })
    .catch(error => console.error('Error:', error));
}

function getProfileData() {
    fetch('script.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            getProfileData: "getProfileData"
        })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('result').innerText = data.output;
    })
    .catch(error => console.error('Error:', error));
}