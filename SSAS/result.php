<?php
session_start();

// Database
$conn = new mysqli("localhost","root","","smartskill");
if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);

// Check session values
$username = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$email    = isset($_SESSION['email']) ? $_SESSION['email'] : 0;
$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : 0;

if($username != '' && $student_id > 0) {

    // Check record already exists
    $check = $conn->prepare("SELECT id FROM results WHERE student_id=?");
    $check->bind_param("i", $student_id);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){

        // Update only non-zero marks (previous marks will not be erased)
        $java   = isset($_SESSION['java_marks']) ? $_SESSION['java_marks'] : 0;
        $python = isset($_SESSION['python_marks']) ? $_SESSION['python_marks'] : 0;
        $php    = isset($_SESSION['php_marks']) ? $_SESSION['php_marks'] : 0;

        $stmt = $conn->prepare("
            UPDATE results 
            SET 
                java_marks   = IF(? > 0, ?, java_marks),
                python_marks = IF(? > 0, ?, python_marks),
                php_marks    = IF(? > 0, ?, php_marks)
            WHERE student_id=?
        ");
        $stmt->bind_param("iiiiiii",
            $java, $java,
            $python, $python,
            $php, $php,
            $student_id
        );

    } else {
        // First time insert
        $java   = isset($_SESSION['java_marks']) ? $_SESSION['java_marks'] : 0;
        $python = isset($_SESSION['python_marks']) ? $_SESSION['python_marks'] : 0;
        $php    = isset($_SESSION['php_marks']) ? $_SESSION['php_marks'] : 0;

        $stmt = $conn->prepare("
            INSERT INTO results 
            (student_id, name, email, java_marks, python_marks, php_marks) 
            VALUES (?,?,?,?,?,?)
        ");
        $stmt->bind_param("issiii", 
            $student_id, $username, $email, 
            $java, $python, $php
        );
    }

    $stmt->execute();
    $stmt->close();
}

// ✅ Fetch latest marks from DB to display in result page
$sql = $conn->prepare("SELECT java_marks, python_marks, php_marks FROM results WHERE student_id=?");
$sql->bind_param("i", $student_id);
$sql->execute();
$res = $sql->get_result();

if($res->num_rows > 0){
    $row = $res->fetch_assoc();
    $java   = $row['java_marks'];
    $python = $row['python_marks'];
    $php    = $row['php_marks'];
} else {
    $java = $python = $php = 0;
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
<title>Test Result</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body{
    margin:0;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    font-family: 'Roboto', sans-serif;
    color:white;
}
.result-box{
    background: rgba(255,255,255,0.1);
    padding: 40px 60px;
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    min-width: 450px;
    max-width: 600px;
}
.result-box h2{
    margin-bottom: 40px;
    font-size: 32px;
    font-weight: 700;
}
table{
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}
table th, table td{
    padding: 18px 20px;
    font-size: 18px;
}
table th{
    background: rgba(0,0,0,0.2);
}
.skill-strong{ color: #00ff99; font-weight: 600; }
.skill-average{ color: #ffd700; font-weight: 600; }
.skill-weak{ color: #ff4c4c; font-weight: 600; }
button{
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    padding: 14px 30px;
    color: white;
    border-radius: 12px;
    cursor: pointer;
    font-size: 18px;
}
</style>
</head>

<body>
<div class="result-box">
<h2>Test Result</h2>

<table>
<tr>
    <th>Subject</th>
    <th>Marks</th>
    <th>Skill Level</th>
</tr>

<tr>
    <td>Java</td>
    <td><?php echo $java; ?></td>
    <td class="<?php echo ($java>=30)?'skill-strong':(($java>=20)?'skill-average':'skill-weak'); ?>">
        <?php echo skill($java); ?>
    </td>
</tr>

<tr>
    <td>Python</td>
    <td><?php echo $python; ?></td>
    <td class="<?php echo ($python>=30)?'skill-strong':(($python>=20)?'skill-average':'skill-weak'); ?>">
        <?php echo skill($python); ?>
    </td>
</tr>

<tr>
    <td>PHP</td>
    <td><?php echo $php; ?></td>
    <td class="<?php echo ($php>=30)?'skill-strong':(($php>=20)?'skill-average':'skill-weak'); ?>">
        <?php echo skill($php); ?>
    </td>
</tr>

</table>

<button onclick="location.href='chart.php'">View Chart</button>
</div>
</body>
</html>
