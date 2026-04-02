<html>
<body>
<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $u = mysqli_real_escape_string($conn,$_POST['username']);
    $p = mysqli_real_escape_string($conn,$_POST['password']);

    $res = mysqli_query($conn,"SELECT * FROM admin WHERE username='$u' AND password='$p'");

    if(mysqli_num_rows($res) > 0){
        $_SESSION['admin'] = $u;
        header("Location: admindashboard.php");
        exit;
    } else {
        echo "<p style='color:red'>Invalid Login</p>";
    }
}
?>

<form method="post">
<h3>Admin Login</h3>
<input type="text" name="username" placeholder="Username" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<button name="login">Login</button>
</form>


</html>
</body>


