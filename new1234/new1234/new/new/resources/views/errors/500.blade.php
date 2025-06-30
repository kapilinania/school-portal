<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
            background-color: #f8d7da;
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 50px;
            color: #721c24;
        }
        p {
            font-size: 20px;
            color: #721c24;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #004085;
        }
    </style>
</head>
<body>
    <h1>500</h1>
    <p>Sorry, something went wrong on our server. Please try again later.</p>
    <a href="{{ url('/') }}">Return to Home</a>
</body>
</html>
