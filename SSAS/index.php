<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Skill Analyzing System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #5f7cff, #8f5bff);
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            padding: 40px 60px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        h1 {
            color: #ffffff;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
        }

        .btn-group {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            text-decoration: none;
            padding: 12px 28px;
            background-color: #ffffff;
            color: #5f7cff;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #eaeaea;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Smart Skill Analyzing System</h1>

        <div class="btn-group">
            <a href="login.php" class="btn">Student Login</a>
            <a href="register.php" class="btn">Student Registration</a>
        </div>
    </div>

</body>
</html>
