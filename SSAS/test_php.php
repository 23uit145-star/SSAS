<?php
session_start();
$_SESSION['current_subject'] = 'php';

// Reset other subject marks
$_SESSION['python_marks'] = 0;
$_SESSION['php_marks'] = 0;

// Optional: reset java also before starting
$_SESSION['java_marks'] = 0;
?>
<!DOCTYPE html>
<html>
<head>
<title>PHP Test</title>
<style>
body{
    font-family: 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(135deg,#6a85ff,#9a6bff);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:0;
}

.card{
    background: rgba(255,255,255,0.95);
    width:900px;
    max-height:85vh;
    padding:25px 30px;
    border-radius:12px;
    box-shadow:0 15px 40px rgba(0,0,0,0.25);
    overflow-y:auto;
}

h2{
    text-align:center;
    color:#3a3a3a;
    margin-bottom:25px;
    font-weight:600;
}

.question{
    margin-bottom:20px;
    padding:15px;
    border-radius:10px;
    background: #f1f5ff;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
}

.question p{
    margin-bottom:10px;
    font-weight:500;
    color:#333;
}

.options label{
    display:block;
    padding:8px 12px;
    margin-bottom:8px;
    border-radius:6px;
    background:#e3e8ff;
    cursor:pointer;
    transition:0.3s;
}

.options input[type="radio"]{
    margin-right:10px;
}

.options label:hover{
    background:#c5d1ff;
}

button{
    width:100%;
    padding:12px;
    margin-top:20px;
    background: linear-gradient(135deg, #4a6cff, #3a5be0);
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    transform:scale(1.03);
    opacity:0.9;
}
</style>
</head>

<body>
<div class="card">
<h2>PHP TEST</h2>

<form action="submit_test.php" method="post" id="phpTestForm">

<input type="hidden" name="subject" value="PHP">

<?php
include "db.php";

$q = mysqli_query($conn,"SELECT * FROM question WHERE language='PHP'");
$i = 1;

while($row = mysqli_fetch_assoc($q)){
    $qid = $row['question_id'];
    echo "<div class='question'>";
    echo "<p>".$i.". ".$row['question']."</p>";
    echo "<div class='options'>";
    echo "<label><input type='radio' name='ans$qid' value='A'> ".$row['option1']."</label>";
    echo "<label><input type='radio' name='ans$qid' value='B'> ".$row['option2']."</label>";
    echo "<label><input type='radio' name='ans$qid' value='C'> ".$row['option3']."</label>";
    echo "<label><input type='radio' name='ans$qid' value='D'> ".$row['option4']."</label>";
    echo "</div>";
    echo "</div>";
    $i++;
}
?>

<button type="submit">Submit Test</button>
</form>
</div>

<script>
// ✅ Validation: ensure all questions answered
document.getElementById("phpTestForm").onsubmit = function(e){
    let questions = document.querySelectorAll(".question");
    for(let i=0; i<questions.length; i++){
        let radios = questions[i].querySelectorAll("input[type='radio']");
        let answered = false;
        for(let j=0; j<radios.length; j++){
            if(radios[j].checked){
                answered = true;
                break;
            }
        }
        if(!answered){
            alert("Please answer all questions before submitting!");
            e.preventDefault();
            return false;
        }
    }
}
</script>

</body>
</html>
