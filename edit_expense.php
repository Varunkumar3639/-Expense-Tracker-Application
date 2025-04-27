
<?php

require 'includes/db_connect.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Expenses/index.php');
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM expenses WHERE id=$id AND user_id=$user_id");
$expense = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $conn->real_escape_string($_POST['description']);
    $amount = $_POST['amount'];
    $category = $conn->real_escape_string($_POST['category']);
    $date = $_POST['date'];

    $conn->query("UPDATE expenses SET description='$description', amount=$amount, category='$category', date='$date' WHERE id=$id AND user_id=$user_id");
    header("Location: http://localhost/Expenses/dashboard.php");
}
?>

<h2>Edit Expense</h2>
<form method="POST">
  <div class="mb-3">
    <label>Description</label>
    <input type="text" name="description" class="form-control" value="<?= $expense['description'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Amount</label>
    <input type="number" name="amount" class="form-control" value="<?= $expense['amount'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Category</label>
    <input type="text" name="category" class="form-control" value="<?= $expense['category'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Date</label>
    <input type="date" name="date" class="form-control" value="<?= $expense['date'] ?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Update Expense</button>
</form>

<?php include 'includes/footer.php'; ?>
