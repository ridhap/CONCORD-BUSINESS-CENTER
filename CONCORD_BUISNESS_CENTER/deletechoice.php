<?php


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Update</title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">

</head>

 
    <header>
        <h1>CBC Prints  | Delete Order</h1>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>


    <div class="main-content">

        <form class="form-basic" method="post" action="delete_php.php">

            <div class="form-title-row">
                <h1>Delete Order</h1>
                <h2>Please check the Product ID, through the <a href="view.php">Orders Page</a></h2>
            </div>

            <div class="form-row">
                <label>
                    <span>Product ID</span>
                    <input required type="number" name="PID">
                </label>
            </div>


            <div class="form-row">
                <button type="submit">Continue</button>
            </div>

        </form>

    </div>

</body>

</html>