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
	if (isset($_GET['interval'])) {

		$valueInterval = $_GET['interval'];

		if ($valueInterval == 1) { // this week

			$salesquery = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE()";
			$salesquerybagtag = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Bag Tag' ";
			$salesquerykeychain = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Keychain' ";
			$salesquerytarpaulin = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Tarpaulin' ";
			$salesqueryshirt = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Shirt' ";
			$salesquerytumbler = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Tumbler' ";
		
		} else if ($valueInterval == 2) { // this month

			$salesquery = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()";
			$salesquerybagtag = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() AND products.Prod_Name LIKE 'Bag Tag' ";
			$salesquerykeychain = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() AND products.Prod_Name LIKE 'Keychain' ";
			$salesquerytarpaulin = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() AND products.Prod_Name LIKE 'Tarpaulin' ";
			$salesqueryshirt = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() AND products.Prod_Name LIKE 'Shirt' ";
			$salesquerytumbler = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() AND products.Prod_Name LIKE 'Tumbler' ";

		} else if ($valueInterval == 3) { // this year
			$salesquery = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE()";
			$salesquerybagtag = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() AND products.Prod_Name LIKE 'Bag Tag' ";
			$salesquerykeychain = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() AND products.Prod_Name LIKE 'Keychain' ";
			$salesquerytarpaulin = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() AND products.Prod_Name LIKE 'Tarpaulin' ";
			$salesqueryshirt = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() AND products.Prod_Name LIKE 'Shirt' ";
			$salesquerytumbler = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() AND products.Prod_Name LIKE 'Tumbler' ";

		}
	} else {
		$salesquery = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE()";
		$salesquerybagtag = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Bag Tag' ";
		$salesquerykeychain = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Keychain' ";
		$salesquerytarpaulin = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Tarpaulin' ";
		$salesqueryshirt = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Shirt' ";
		$salesquerytumbler = "SELECT Total_Price FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() AND products.Prod_Name LIKE 'Tumbler' ";
		

	} // end if

	$overallsales = mysqli_query($link,$salesquery);
	$salesbagtag = mysqli_query($link,$salesquerybagtag);
	$saleskeychain = mysqli_query($link,$salesquerykeychain);
	$salestarpaulin = mysqli_query($link,$salesquerytarpaulin);
	$salesshirt = mysqli_query($link,$salesqueryshirt);
	$salestumbler = mysqli_query($link,$salesquerytumbler);

	$sumsales = 0;

	while($row1 = mysqli_fetch_array($overallsales)) {
	    $sumsales = $sumsales + $row1[0];

	}

	$sumbagtag = 0;

	while($row2 = mysqli_fetch_array($salesbagtag)) {
	    $sumbagtag = $sumbagtag + $row2[0];

	}

	$sumkeychain = 0;

	while($row3 = mysqli_fetch_array($saleskeychain)) {
	    $sumkeychain = $sumkeychain + $row3[0];

	}

	$sumtarpaulin = 0;

	while($row4 = mysqli_fetch_array($salestarpaulin)) {
	    $sumtarpaulin = $sumtarpaulin + $row4[0];

	}

	$sumshirt = 0;

	while($row5 = mysqli_fetch_array($salesshirt)) {
	    $sumshirt = $sumshirt + $row5[0];

	}

	$sumtumbler = 0;

	while($row6 = mysqli_fetch_array($salestumbler)) {
	    $sumtumbler = $sumtumbler + $row6[0];

	}

?>

<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>View</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">
    <link rel="stylesheet" href="assets/style.css">

</head>


	<header>
		<h1>CBC Prints </h1>
        <!-- <a href="view.php">View Orders</a> -->
        <a href="main.php">Home</a>
        
    </header>

    <!-- <ul>
        <li><a href="index.html">Something</a></li>
        <li><a href="form-register.html">Something</a></li>
        <li><a href="form-login.html" class="active">Something</a></li>
    </ul> -->


    <div class="main-content">

        <!-- You only need this form and the form-login.css -->

        <form class="form-basic" method="post" action="customer.php">


            <div class="form-title-row">
                <?php

                    if (isset($_GET['interval'])) {
                        $valueInterval = $_GET['interval'];

                        if ($valueInterval == 1) {
                            echo '<h1>Sales Past Week</h1>';
                        } else if ($valueInterval == 2) {
                            echo '<h1>Sales Past Month</h1>';
                        } else if ($valueInterval == 3) {
                            echo '<h1>Sales Past Year</h1>';
                        }
                    } else {
                        echo '<h1>Sales Past Week</h1>';
                    }

                ?>
            </div>

	      	<?php

                if (isset($_GET['interval'])) {
                    $valueInterval = $_GET['interval'];

                    if ($valueInterval == 1) {
                        echo '<h4><a href="sales.php?interval=2">past month</a></h4>';
                        echo '<h4><a href="sales.php?interval=3">past year</a></h4>';
                        
                    } else if ($valueInterval == 2) {
                        echo '<h4><a href="sales.php?interval=1">past week</a></h4>';
                        echo '<h4><a href="sales.php?interval=3">past year</a></h4>';
                    } else if ($valueInterval == 3) {
                        echo '<h4><a href="sales.php?interval=1">past week</a></h4>';
                        echo '<h4><a href="sales.php?interval=2">past month</a></h4>';
                    }

                } else {
                    echo '<h4><a href="sales.php?interval=2">past month</a></h4>';
                    echo '<h4><a href="sales.php?interval=3">past year</a></h4>';
                }

           		// echo '<div class="form-row">';
                //echo '<label>';
                echo '<h6><strong>Overall Sales: </strong>'. $sumsales .'</h6>';
                
                //echo '</label>';
                // echo '</div>';
            ?>

            <h6><strong>BREAKDOWN</strong></h6>

            <div class="wrapper">


                
                <div class="table">

                    <div class="row header"> 

	                    <div class="cell">
	                    Product
	                    </div>

	                    <div class="cell">
	                    Sales
	                    </div>

	                </div> <!-- end row header -->

	                <div class="row">

	                	<div class="cell">
	                    Bag Tag
	                    </div>

	                	<div class="cell">
	                    <?php echo $sumbagtag ?>
	                    </div>

	                </div> <!-- end row -->

	                <div class="row">

	                	<div class="cell">
	                    Key Chain
	                    </div>

	                	<div class="cell">
	                    <?php echo $sumkeychain ?>
	                    </div>

	                </div> <!-- end row -->

	                <div class="row">

	                	<div class="cell">
	                    Tarpaulin
	                    </div>

	                	<div class="cell">
	                    <?php echo $sumtarpaulin ?>
	                    </div>

	                </div> <!-- end row -->

	                <div class="row">

	                	<div class="cell">
	                    Shirt
	                    </div>

	                	<div class="cell">
	                    <?php echo $sumshirt ?>
	                    </div>

	                </div> <!-- end row -->

	                <div class="row">

	                	<div class="cell">
	                    Tumbler
	                    </div>

	                	<div class="cell">
	                    <?php echo $sumtumbler ?>
	                    </div>

	                </div> <!-- end row -->

	            </div> <!-- end div table -->

	        </div>

        </form>

    </div>

</body>

</html>

