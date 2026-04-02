<?php
$conn = new mysqli("localhost", "root", "", "online_test");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM results ORDER BY test_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>All Students Results</title>
<style>
body{
    margin:0;
    font-family: "Segoe UI", Arial, sans-serif;
    background: linear-gradient(120deg, #1f2937, #111827);
    padding:50px 20px;
}

/* Title */
h2{
    text-align:center;
    color:#ffffff;
    margin-bottom:40px;
    font-weight:600;
    letter-spacing:1px;
}

/* Glass Card Container */
.container{
    max-width:1200px;
    margin:auto;
    background:rgba(255,255,255,0.05);
    backdrop-filter: blur(10px);
    padding:35px;
    border-radius:15px;
    box-shadow:0 20px 50px rgba(0,0,0,0.4);
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:10px;
}

/* Header */
th{
    background:#2563eb;
    color:#ffffff;
    padding:16px;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:1px;
}

/* Rows */
td{
    padding:15px;
    font-size:15px;
    text-align:center;
    color:#f1f5f9;
}

/* Row Background */
tr{
    background:rgba(255,255,255,0.03);
    border-bottom:1px solid rgba(255,255,255,0.08);
}

/* Alternate */
tr:nth-child(even){
    background:rgba(255,255,255,0.06);
}

/* Hover */
tr:hover{
    background:rgba(37,99,235,0.25);
    transition:0.3s ease;
}

/* ID Badge */
.id{
    background:#2563eb;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

/* Email */
.email{
    color:#60a5fa;
    font-size:14px;
}
</style>
</head>
<body>

<h2>Students Test Results</h2>

<table>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Java</th>
    <th>Python</th>
    <th>PHP</th>
    <th>Date</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['java_marks']; ?></td>
    <td><?php echo $row['python_marks']; ?></td>
    <td><?php echo $row['php_marks']; ?></td>
    <td><?php echo $row['test_date']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>
