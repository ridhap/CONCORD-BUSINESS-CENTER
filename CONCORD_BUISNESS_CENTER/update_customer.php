<?php
session_start();

/*echo "I'd like {$lastCustIDpassed} waffles";*/

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
		<h1>CBC Prints  | Update Order</h1>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>


    <div class="main-content">

        <!-- to be changed, please change the action url, to uTumbler.php for example, thanks so much -->
        <form class="form-basic" method="post" action="uCust_php.php" enctype="multipart/form-data">
        <!-- end to be changed -->

            <div class="form-title-row">
                <h1>Update Customer :: Customer Information</h1>
                <!-- <h2>Please check the Product ID, through the <a href="view.php">Orders Page</a></h2> -->
            </div>

            <div class="form-row">
                <label>
                    <span>Customer ID</span>
                    <?php

                    if (isset($_GET['CID'])) {

                        echo '<input required type="number" name="CID" value="'. $_GET['CID'] . '">';
                    } else {
                        echo '<input required type="number" name="CID">';
                    }

                    ?>
                    <!-- <input required type="number" name="PID" value=" if(isset($_GET['CID'])){ echo $CID;}"> -->
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>First Name</span>
                    <input type="text" name="Cust_FName">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Last Name</span>
                    <input type="text" name="Cust_LName">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Phone Number</span>
                    <input type="number" name="Cust_Num">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Email Address</span>
                    <input type="email" name="Cust_Email">
                </label>
            </div>


            <div class="form-row">
                <button type="submit">Continue</button>
            </div>

        </form>

    </div>

</body>

</html>