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
if (isset($_POST['bool'])){
    $valuePID = $_POST['bool'];
    //echo 'YAY1';
    //echo "I'd like {$valuePID} waffles";
}

//$valueID = 13;
//

if (!empty($_POST['Claimed'])){

    //echo 'YAY2';
        
    $valueClaimed = $_POST['Claimed'];
    
    if (!mysqli_query($link,"UPDATE products SET Claimed = '$valueClaimed' WHERE Prod_ID = '$valuePID' ")) {
    die('Error: ' . mysqli_error($link));
    }

    //echo "I'd like {$valueClaimed} waffles";
}


$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 ORDER BY products.Pickup_Date ASC";

if (isset($_GET['interval'])) {
    $valueInterval = $_GET['interval'];

    if ($valueInterval == 4) {
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 ORDER BY products.Pickup_Date ASC";
    } else if ($valueInterval == 1) {
        //$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY products.Pickup_Date ASC";
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() ORDER BY products.Pickup_Date ASC";
    } else if ($valueInterval == 2) {
        //$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date > DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY products.Pickup_Date ASC";
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() ORDER BY products.Pickup_Date ASC";

    } else if ($valueInterval == 3) {
        $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date = CURDATE() ORDER BY products.Pickup_Date ASC";
    }


} else {
    $productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 AND products.Pickup_Date >= CURDATE() ORDER BY products.Pickup_Date ASC";
}

$productArray = mysqli_query($link,$productquery);

/*while ($cRow =  mysql_fetch_array($custArray2)) {
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

        <form class="form-basic" method="post" action="update_status.php">


            <div class="form-title-row">
                <?php

                    if (isset($_GET['interval'])) {
                        $valueInterval = $_GET['interval'];

                        if ($valueInterval == 1) {
                            echo '<h1>Orders :: Unclaimed Past Week</h1>';
                        } else if ($valueInterval == 2) {
                            echo '<h1>Orders :: Unclaimed Past Month</h1>';
                        } else if ($valueInterval == 3) {
                            echo '<h1>Orders :: Unclaimed Today</h1>';
                        } else if ($valueInterval == 4) {
                            echo '<h1>Orders :: Unclaimed All Time</h1>';
                        }
                    } else {
                        echo '<h1>Orders :: Unclaimed Future</h1>';
                    }

                ?>
            </div>

            <?php

                if (isset($_GET['interval'])) {
                    $valueInterval = $_GET['interval'];

                    if ($valueInterval == 1) {
                        echo '<h4><a href="update_status.php?interval=3">today</a></h4>';
                        echo '<h4><a href="update_status.php?interval=2">past month</a></h4>';
                        echo '<h4><a href="update_status.php">future</a></h4>';
                        echo '<h4><a href="update_status.php?interval=4">all time</a></h4>';
                    } else if ($valueInterval == 2) {
                        echo '<h4><a href="update_status.php?interval=3">today</a></h4>';
                        echo '<h4><a href="update_status.php?interval=1">past week</a></h4>';
                        echo '<h4><a href="update_status.php">future</a></h4>';
                        echo '<h4><a href="update_status.php?interval=4">all time</a></h4>';
                    } else if ($valueInterval == 3) {
                        // echo '<h4><a href="update_status.php">today</a></h4>';
                        echo '<h4><a href="update_status.php?interval=1">past week</a></h4>';
                        echo '<h4><a href="update_status.php?interval=2">past month</a></h4>';
                        echo '<h4><a href="update_status.php?interval=4">all time</a></h4>';
                        echo '<h4><a href="update_status.php">future</a></h4>';
                    } else if ($valueInterval == 4) {
                        echo '<h4><a href="update_status.php?interval=3">today</a></h4>';
                        echo '<h4><a href="update_status.php?interval=1">past week</a></h4>';
                        echo '<h4><a href="update_status.php?interval=2">past month</a></h4>';
                        echo '<h4><a href="update_status.php">future</a></h4>';
                    }

                } else {
                    echo '<h4><a href="update_status.php?interval=3">today</a></h4>';
                    echo '<h4><a href="update_status.php?interval=1">past week</a></h4>';
                    echo '<h4><a href="update_status.php?interval=2">past month</a></h4>';
                    // echo '<h4><a href="update_status.php">future</a></h4>';
                    echo '<h4><a href="update_status.php?interval=4">all time</a></h4>';
                    // echo '<h4><a href="update_status.php?interval=3">today</a></h4>';
                }       
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
                    Quantity
                    </div>

                    <div class="cell">
                    Pick Up Date
                    </div>

                    <div class="cell">
                    Status
                    </div>

                    <div class="cell">
                    Update
                    </div>

                    <div class="cell">
                     
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

                            echo '<div class="cell">';
                            
                            echo '<input type="radio" name="Claimed" value="1" />';
                            echo 'Claimed: ';
                            echo '</div>';

                            echo '<div class="cell">';
                            echo '<button type="submit" name="bool" value="' .$pRow[0]. '"> Continue </button>';
                            echo '</div>';


                            //<input type="radio" name="q1" value="1" />


                        echo '</div>'; // end div class row
                        

                    }

                ?>

                </div> <!-- end div table -->
            

            </div> <!-- end div wrapper -->

            <ul class="actions">
                <li><a href="customer.php" class="button special">Add</a></li>
                <li><a href="update.php" class="button special">Update</a></li>
                <li><a href="delete.php" class="button special">Delete</a></li>
                



            </ul>

            <!-- <div class="form-row">
                <button type="submit">Continue</button>
            </div> -->

        </form>

    </div>

</body>

</html>
