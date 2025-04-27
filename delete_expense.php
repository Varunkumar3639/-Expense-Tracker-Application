
<?php

require 'includes/db_connect.php';
session_start(); //start

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Expenses/index.php');
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM expenses WHERE id=$id AND user_id=$user_id");

header("Location: http://localhost/Expenses/dashboard.php");
?>
