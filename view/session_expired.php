<!DOCTYPE html>
<html>

<head>
    <title>Session Timeout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
        }

        .button {

            color: #fff;
            background: linear-gradient(to right, #33a3ff, #0675cf, #4cd5ff);
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            line-height: 38px;
            width: 100%;
            height: 40px;
            padding: 0;
            border: none;
            border-radius: 5px;
            border: none;
            display: inline-block;
            transition: all 0.6s ease 0s;
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Session Timeout</h1>
        <p>Your session has timed out due to inactivity.</p>
        <a href="../login.php" class="button">Log In</a>
    </div>
</body>

</html>