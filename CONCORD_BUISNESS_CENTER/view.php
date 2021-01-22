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

$idquery = "SELECT Cust_ID FROM customer";
$custquery = "SELECT * FROM customer";

$idArray = mysqli_query($link,$idquery);
$custArray = mysqli_query($link,$custquery);

$custArray2 = mysqli_query($link,$custquery);

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
                            echo '<h1>Due Orders This Week :: Sorted by Customers</h1>';
                        } else if ($valueInterval == 2) {
                            echo '<h1>Due Orders This Month :: Sorted by Customers</h1>';
                        } else if ($valueInterval == 3) {
                            echo '<h1>Due Orders FUTURE:: Sorted by Customers</h1>';
                        }
                    } else {
                        echo '<h1>Due Orders TODAY :: Sorted by Customers</h1>';
                    }

                ?>
            </div>

            <ul class="actions">
                <li><a href="viewByDate.php" class="button special">Sort by Date</a></li>

                <li><a href="viewClaimed.php?interval=1" class="button special">View Claimed</a></li>
                <li><a href="viewUnclaimed.php?interval=1" class="button special">View Unclaimed</a></li>

            </ul>

             <?php

                if (isset($_GET['interval'])) {
                    $valueInterval = $_GET['interval'];

                    if ($valueInterval == 1) {
                        echo '<h4><a href="view.php">today</a></h4>';
                        echo '<h4><a href="view.php?interval=2">this month</a></h4>';
                        echo '<h4><a href="view.php?interval=3">future</a></h4>';
                        
                    } else if ($valueInterval == 2) {
                        echo '<h4><a href="view.php">today</a></h4>';
                        echo '<h4><a href="view.php?interval=1">this week</a></h4>';
                        echo '<h4><a href="view.php?interval=3">future</a></h4>';
                    } else if ($valueInterval == 3) {
                        echo '<h4><a href="view.php">today</a></h4>';
                        echo '<h4><a href="view.php?interval=1">this week</a></h4>';
                        echo '<h4><a href="view.php?interval=2">this month</a></h4>';
                    }

                } else {
                    echo '<h4><a href="view.php?interval=1">this week</a></h4>';
                    echo '<h4><a href="view.php?interval=2">this month</a></h4>';
                    echo '<h4><a href="view.php?interval=4">future</a></h4>';
                }

            ?>

            
            
            <div class="wrapper">


                <?php 
                while ($cRow =  mysqli_fetch_array($custArray)) {

                    /*$orderquery = "SELECT * FROM products WHERE products.Cust_ID = '$cRow[0]' AND products.Pickup_Date >= CURDATE() ORDER BY products.Pickup_Date ASC";*/

                    if (isset($_GET['interval'])) {
                        $valueInterval = $_GET['interval'];

                        if ($valueInterval == 1) {
                            $orderquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 8 DAY) AND products.Cust_ID = '$cRow[0]' ORDER BY products.Pickup_Date ASC";
                        } else if ($valueInterval == 2) {
                            $orderquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH) AND products.Cust_ID = '$cRow[0]' ORDER BY products.Pickup_Date ASC";
                        } else if ($valueInterval == 3) {
                            $orderquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date >= CURDATE() AND products.Cust_ID = '$cRow[0]' ORDER BY products.Pickup_Date ASC";
                        }

                    } else {
                        $orderquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Pickup_Date = CURDATE() AND products.Cust_ID = '$cRow[0]' ORDER BY products.Pickup_Date ASC";
                    }

                    $orderArray = mysqli_query($link,$orderquery)  or trigger_error(mysqli_error());;

                    if (mysqli_num_rows($orderArray) == 0) {

                    } else {
                        
                    echo '<h3>'.$cRow[1].' '. $cRow[2].' | '.$cRow[3].' | '.$cRow[4].' | <a href="receipt.php?link='.  $cRow[0] . '">Receipt</a></h3>';
                    /*echo '<h3><a href="receipt.php?link=' . $cRow[0] . '">Link 1</a></h3>';*/
                
                        echo '<div class="table">';

                        echo'<div class="row header">'; 

                        echo'<div class="cell">';
                        echo'ID';
                        echo'</div>';

                        echo'<div class="cell">';
                        echo'Product';
                        echo'</div>';

                        echo'<div class="cell">';
                        echo'Description';
                        echo'</div>';

                        echo'<div class="cell">';
                        echo'Design';
                        echo'</div>';

                        
                        echo'<div class="cell">';
                        echo'Width';
                        echo'</div>';

                        echo '<div class="cell">';
                        echo 'Height';
                        echo '</div>';

                        echo'<div class="cell">';
                        echo'Shape';
                        echo'</div>';

                        echo'<div class="cell">';
                        echo'Size';
                        echo'</div>';

                        echo'<div class="cell">';
                        echo'Color';
                        echo'</div>';

                        echo'<div class="cell">';
                        echo'Type';
                        echo'</div>';
                        
                        echo'<div class="cell">';
                        echo'Quantity';
                        echo'</div>';

                        echo '<div class="cell">';
                        echo 'Pick Up Date';
                        echo '</div>';

                        echo '<div class="cell">';
                        echo 'Status';
                        echo '</div>';


                        echo '</div>'; // end div row header

                        while($oRow = mysqli_fetch_array($orderArray)) {
                            
                            
                            echo'<div class="row">';

                            

                            echo'<div class="cell">';
                            echo $oRow[0];
                            echo'</div>';


                            echo'<div class="cell">';
                            echo $oRow[1];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo  $oRow[2];
                            echo'</div>';

                            
                            echo '<div class="cell">';
                            echo '<a href = "img/'.$oRow[3].'">'.$oRow[3].'</a>';
                            echo '</div>';

                            echo'<div class="cell">';
                            echo  $oRow[6];
                            echo'</div>';

                            echo '<div class="cell">';
                            echo $oRow[7];
                            echo '</div>';

                            echo'<div class="cell">';
                            echo $oRow[8];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo  $oRow[9];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo  $oRow[10];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo  $oRow[11];
                            echo'</div>';


                            echo '<div class="cell">';
                            echo $oRow[12];
                            echo '</div>';

                            echo '<div class="cell">';
                            echo $oRow[5];
                            echo '</div>';

                            echo '<div class="cell">';

                            if($oRow[14] == 1) {
                                echo 'Claimed';
                            } else {
                                echo 'Unclaimed';
                            }
                            echo '</div>';


                            echo '</div>'; // end div class row

                        }

                        echo '</div>'; // end div table
                        //echo '<hr>';
                    }

                 }

                ?>
            

            </div> <!-- end div wrapper -->

            <ul class="actions">
                <li><a href="customer.php" class="button special">Add</a></li>
                <li><a href="update.php" class="button special">Update</a></li>
                <li><a href="delete.php" class="button special">Delete</a></li>

            </ul>

        </form>

    </div>

</body>

</html>
