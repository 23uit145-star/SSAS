<?php
$conn = mysqli_connect("localhost","root","","smartskill");

$query = "SELECT name,email,subject,marks FROM results";
$result = mysqli_query($conn,$query);
?>

<h2>Student Marks List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Marks</th>
    <th>Skill Level</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
    $marks = $row['marks'];

    if($marks >= 40)
        $level = "Strong";
    elseif($marks >= 25)
        $level = "Average";
    else
        $level = "Weak";
?>
<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['subject']; ?></td>
    <td><?php echo $row['marks']; ?></td>
    <td><?php echo $level; ?></td>
</tr>
<?php } ?>

</table>