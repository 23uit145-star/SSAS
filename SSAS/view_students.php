<?php
include 'db.php';
session_start();

// Fetch students and their marks
$sql = "SELECT s.id, s.name, s.email, 
               r.java_marks, r.python_marks, r.php_marks
        FROM student s
        LEFT JOIN results r ON s.id = r.student_id
        ORDER BY s.id DESC";

$result = mysqli_query($conn, $sql);
if(!$result){
    die("Query Error: " . mysqli_error($conn));
}

// Skill function
function skill($m){
    if($m >= 30) return "Strong";
    elseif($m >= 20) return "Average";
    else return "Weak";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Students & Marks</title>
<style>
table{border-collapse: collapse; width:100%;}
th, td{border:1px solid #ccc; padding:10px; text-align:center;}
th{background:#667eea; color:white;}
.skill-strong{color:#00ff99;font-weight:600;}
.skill-average{color:#ffd700;font-weight:600;}
.skill-weak{color:#ff4c4c;font-weight:600;}
</style>
</head>
<body>
<center><h2>All Students & Marks</h2></center>
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Java</th>
    <th>Python</th>
    <th>PHP</th>
    <th>Java Skill</th>
    <th>Python Skill</th>
    <th>PHP Skill</th>
</tr>

<?php while($s = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $s['id']; ?></td>
    <td><?php echo htmlspecialchars($s['name']); ?></td>
    <td><?php echo htmlspecialchars($s['email']); ?></td>
    <td><?php echo isset($s['java_marks']) ? $s['java_marks'] : '-'; ?></td>
    <td><?php echo isset($s['python_marks']) ? $s['python_marks'] : '-'; ?></td>
    <td><?php echo isset($s['php_marks']) ? $s['php_marks'] : '-'; ?></td>
    <td class="<?php echo isset($s['java_marks']) ? (($s['java_marks']>=30)?'skill-strong':(($s['java_marks']>=20)?'skill-average':'skill-weak')) : ''; ?>">
        <?php echo isset($s['java_marks']) ? skill($s['java_marks']) : '-'; ?>
    </td>
    <td class="<?php echo isset($s['python_marks']) ? (($s['python_marks']>=30)?'skill-strong':(($s['python_marks']>=20)?'skill-average':'skill-weak')) : ''; ?>">
        <?php echo isset($s['python_marks']) ? skill($s['python_marks']) : '-'; ?>
    </td>
    <td class="<?php echo isset($s['php_marks']) ? (($s['php_marks']>=30)?'skill-strong':(($s['php_marks']>=20)?'skill-average':'skill-weak')) : ''; ?>">
        <?php echo isset($s['php_marks']) ? skill($s['php_marks']) : '-'; ?>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
