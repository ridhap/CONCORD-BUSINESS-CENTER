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
if (isset($_GET['CID'])) {
    $valueCID = $_GET['CID'];
} else {
    //retrieve the product ID, store it in the variable
    $valueCID = $_POST['CID'];
}

$_SESSION['deleteID'] = $valueCID;

// echo "{$valueCID}";

$productquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Cust_ID = $valueCID";
$custquery = "SELECT customer.* FROM customer WHERE Cust_ID = $valueCID";
$deletecust= "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE products.Cust_ID = $valueCID";
$productArray = mysqli_query($link,$productquery);
$custArray = mysqli_query($link,$custquery);


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
        <h1>CONCORD BUISNESS CENTER</h1>
        <a href="view.php">Delete Order</a>
        <a href="main.php">Home</a>
        <a href="view.php">View Orders</a>
        <a href="searchcust.php">Search</a>
        
    </header>

    <!-- <ul>
        <li><a href="index.html">Something</a></li>
        <li><a href="form-register.html">Something</a></li>
        <li><a href="form-login.html" class="active">Something</a></li>
    </ul> -->


    <div class="main-content">

        <!-- You only need this form and the form-login.css -->

        <form class="form-basic" method="post" action="">


            <div class="form-title-row">
                <h1>Delete?</h1>
            </div>

            
            
            <div class="wrapper">


            <?php 

                while ($cRow =  mysqli_fetch_array($custArray)) {
                    echo '<h3>'.$cRow[1].' '. $cRow[2].' | '.$cRow[3].' | '.$cRow[4].' | <a href="receipt.php?link='.  $cRow[0] .  '">Receipt</a> </h3>';

                }
                echo '<div class="table">';

                    echo'<div class="row header">'; 

                    echo'<div class="cell">';
                    echo'ID';
                    echo'</div>';

                    echo'<div class="cell">';
                    echo'Name';
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

                    echo '</div>'; // end div row header

                    while ($oRow = mysqli_fetch_array($productArray)) {
                        echo'<div class="row">';

                            echo'<div class="cell">';
                            echo $oRow[0];
                            echo'</div>';

                            echo'<div class="cell">';
                            echo $oRow[16].' '.$oRow[17];
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

                            echo '<div class="cell">';
                            echo $oRow[6];
                            echo '</div>';

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

                        echo '</div>';
                    }

                echo '</div>';

            ?>
            

            </div> <!-- end div wrapper -->

            <ul class="actions">

                <li><a href="confirmCustomerDelete.php" class="button special">Confirm</a></li>
                <li><a href="delete.php" class="button special">Cancel</a></li>
            </ul>

        </form>

    </div>

</body>

</html>
