<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Unavailable</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
            background-color: #dcdcdc;
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 50px;
            color: #343a40;
        }
        p {
            font-size: 20px;
            color: #343a40;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #17a2b8;
        }
    </style>
</head>
<body>
    <h1>503</h1>
    <p>The server is currently down for maintenance. Please check back later.</p>
    <a href="{{ url('/') }}">Return to Home</a>
</body>
</html>
