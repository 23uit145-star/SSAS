<?php
session_start();
include "db.php";

if (!isset($_POST['subject'])) {
    header("Location: index.php");
    exit;
}

$subject = $_POST['subject'];   // Java / PHP / Python
$marks = 0;

$q = mysqli_query($conn, "SELECT * FROM question WHERE language='$subject'");

while ($row = mysqli_fetch_assoc($q)) {
    $qid = $row['question_id'];

    if (isset($_POST['ans' . $qid])) {
        $userAns    = strtoupper($_POST['ans' . $qid]);
        $correctAns = strtoupper($row['correct_answer']);

        if ($userAns == $correctAns) {
            $marks++;
        }
    }
}

/* ✅ SUBJECT BASED SESSION STORE */
if ($subject == "Java") {
    $_SESSION['java_marks'] = $marks;
}
elseif ($subject == "PHP") {
    $_SESSION['php_marks'] = $marks;
}
elseif ($subject == "Python") {
    $_SESSION['python_marks'] = $marks;
}

header("Location: result.php");
exit;
?>
