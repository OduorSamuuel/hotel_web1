<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .success-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .tick-icon {
            color: #007bff;
            font-size: 100px;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="tick-icon">
            &#10004;
        </div>
        <p>Account activation successul</p>
        <p>You can now log in.</p>
    </div>

    <script>

        setTimeout(function () {
            window.location.href = "{{route('home')}}";
        }, 5000);
    </script>
</body>
</html>