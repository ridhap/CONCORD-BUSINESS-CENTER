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
    <link rel="stylesheet" href="assets/form-search.css">
    <link rel="stylesheet" href="assets/style.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

</head>

	<header>
		<h1>CBC Prints  |  Search </h1>
		<a href="view.php">View Orders</a>
		<a href="main.php">Home</a>
	</header>

	<div class="main-content">

        <!-- You only need this form and the form-search.css -->
        <?php 

        if (isset($_GET['search'])) {
        	echo '<form class="form-search" method="get" action="searchcust.php">';
            // echo '<input type="text" name="search" placeholder="'. $_GET['search']. '">';
            echo '<input type="text" name="search" value="'. htmlspecialchars($_GET['search']) . '">';
            echo '<button type="submit">Search</button>';
            echo '<i class="fa fa-search"></i>';
        	echo '</form>';

        	echo '<form class="form-basic" method="post" action="#">';
        	echo '<div class="form-title-row">
        	        <h1> Search Results: '.$_GET['search']. ' </h1>
        	      </div>';

        	

        	$valueSearch = $_GET['search'];

        	echo '<div class="wrapper">';

        	while ($cRow =  mysqli_fetch_array($custArray)) {


        	$orderquery = "SELECT products.*, customer.Cust_FName, customer.Cust_LName FROM products INNER JOIN customer ON products.Cust_ID = customer.Cust_ID WHERE (customer.Cust_FName LIKE '$valueSearch' OR customer.Cust_LName LIKE '$valueSearch' OR products.Prod_Name LIKE '$valueSearch') AND products.Cust_ID = '$cRow[0]' ORDER BY products.Pickup_Date ASC";

        	$orderArray = mysqli_query($link,$orderquery)  or trigger_error(mysqli_error($link));;

        	if (mysqli_num_rows($orderArray) == 0) {

		        // echo '<h3>'.$cRow[1].' '. $cRow[2].' | '.$cRow[3].' | '.$cRow[4].' | <a href="receipt.php?link='.  $cRow[0] . '">Receipt</a></h3>';


          	} else {
                
		        echo '<h3>'.$cRow[1].' '. $cRow[2].' | '.$cRow[3].' | '.$cRow[4].' | <a href="receipt.php?link='.  $cRow[0] .  '">Receipt</a> '. ' | <a href="update_customer.php?CID='.  $cRow[0] .  '">Update</a>'. ' | <a href="deleteCust.php?CID='.  $cRow[0] .  '">Delete</a></h3>';
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

                } // end inner while

                echo '</div>'; // end div table

                //echo '<hr>';
            }// end else


        	} // end while


        	echo '</div>'; 
        	echo '</form>';

        } else {
        	echo '<form class="form-search" method="get" action="searchcust.php">';
            echo '<input type="text" name="search" placeholder="Search a keyword">';
            echo '<button type="submit">Search</button>';
            echo '<i class="fa fa-search"></i>';
        	echo '</form>';
        }

        ?>

        

    </div>



</html>