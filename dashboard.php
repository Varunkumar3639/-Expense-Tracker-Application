
<?php
require 'includes/db_connect.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Expenses/index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$expenses = $conn->query("SELECT * FROM expenses WHERE user_id=$user_id ORDER BY date DESC");
?>

<h2>Your Expenses</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Description</th>
      <th>Amount</th>
      <th>Category</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $expenses->fetch_assoc()): ?>
    <tr>
      <td><?= $row['description'] ?></td>
      <td>₹<?= $row['amount'] ?></td>
      <td><?= $row['category'] ?></td>
      <td><?= $row['date'] ?></td>
      <td>
        <a href="edit_expense.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="delete_expense.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include 'includes/footer.php'; ?>
