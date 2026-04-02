<?php
include 'db.php';

if(isset($_POST['register'])){
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    // Optional: you can hash the password for security
    // $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO student(name,email,password)
            VALUES('$name','$email','$pass')";

    if(mysqli_query($conn,$sql)){
        // Registration successful: alert and redirect to login page
        echo "<script>
                alert('Registration Successful');
                window.location.href='login.php';
              </script>";
        exit(); // stop executing the rest of the page
    } else {
        // If there is an error
        echo "<script>
                alert('Error: ".mysqli_error($conn)."');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            min-height:100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            background:#fff;
            width:420px;
            padding:30px;
            border-radius:12px;
            box-shadow:0 15px 40px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
            color:#333;
        }

        label{
            display:block;
            text-align:left;
            margin-top:12px;
            margin-bottom:5px;
            font-weight:600;
            color:#444;
        }

        input{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:8px;
            font-size:15px;
        }

        button{
            width:100%;
            padding:12px;
            margin-top:20px;
            border:none;
            border-radius:8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color:white;
            font-size:16px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            transform:scale(1.05);
            opacity:0.9;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Register</h2>

    <form method="post">

        <label>Name :</label>
        <input type="text" name="name" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <label>Password :</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">Register Now</button>

    </form>
</div>

</body>
</html>
