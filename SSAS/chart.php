<?php
session_start();
include 'db.php'; // Database connection

$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : 0;

// Default marks
$java = $python = $php = 0;

// Fetch marks from database
if($student_id > 0){
    $stmt = $conn->prepare("SELECT java_marks, python_marks, php_marks FROM results WHERE student_id=?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        $java   = $row['java_marks'];
        $python = $row['python_marks'];
        $php    = $row['php_marks'];
    }
}

$maxMarks = 40; // Max marks for Y-axis
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Result Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
    console.log(ChartDataLabels);
</script>
    <style>
        body{
            margin:0;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            font-family:"Segoe UI", Arial, sans-serif;
            background: linear-gradient(to right, #3a1c71, #d76d77, #ffaf7b);
            color:white;
        }

        .chart-container{
            width:500px;
            height:350px;
            background: rgba(255,255,255,0.08);
            padding:20px;
            border-radius:15px;
            text-align:center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        h2{
            margin-bottom:20px;
            font-weight:700;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>

<div class="chart-container">
    <h2>Marks Chart</h2>
    <canvas id="resultChart" width="500" height="300"></canvas>

    <script>
        // Marks fetched from DB
        const javaMarks   = <?php echo $java; ?>;
        const pythonMarks = <?php echo $python; ?>;
        const phpMarks    = <?php echo $php; ?>;
        const maxMarks    = <?php echo $maxMarks; ?>;

        const ctx = document.getElementById('resultChart').getContext('2d');

        Chart.register(ChartDataLabels);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Java', 'Python', 'PHP'],
                datasets: [{
                    label: 'Marks Obtained',
                    data: [javaMarks, pythonMarks, phpMarks],
                    backgroundColor: ['#FF5722', '#00BCD4', '#9C27B0'],
                    borderRadius: 10,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#222',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 10,
                        cornerRadius: 6
                    },
                    datalabels: {
                        display: true,
                        color: '#fff',
                        anchor: 'end',
                        align: 'end',
                        font: { weight: 'bold', size: 14 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: maxMarks,
                        ticks: {
                            stepSize: 5,
                            color: '#fff',
                            font: { size: 14, weight: '600' }
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.3)',
                            borderDash: [4,4]
                        }
                    },
                    x: {
                        ticks: { color: '#fff', font: { size: 14, weight: '600' } },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</div>

</body>
</html>
