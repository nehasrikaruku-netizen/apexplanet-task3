<?php

include("01_db.php");

session_start();

if(!isset($_SESSION['username']))
{
    header("Location: /expense_tracker/task3/03_login.php");
    exit();
}

$username = $_SESSION['username'];

$totalQuery = "SELECT SUM(amount) AS total FROM expenses";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);

$totalExpense = $totalRow['total'];

$countQuery = "SELECT COUNT(*) AS totalExpenses FROM expenses";
$countResult = mysqli_query($conn, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);

$totalCount = $countRow['totalExpenses'];
$search = "";

if(isset($_GET['search']))
{
    $search = $_GET['search'];
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard - SpendWise</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{

    min-height:100vh;

    background:
    linear-gradient(rgba(15,23,42,0.88),
    rgba(16,185,129,0.55)),

    url('https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1470&auto=format&fit=crop');

    background-size:cover;
    background-position:center;

    padding:40px;
}

.container{

    width:95%;
    max-width:1200px;

    margin:auto;
}

.header{

    text-align:center;

    margin-bottom:40px;
}

.header h1{

    color:white;

    font-size:42px;

    margin-bottom:10px;
}

.header p{

    color:#d1fae5;

    font-size:18px;
}

.cards{

    display:grid;

    grid-template-columns:repeat(auto-fit, minmax(250px,1fr));

    gap:25px;

    margin-bottom:40px;
}

.card{

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border-radius:20px;

    padding:30px;

    text-align:center;

    box-shadow:0 8px 32px rgba(0,0,0,0.2);

    border:1px solid rgba(255,255,255,0.2);

    transition:0.3s;
}

.card:hover{

    transform:translateY(-5px);
}

.card h2{

    color:white;

    margin-bottom:15px;

    font-size:24px;
}

.card p{

    color:#d1fae5;

    font-size:28px;

    font-weight:bold;
}

.links{

    display:grid;

    grid-template-columns:repeat(auto-fit, minmax(220px,1fr));

    gap:20px;
}

.links a{

    background:#10b981;

    color:white;

    text-decoration:none;

    padding:18px;

    border-radius:15px;

    text-align:center;

    font-size:18px;

    font-weight:bold;

    transition:0.3s;

    box-shadow:0 4px 15px rgba(0,0,0,0.2);
}

.links a:hover{

    background:#059669;

    transform:translateY(-3px);
}

.footer{

    text-align:center;

    margin-top:50px;

    color:white;

    font-size:15px;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h1>SpendWise Dashboard</h1>

<p>Welcome, <?php echo $username; ?> 👋</p>

</div>

<div class="cards">

<div class="card">

<h2>Total Expenses</h2>

<p><?php echo $totalCount; ?></p>

</div>

<div class="card">

<h2>Total Spending</h2>

<p>₹ <?php echo $totalExpense ? $totalExpense : 0; ?></p>

</div>

</div>

<div class="links">

<form method="GET" style="margin-bottom:20px; text-align:center;">

<input type="text" 
name="search" 
placeholder="Search expense"
style="padding:10px; width:250px; border-radius:8px; border:none;">

<button type="submit"
style="padding:10px 15px; border:none; border-radius:8px; background:#10b981; color:white;">

Search

</button>

</form>

<div class="links">

<a href="/expense_tracker/task3/04_add_expense.php">
Add Expense
</a>

<a href="/expense_tracker/task3/05_view_expense.php">
View Expenses
</a>

<a href="/expense_tracker/task3/08_logout.php">
Logout
</a>


</div>

<div class="footer">

<p>Smart Expense Tracker • SpendWise</p>

</div>

</div>

</body>

</html>