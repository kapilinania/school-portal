<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 20px;
        }

        h1 {
            font-size: 100px;
            margin: 0;
            animation: bounce 1s infinite alternate;
        }

        p {
            font-size: 22px;
            margin-top: 10px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 12px 25px;
            background-color: #ffffff;
            color: #764ba2;
            border-radius: 30px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a:hover {
            background-color: #f3f3f3;
            transform: scale(1.05);
        }

        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-10px); }
        }

        @media (max-width: 500px) {
            h1 {
                font-size: 70px;
            }

            p {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! The page you're looking for doesn't exist.</p>
        <a href="{{ url('/') }}">🏠 Go Back Home</a>
    </div>
</body>
</html>
