<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forbidden</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
            background-color: #f0e68c;
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 50px;
            color: #8b0000;
        }
        p {
            font-size: 20px;
            color: #8b0000;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #006400;
        }
    </style>
</head>
<body>
    <h1>403</h1>
    <p>Sorry, you are not authorized to access this page.</p>
    <a href="{{ url('/') }}">Return to Home</a>
</body>
</html>
