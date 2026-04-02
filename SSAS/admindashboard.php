<html>
<body>
<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: adminlogin.php");
    exit;
}
?>

<h3>Admin Dashboard</h3>
<p>Welcome, <?php echo $_SESSION['admin']; ?></p>

<a href="addquestion.php">Add Question</a><br><br>
<a href="adminlogout.php">Logout</a>

</html>
</body>
