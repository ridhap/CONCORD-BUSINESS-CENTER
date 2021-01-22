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
if (isset($_GET['link'])){
    echo 'YAY2';
}


$valuePID = 13;

if (isset($_POST['Claimed'])){
        echo 'YAY';
        $valueClaimed = $_POST['Claimed'];

        if (!mysql_query("UPDATE products SET Claimed = '$valueClaimed' WHERE Prod_ID = '$valuePID ")) {
        die('Error: ' . mysql_error());
        }
}


$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Claimed = 0 ORDER BY products.Pickup_Date ASC";


$productArray = mysql_query($productquery);

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
                <h1>Orders :: Sorted by Date</h1>
            </div>

            <ul class="actions">
                <li><a href="view.php" class="button special">Sort by Customer</a></li>
                <li><a href="claimed.php" class="button special">View Claimed</a></li>
                <li><a href="unclaimed.php" class="button special">View Unclaimed</a></li>

            </ul>
            
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

                    </div> <!-- end div row header -->

               

                <?php 
                    
                    while ($pRow =  mysql_fetch_array($productArray)) {
            
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

                            echo'<div class="cell">';
                            echo  $pRow[3];
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

                            echo '<div class="cell">';
                            
                            echo '<input type="radio" name="Claimed" value="1" />';
                            echo 'Claimed: ';
                            //echo $pRow[14];
                            echo '<a href="update_status.php?link='.  $pRow[0] . '">Update</a></h3>';
                            
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

        </form>

    </div>

</body>

</html>
