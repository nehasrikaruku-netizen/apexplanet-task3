<?php

include("01_db.php");

session_start();

if(!isset($_SESSION['username']))
{
    header("Location: /expense_tracker/task3/03_login.php");
    exit();
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM expenses WHERE id='$id'";

    if(mysqli_query($conn, $deleteQuery))
    {
        echo "<script>
        alert('Expense Deleted Successfully');
        window.location.href='/expense_tracker/task3/05_view_expense.php';
        </script>";
    }
    else
    {
        echo "<script>alert('Delete Failed');</script>";
    }
}
else
{
    echo "Expense ID Missing";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Delete Expense</title>

<style>

body{

    font-family:Arial, sans-serif;

    background:#0f172a;

    color:white;

    display:flex;

    justify-content:center;

    align-items:center;

    height:100vh;
}

.container{

    text-align:center;

    background:#1e293b;

    padding:40px;

    border-radius:15px;

    box-shadow:0 4px 20px rgba(0,0,0,0.3);
}

a{

    color:#10b981;

    text-decoration:none;

    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>Deleting Expense...</h2>

<p>Please wait...</p>

<a href="/expense_tracker/task3/05_view_expense.php">
Back to Expenses
</a>

</div>

</body>

</html>