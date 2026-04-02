<?php
include 'db.php';
session_start();

// Fetch registered students
$sql = "SELECT id, name, email FROM student ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $students[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Students</title>
    <style>
        body{font-family:"Segoe UI", Arial, sans-serif; padding:50px; background:#f1f3ff;}
        h2{text-align:center;color:#3f51b5;margin-bottom:25px;}
        table{width:100%;border-collapse:collapse;margin-top:20px;background:white;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        th, td{border:1px solid #ccc;padding:10px;text-align:left;}
        th{background:#667eea;color:white;}
        .back-btn{display:block;width:150px;margin:20px auto;padding:10px;text-align:center;background:#3f51b5;color:white;text-decoration:none;border-radius:5px;}
        .back-btn:hover{opacity:0.9;}
    </style>
</head>
<body>

<h2>Registered Students</h2>

<?php if(count($students) > 0){ ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php foreach($students as $s){ ?>
        <tr>
            <td><?php echo $s['id']; ?></td>
            <td><?php echo htmlspecialchars($s['name']); ?></td>
            <td><?php echo htmlspecialchars($s['email']); ?></td>
        </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p style="text-align:center;">No students have registered yet.</p>
<?php } ?>

<a href="login.php" class="back-btn">Back to Login</a>

</body>
</html>
