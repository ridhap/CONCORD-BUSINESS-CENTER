<?php
session_start();

// Determine the current Customer ID
$lastCustIDpassed = $_SESSION['lastCustID'];

/*echo "I'd like {$lastCustIDpassed} waffles";*/

?>

<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Basic Form</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">

</head>

 
	<header>
		<h1>CBC Prints  | Order Form</h1>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>


    <div class="main-content">

        <!-- the 'action' word in the form tag indicates where it will redirect, when the 'Continue button is pressed' -->
            <!-- TO BE CHANGED -->
            <!-- CHANGE THE DESTINATION INDICATED BY ACTION -->
        <form class="form-basic" method="post" action="bagtag_php.php"  enctype="multipart/form-data">

            <div class="form-title-row">
                <h1>Add Order :: Product Information</h1>
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
                        <option value = "Rubber">Rubber</option>
                        <option value = "Clear Plastic">Clear Plastic</option>
                        <option value = "Glass">Glass</option>
                    </select>

                    <!--If it's not a dropdown choice, you can replace <select> </select> with
                        <input type="text" name="Type"> IF IT IS A TEXT/WORD
                        <input type="number" name="Type"> IF IT IS A NUMBER
                    -->


                </label>
            </div>
            <!-- END TO BE CHANGED -->

            <div class="form-row">

                <label>
                    <!-- Please take note of the <input name = "Something">, it represents the NAME of the variable of the database table. -->
                    <!-- The input name will be passed to the next page, so don't worry -->
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