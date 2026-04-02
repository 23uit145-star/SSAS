<html>
<body>


<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

if(isset($_POST['add'])){
    $lang = $_POST['language'];
    $q = $_POST['question'];
    $o1 = $_POST['o1'];
    $o2 = $_POST['o2'];
    $o3 = $_POST['o3'];
    $o4 = $_POST['o4'];
    $ca = $_POST['correct'];

    $sql = "INSERT INTO question
    (language,question,option1,option2,option3,option4,correct_answer)
    VALUES
    ('$lang','$q','$o1','$o2','$o3','$o4','$ca')";

    if(mysqli_query($conn,$sql)){
        echo "<p style='color:green'>Question Added Successfully</p>";
    } else {
        die("Query Failed: " . mysqli_error($conn));
    }
}
?>

<h3>Add Question</h3>

<form method="post">
<select name="language" required>
    <option value="">Select Language</option>
    <option value="Java">Java</option>
    <option value="PHP">PHP</option>
   <option value="Python">Python</option>

</select><br><br>

<textarea name="question" placeholder="Enter Question" required></textarea><br><br>

<input type="text" name="o1" placeholder="Option 1" required><br><br>
<input type="text" name="o2" placeholder="Option 2" required><br><br>
<input type="text" name="o3" placeholder="Option 3" required><br><br>
<input type="text" name="o4" placeholder="Option 4" required><br><br>

<input type="text" name="correct" placeholder="Correct Answer" required><br><br>

<button name="add">Add Question</button>
</form>

<br>
<a href="admindashboard.php">Back to Dashboard</a>


</html>
</body>
