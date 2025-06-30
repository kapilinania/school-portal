<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            color: #4CAF50;
            font-size: 22px;
            margin-bottom: 15px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .credentials {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #4CAF50;
        }
        .credentials p {
            margin: 0;
            padding: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            padding: 20px;
            color: #888;
            border-top: 1px solid #e0e0e0;
        }
        .footer p {
            margin: 0;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        Welcome to Our School
    </div>
    <div class="content">
        <h1>Dear {{ $teacher->name }},</h1>
        <p>We are pleased to inform you that your teacher account has been successfully created. Below are your account credentials:</p>
        
        <div class="credentials">
            <p><strong>Teacher ID:</strong> {{ $teacher->teacher_id }}</p>
            <p><strong>Email:</strong> {{ $teacher->email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>

        <p>Please log in to your account and change your password for security purposes.</p>

        <p>If you need assistance, feel free to reach out to our <a href="mailto:support@school.com">support team</a>.</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} Our School. All rights reserved.</p>
    </div>
</div>

</body>
</html>
