<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Credentials</title>
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
            background-color: #0056b3;
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
        .content h2 {
            color: #0056b3;
            font-size: 22px;
            margin-bottom: 15px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #0056b3;
        }
        .details p {
            margin: 0;
            padding: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            padding: 20px;
            color: #888;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            Welcome to Our School
        </div>
        <div class="content">
            <h2>Dear {{ $student->name }},</h2>
            <p>We are excited to have you as part of our institution. Below are your account credentials:</p>
            
            <div class="details">
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
                <p><strong>Admission Number:</strong> {{ $admission_no }}</p>
            </div>
            
            <p>You can log in to your student dashboard using the following link:</p>
            <a href="{{ route('student.login') }}" class="btn">Login to Your Account</a>
            
            <div class="footer">
                <p>If you have any questions, feel free to reach out to us at <a href="mailto:support@school.com">support@school.com</a>.</p>
                <p>Best regards,<br>School Administration</p>
            </div>
        </div>
    </div>
</body>
</html>
