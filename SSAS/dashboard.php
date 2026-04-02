<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['java'])) {
        header("Location: test_java.php");
        exit();
    }

    if (isset($_POST['php'])) {
        header("Location: test_php.php");
        exit();
    }

    if (isset($_POST['python'])) {
        header("Location: test_python.php");
        exit();
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body{
            margin:0;
            height:100vh;
            font-family:'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #4a90e2, #b37ddb);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .card{
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            width:360px;
            padding:30px;
            border-radius:18px;
            text-align:center;
            box-shadow:0 25px 45px rgba(0,0,0,0.25);
        }

        h2{
            margin-bottom:6px;
            color:#333;
        }

        .user{
            margin-bottom:25px;
            font-size:14px;
            color:#666;
        }

        .btn{
            width:100%;
            padding:13px;
            margin:10px 0;
            background: linear-gradient(135deg, #5f7cff, #3f51b5);
            color:white;
            border:none;
            border-radius:12px;
            font-size:16px;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(63,81,181,0.45);
        }

        /* 🔥 Stylish Logout */
        .logout-btn{
            margin-top:25px;
            width:100%;
            padding:14px;
            border-radius:40px;
            border:none;
            font-size:16px;
            font-weight:700;
            letter-spacing:1px;
            cursor:pointer;
            color:#fff;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            transition:0.4s;
        }

        .logout-btn:hover{
            transform:scale(1.08);
            box-shadow:0 0 30px rgba(255,75,92,0.9);
        }
    </style>

    <!-- 🔔 LOGOUT CONFIRM SCRIPT -->
    <script>
        function confirmLogout(){
            if(confirm("Are you sure you want to logout?")){
                document.getElementById("logoutForm").submit();
            }
        }
    </script>
</head>

<body>

<div class="card">
    <h2>Welcome Student</h2>
    <div class="user">
        Logged in as <b><?php echo $_SESSION['user']; ?></b>
    </div>

    <!-- MAIN FORM -->
    <form method="post" id="logoutForm">
        <button class="btn" name="java">Start Java Test</button>
        <button class="btn" name="php">Start PHP Test</button>
        <button class="btn" name="python">Start Python Test</button>

        <!-- ✅ Logout with confirmation -->
        <button type="button" class="logout-btn" onclick="confirmLogout()">
            LOGOUT
        </button>

        <!-- hidden real logout submit -->
        <input type="hidden" name="logout">
    </form>
</div>

</body>
</html>
