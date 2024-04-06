<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Blimley Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
        }

        p {
            font-size: 18px;
            color: #444;
        }

        .button {
            display: inline-block;
            background-color: #ff6347;
            color: #fff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #ff4e2a;
        }

        .footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Blimley hotel</div>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>Thank you for choosing Blimley Hotel. Your registration is almost complete. Click the button below to finish the process:</p>
            <a href="{{ $tokenLink }}" class="button">Complete Registration</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date("Y") }} Blimley Restaurant</p>
        </div>
    </div>
</body>
</html>
