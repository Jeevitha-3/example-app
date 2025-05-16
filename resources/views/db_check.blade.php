<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        async function checkDB() {
            const response = await fetch('/db-check');
            const result = await response.json();
            const output = document.getElementById('result');

            if (response.ok) {
                output.innerText = result.message;
                output.style.color = 'green';
            } else {
                output.innerText = result.error + ' - ' + result.details;
                output.style.color = 'red';
            }
        }

        window.onload = checkDB;
    </script>
</head>
<body>
        <h1>Database Connection Status</h1>
        <p id="result">Checking...</p>
</body>
</html>