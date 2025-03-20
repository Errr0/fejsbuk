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

async function getProfileData() {
    var output = 0;
    await fetch('script.php', {
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
        output = data;
    })
    .catch(error => console.error('Error:', error));
    return output;
}

function deleteAccount(){
    if(confirm("Na pewno?")){
        fetch('script.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                deleteAccount: "deleteAccount"
            })
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            window.location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
}