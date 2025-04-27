
<?php


require 'includes/db_connect.php';
include 'includes/header.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Expenses/index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

//  Handle CSV Export
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    exportExpensesToCSV($conn, $user_id);
}

//  Fetch Data for Dashboard
$total = fetchTotalExpenses($conn, $user_id);
$categoryData = fetchCategorySummary($conn, $user_id);
$daywiseData = fetchDaywiseSummary($conn, $user_id);

//  Prepare arrays for Chart.js
$categories = array_column($categoryData, 'category');
$category_amounts = array_column($categoryData, 'amount');
$dates = array_column($daywiseData, 'date');
$date_amounts = array_column($daywiseData, 'amount');

   // Functions for Fetching  

function fetchTotalExpenses($conn, $user_id) {
    $result = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE user_id = $user_id");
    $row = $result->fetch_assoc();
    return $row['total'] ?? 0;
}

function fetchCategorySummary($conn, $user_id) {
    $result = $conn->query("SELECT category, SUM(amount) AS amount FROM expenses WHERE user_id = $user_id GROUP BY category");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetchDaywiseSummary($conn, $user_id) {
    $result = $conn->query("SELECT date, SUM(amount) AS amount FROM expenses WHERE user_id = $user_id GROUP BY date ORDER BY date ASC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function exportExpensesToCSV($conn, $user_id) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="expenses.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Date', 'Category', 'Amount']);

    $expenses = $conn->query("SELECT date, category, amount FROM expenses WHERE user_id=$user_id ORDER BY date ASC");
    while($row = $expenses->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

?>

<!-- html -->

<h2>Expense Summary</h2>

<div class="mb-4">
  <h4>Total Spent: ₹<?= htmlspecialchars($total) ?></h4>
  <a href="summary.php?export=csv" class="btn btn-success">Export to CSV</a>
</div>

<div class="row">
  <div class="col-md-6">
    <h5>Category Wise Expense</h5>
    <canvas id="categoryChart"></canvas>
  </div>
  <div class="col-md-6">
    <h5>Day Wise Expense</h5>
    <canvas id="daywiseChart"></canvas>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
//  Chart.js Scripts

// Category Doughnut Chart
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($categories) ?>,
        datasets: [{
            label: 'Category Expenses',
            data: <?= json_encode($category_amounts) ?>,
            backgroundColor: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#E7E9ED'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
    }
});

// Daywise Line Chart
const daywiseCtx = document.getElementById('daywiseChart').getContext('2d');
new Chart(daywiseCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode($dates) ?>,
        datasets: [{
            label: 'Expenses Over Time',
            data: <?= json_encode($date_amounts) ?>,
            borderColor: '#4BC0C0',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

