
<?php

require 'includes/db_connect.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Expenses/index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $conn->real_escape_string($_POST['description']);
    $amount = $_POST['amount'];
    $category = $conn->real_escape_string($_POST['category']);
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO expenses (user_id, description, amount, category, date) VALUES ($user_id, '$description', $amount, '$category', '$date')");
    header("Location: http://localhost/Expenses/dashboard.php");
}
?>

<div class="expense-card">
  <h2 class="form-title">Add Expense</h2>
  
  <form method="POST">
    <div class="mb-3">
      <label>Description</label>
      <input type="text" name="description" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Amount</label>
      <input type="number" name="amount" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Category</label>
      <input type="text" name="category" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Date</label>
      <input type="date" name="date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Add Expense</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
