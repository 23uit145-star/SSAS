<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) 
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email && $password) 
    {
        // 🔥 Database check add pannunga
        include 'db.php';

        $sql = "SELECT * FROM student WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);

            // Already iruka session
            $_SESSION['user'] = $email;

            // 🔥 NEW SESSION VALUES (Result page ku thevai)
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            $error = "Invalid Email or Password!";
        }
    } 
    else 
    {
        $error = "Invalid Email or Password!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>

    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:"Segoe UI", Arial, sans-serif;}
        body{height:100vh;display:flex;justify-content:center;align-items:center;background: linear-gradient(135deg, #5f7cff, #8f5bff);}
        .login-card{width:380px;background:#ffffff;border-radius:10px;box-shadow:0 8px 25px rgba(0,0,0,0.2);padding:30px;}
        h2{text-align:center;color:#3f51b5;margin-bottom:25px;font-weight:600;}
        .form-group{margin-bottom:15px;}
        .form-group label{display:block;margin-bottom:5px;font-size:14px;color:#555;}
        .form-group input{width:100%;padding:10px;border:1px solid #ccc;border-radius:4px;font-size:14px;}
        .form-group input:focus{border-color:#5f7cff;outline:none;}
        .btn-login{width:100%;margin-top:10px;padding:12px;background: linear-gradient(135deg, #5f7cff, #3f51b5);border:none;color:#ffffff;font-size:16px;border-radius:5px;cursor:pointer;transition:0.3s;}
        .btn-login:hover{opacity:0.9;}
        .view-link{display:block;margin-top:15px;padding:10px;text-align:center;border-radius:5px;background:#f1f3ff;color:#3f51b5;font-size:14px;font-weight:600;text-decoration:none;transition:0.3s;}
        .view-link:hover{background:#3f51b5;color:#ffffff;}
        .register-link{text-align:center;margin-top:15px;font-size:14px;}
        .register-link a{color:#3f51b5;text-decoration:none;font-weight:500;}
        .register-link a:hover{text-decoration:underline;}
        .error{color:red;font-size:14px;text-align:center;margin-bottom:10px;}
    </style>
</head>

<body>

<div class="login-card">
    <h2>Student Login</h2>

    <?php if($error != ""){ ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="post">
        <div class="form-group">
            <label>Email :</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password :</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn-login" name="login">Login</button>
    </form>

    <!-- VIEW REGISTERED STUDENTS BUTTON -->
    <a href="view_student.php" class="view-link">
        View Registered Students
    </a>

    <div class="register-link">
        New user? <a href="register.php">Register</a>
    </div>
</div>

</body>
</html>


