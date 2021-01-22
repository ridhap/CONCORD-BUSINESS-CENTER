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

    if ($valueInterval == 4) { // future
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date >= CURDATE() ORDER BY products.Pickup_Date ASC";
    } else if ($valueInterval == 1) {
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date = CURDATE() ORDER BY products.Pickup_Date ASC";
    } else if ($valueInterval == 2) {
        //$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY products.Pickup_Date ASC";
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() ORDER BY products.Pickup_Date ASC";
    } else if ($valueInterval == 3) {
        //$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date > DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY products.Pickup_Date ASC";
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() ORDER BY products.Pickup_Date ASC";

    }

} else {
    $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 ORDER BY products.Pickup_Date ASC";

}
//$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 ORDER BY products.Pickup_Date ASC";


$productArray = mysqli_query($link,$productquery);

/*while ($cRow =  mysqli_fetch_array($custArray2)) {
    echo $cRow[0];
    echo " ";
    echo $cRow[1];
    echo " ";
    echo $cRow[2];
    echo " ";
    echo $cRow[3];
    echo " ";
    echo $cRow[4];
    echo " ";
    echo " ";
}*/

?>




<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>View</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-tables.css">
    <link rel="stylesheet" href="assets/style.css">

</head>


	<header>
		<h1>CBC Prints </h1>
        <!-- <a href="view.php">View Orders</a> -->
        <a href="searchcust.php">Search</a>
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
                            echo '<h1>Orders :: Unclaimed Today</h1>'; 
                        } else if ($valueInterval == 2) {
                            echo '<h1>Orders :: Unclaimed Past Week</h1>'; 
                        } else if ($valueInterval == 3) {
                            echo '<h1>Orders :: Unclaimed Past Month</h1>'; 
                        } else if ($valueInterval == 4) {
                            echo '<h1>Orders :: Unclaimed Future</h1>';
                        }
                    } else {
                        echo '<h1>Orders :: Unclaimed All Time</h1>';
                    }

                ?>
            </div>

            <ul class="actions">
                <li><a href="view.php" class="button special">Sort by Customer</a></li>
                <li><a href="viewByDate.php" class="button special">Sort by Date</a></li>
                <li><a href="viewClaimed.php?interval=1" class="button special">View Claimed</a></li>

            </ul>

            <?php

                if (isset($_GET['interval'])) {
                    $valueInterval = $_GET['interval'];

                    if ($valueInterval == 1) {
                        echo '<h4><a href="viewUnclaimed.php?interval=2">past week</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=3">past month</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=4">future</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php">all time</a></h4>';
                    } else if ($valueInterval == 2) {
                        echo '<h4><a href="viewUnclaimed.php?interval=1">today</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=3">past month</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=4">future</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php">all time</a></h4>';
                    } else if ($valueInterval == 3) {
                        echo '<h4><a href="viewUnclaimed.php?interval=1">today</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=2">past week</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=4">future</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php">all time</a></h4>';
                    } else if ($valueInterval == 4) {
                        echo '<h4><a href="viewUnclaimed.php?interval=1">today</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=2">past week</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php?interval=3">past month</a></h4>';
                        echo '<h4><a href="viewUnclaimed.php">all time</a></h4>';
                    }

                } else {
                    echo '<h4><a href="viewUnclaimed.php?interval=1">all time</a></h4>';
                    echo '<h4><a href="viewUnclaimed.php?interval=2">today</a></h4>';
                    echo '<h4><a href="viewUnclaimed.php?interval=3">past week</a></h4>';
                    echo '<h4><a href="viewUnclaimed.php?interval=4">future</a></h4>';
                }       
            ?>
            

            <!--
            <h4><a href="view.php">this day</a></h4>
            <h4><a href="view.php">this week</a></h4>
            <h4><a href="view.php">this month</a></h4>
        -->
<?php
        if (mysqli_num_rows($productArray) == 0) {
                echo '<h6 text-align:center> Oops! No orders available </h6>';
            } else {
            ?>
            
            <div class="wrapper">


                
                <div class="table">

                    <div class="row header"> 

                    <div class="cell">
                    ID
                    </div>

                    <div class="cell">
                    Name
                    </div>

                    <div class="cell">
                    Product
                    </div>

                    <div class="cell">
                    Description
                    </div>


                    <div class="cell">
                    Design
                    </div>

                    <div class="cell">
                    Width
                    </div>

                    <div class="cell">
                    Height
                    </div>

                    <div class="cell">
                    Shape
                    </div>

                    <div class="cell">
                    Size
                    </div>

                    <div class="cell">
                    Color
                    </div>

                    <div class="cell">
                    Type
                    </div>

                    <div class="cell">
                    Quantity
                    </div>

                    <div class="cell">
                    Pick Up Date
                    </div>

                    <div class="cell">
                    Status
                    </div>

                    </div> <!-- end div row header -->

               

                <?php 
                    while ($pRow =  mysqli_fetch_array($productArray)) {
            
                        echo'<div class="row">';

                            echo'<div class="cell">';
                            echo $pRow[0];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo $pRow[16].' '.$pRow[17];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo $pRow[1];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo $pRow[2];
                            echo'</div>';

                            echo '<div class="cell">';
                            echo '<a href = "img/'.$pRow[3].'">'.$pRow[3].'</a>';
                            echo '</div>';

                            echo'<div class="cell">';
                            echo $pRow[6];
                            echo'</div>';


                            echo'<div class="cell">';
                            echo $pRow[7];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo  $pRow[8];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo $pRow[9];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo $pRow[10];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo $pRow[11];
                            echo'</div>';

                            echo '<div class="cell">';
                            echo $pRow[12];
                            echo '</div>';

                            echo '<div class="cell">';
                            echo $pRow[5];
                            echo '</div>';

                            echo '<div class="cell">';

                            if($pRow[14] == 1) {
                                echo 'Claimed';
                            } else {
                                echo 'Unclaimed';
                            }
                            echo '</div>';


                        echo '</div>'; // end div class row
                        

                    }

                ?>

                </div> <!-- end div table -->
            

            </div> <!-- end div wrapper -->

            <?php }?>

            <ul class="actions">
                <li><a href="customer.php" class="button special">Add</a></li>
                <li><a href="update.php" class="button special">Update</a></li>
                <li><a href="delete.php" class="button special">Delete</a></li>

            </ul>

        </form>

    </div>

</body>

</html>
