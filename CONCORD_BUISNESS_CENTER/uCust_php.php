<?php
session_start();

define ('DB_NAME', 'supervisionv1');
define ('DB_USER', 'root');
define ('DB_PASSWORD', '');
define ('DB_HOST', 'localhost');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
    error_log("Failed to connect to MySQL: " . mysqli_error($link));
    die('Internal server error');
    // die('Could not connect: ' . mysqli_error());
}

$db_selected = mysqli_select_db($link,DB_NAME);

if (!$db_selected) {
     error_log("Database selection failed: " . mysqli_error($link));
    die('Internal server error');
    // die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
}


//retrieve the product ID, store it in the variable, do not change
$valueCID = $_POST['CID'];


// TO BE CHANGED
// PLEASE change this to the unique properties per product

// If the type area is not empty, then update the tables.
    // Meaning naa siyay ganahan ichange sa type
if (!empty($_POST['Cust_FName'])) {

    // retrieve the product type and store it in a variable
    $valueF = $_POST['Cust_FName'];
    
    // make a query. specify the $variables that we just made above.
    // please just change the SET statement
    if (!mysqli_query($link,"UPDATE customer SET Cust_FName = '$valueF' WHERE Cust_ID = '$valueCID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}

if (!empty($_POST['Cust_LName'])) {

    // retrieve the product type and store it in a variable
    $valueL = $_POST['Cust_LName'];
    
    // make a query. specify the $variables that we just made above.
    // please just change the SET statement
    if (!mysqli_query($link,"UPDATE customer SET Cust_LName = '$valueL' WHERE Cust_ID = '$valueCID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}


if (!empty($_POST['Cust_Num'])) {

    // retrieve the product type and store it in a variable
    $valueNum = $_POST['Cust_Num'];
    
    // make a query. specify the $variables that we just made above.
    // please just change the SET statement
    if (!mysqli_query($link,"UPDATE customer SET Cust_Num = '$valueNum' WHERE Cust_ID = '$valueCID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}

if (!empty($_POST['Cust_Email'])) {

    // retrieve the product type and store it in a variable
    $valueEmail = $_POST['Cust_Email'];
    
    // make a query. specify the $variables that we just made above.
    // please just change the SET statement
    if (!mysqli_query($link,"UPDATE customer SET Cust_Email = '$valueEmail' WHERE Cust_ID = '$valueCID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}






// execute the query

// close the connection, very important yo
mysqli_close($link);
?>

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

        <!-- You only need this form and the form-basic.css -->

        <!-- <form class="form-basic" method="post" action="order_info.php"> -->
        <form class="form-basic" method="post" >
            <div class="form-title-row">
                <h1>Confirmation</h1>
            </div>

            <div class="success">
                Customer successfully updated.
            </div>


            <!-- <div class="form-row">
                <button type="submit" formaction="login.php">Finish</button>
            </div>

            <div class="form-row">
                <button type="submit" formaction="main.php">Continue</button>
            </div> -->

            <ul class="actions">
                    <li><a href="main.php" class="button special">Finish</a></li>

                    <li><a href="customer.php" class="button special">Add</a></li>
                    <li><a href="update.php" class="button special">Update</a></li>
            </ul>

        </form>

    </div>

</body>

</html>