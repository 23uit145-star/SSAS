<?php
$conn = mysqli_connect("localhost", "root", "", "examdb");

if (!$conn) {
    die("DB connect aagala");
}

$sql = "
SELECT a.userid, COUNT(*) AS marks
FROM answers a
JOIN questions q ON a.questionid = q.id
WHERE a.selectedoption = q.correctoption
GROUP BY a.userid
";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "Student ID: ".$row['user_id']."<br>";
    echo "Marks: ".$row['marks']."<hr>";
}
?>
