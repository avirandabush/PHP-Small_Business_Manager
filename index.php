<?php include './config/Database.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBM - Home Page</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <header>
        <div id="date">19.06.2022</div>
        <h1>Business Nmae</h1>
        <img src="" alt="logo">
    </header>
    <main>
        <div id="serach">Search</div>
        <div id="actions">
            <a href="./actions/Revenue.php"><div id="revenue">Revenue</div></a>
            <a href="./actions/Transactions.php"><div id="transactions">Transactions</div></a>
            <a href="./actions/Balances.php"><div id="balances">Balances</div></a>
        </div>
        <div id="add">
            <a href="./actions/AddCustomer.php"><div id="newCustomer">New Customer</div></a>
            <a href="./actions/AddItem.php"><div id="newItem">New Item</div></a>
        </div>
    </main>
    <footer>
        Created by Aviran Dabush 2022
    </footer>
    
</body>
</html>
<a></a>
