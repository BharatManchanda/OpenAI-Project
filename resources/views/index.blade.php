<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prompt API Fetch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .input-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .input-group button:hover {
            background-color: #218838;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="input-group">
        <label for="prompt">Enter your prompt:</label>
        <input type="text" id="prompt" placeholder="Type something...">
    </div>
    <div class="input-group">
        <button id="submit-btn">Submit</button>
    </div>
    <div class="result" id="result">
        
    </div>
</div>

<script>
    document.getElementById('submit-btn').addEventListener('click', function() {
        const prompt = document.getElementById('prompt').value;
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = 'Loading...';

        fetch('{{ route("api.prompt") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ prompt: prompt })
        })
        .then(response => response.json())
        .then(response => {
            console.log(response.data.data,"::data");
            resultDiv.innerHTML = response.data;
        })
        .catch(error => {
            resultDiv.innerHTML = 'Error: ' + error.message;
        });
    });
</script>

</body>
</html>
