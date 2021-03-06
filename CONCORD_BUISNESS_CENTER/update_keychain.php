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
        <form class="form-basic" method="post" action="uKeychain_php.php" enctype="multipart/form-data">
        <!-- end to be changed -->

            <div class="form-title-row">
                <h1>Update Order :: Product Information</h1>
                <h2>Please check the Product ID, through the <a href="view.php">Orders Page</a></h2>
            </div>

            <div class="form-row">
                <label>
                    <span>Product ID</span>
                    <input required type="number" name="PID">
                </label>
            </div>

            <!-- TO BE CHANGED -->
            <!-- each div class = "form-row", represents well, each row of the form. -->
            <div class="form-row">
                <label>
                    <span>Type</span>

                    <!-- select tag is used for drop down choices. -->
                    <!-- Take note of the select name. It represents the NAME of the variable of the database table.-->
                    <select name="Type">
                        <!-- The option value represents the value that will be stored in the variable, specified in select name-->
                        <option value ="">Type</option>
                        <option value = "Rubber">Rubber</option>
                        <option value = "Clear Plastic">Clear Plastic</option>
                        <option value = "Glass">Glass</option>
                    </select>
                    
                </label>
            </div>
            <!-- END TO BE CHANGED -->

            <!-- added a unique property which is shape. didn't make it into a drop down option because I think too many for options :) -->

            <div class="form-row">
                <label>
                    <span>Shape</span>
                    <input type="text" name="Shape">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Description</span>
                    <input type="text-area" name="Prod_Desc">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Design File</span>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Design File Name</span>
                    <input type="text" name="Prod_Design">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Price</span>
                    <input type="number" name="Design_Price">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Quantity</span>
                    <input type="number" name="Quantity">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Pick Up Date</span>
                    <input type="date" name="Pickup_Date">
                </label>
            </div>


            <div class="form-row">
                <button type="submit">Continue</button>
            </div>

        </form>

    </div>

</body>

</html>