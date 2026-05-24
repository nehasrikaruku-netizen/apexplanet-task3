<?php

include("01_db.php");

session_start();

if(!isset($_SESSION['username']))
{
    header("Location: /expense_tracker/task3/03_login.php");
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "SELECT * FROM expenses WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['update']))
{
    $id = $_POST['id'];

    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $payment = $_POST['payment'];
    $expense_date = $_POST['expense_date'];
    $description = $_POST['description'];

    $update = "UPDATE expenses SET

    title='$title',
    amount='$amount',
    category='$category',
    payment_method='$payment',
    expense_date='$expense_date',
    description='$description'

    WHERE id='$id'";

    if(mysqli_query($conn, $update))
    {
        echo "<script>
        alert('Expense Updated Successfully');
        window.location.href='/expense_tracker/task3/05_view_expense.php';
        </script>";
    }
    else
    {
        echo "<script>alert('Update Failed');</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Expense - SpendWise</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(rgba(15,23,42,0.85),
    rgba(16,185,129,0.6)),

    url('https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1470&auto=format&fit=crop');

    background-size:cover;
    background-position:center;

    padding:40px;
}

.container{

    width:450px;

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border-radius:20px;

    padding:35px;

    box-shadow:0 8px 32px rgba(0,0,0,0.2);

    border:1px solid rgba(255,255,255,0.2);
}

h2{

    text-align:center;
    color:white;

    margin-bottom:10px;

    font-size:30px;
}

p{

    text-align:center;
    color:#e5e7eb;

    margin-bottom:25px;
}

input,
select,
textarea{

    width:100%;

    padding:14px;

    margin-bottom:18px;

    border:none;

    border-radius:12px;

    background:rgba(255,255,255,0.2);

    color:white;

    font-size:15px;
}

input::placeholder,
textarea::placeholder{

    color:#f3f4f6;
}

select option{

    color:black;
}

input:focus,
textarea:focus,
select:focus{

    outline:none;

    background:rgba(255,255,255,0.3);
}

textarea{

    height:100px;

    resize:none;
}

button{

    width:100%;

    padding:14px;

    background:#3b82f6;

    border:none;

    border-radius:12px;

    color:white;

    font-size:16px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

button:hover{

    background:#2563eb;

    transform:translateY(-2px);
}

.back-link{

    text-align:center;

    margin-top:20px;
}

.back-link a{

    color:white;

    text-decoration:none;

    font-weight:bold;
}

.back-link a:hover{

    text-decoration:underline;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    margin-top:20px;
}

th{
    background:#10b981;
    color:white;
    padding:15px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f3f4f6;
}

</style>

</head>

<body>

<div class="container">

<h2>Edit Expense</h2>

<p>Update your expense details</p>

<form method="POST">

<input type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

<input type="text"
name="title"
value="<?php echo $row['title']; ?>"
required>

<input type="number"
name="amount"
value="<?php echo $row['amount']; ?>"
required>

<select name="category" required>

<option><?php echo $row['category']; ?></option>

<option>Food</option>
<option>Travel</option>
<option>Shopping</option>
<option>Bills</option>
<option>Education</option>
<option>Entertainment</option>

</select>

<select name="payment" required>

<option><?php echo $row['payment_method']; ?></option>

<option>Cash</option>
<option>UPI</option>
<option>Card</option>

</select>

<input type="date"
name="expense_date"
value="<?php echo $row['expense_date']; ?>"
required>

<textarea name="description"><?php echo $row['description']; ?></textarea>

<button type="submit" name="update">
Update Expense
</button>

</form>

<div class="back-link">

<a href="/expense_tracker/task3/05_view_expense.php">
Back to Expenses
</a>

</div>

</div>

</body>

</html>