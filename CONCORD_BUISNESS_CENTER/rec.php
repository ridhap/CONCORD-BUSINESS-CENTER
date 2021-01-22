<!-- I'm using bootstrap for the tables -->

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
$custID = $_SESSION['lastCustID'];
/*echo "I'd like {$custID} waffles";*/

$recordquery = "SELECT Prod_ID, Prod_Name, Prod_Desc, Design_Price, Quantity, Total_Price FROM products WHERE Cust_ID LIKE '$custID' ";
$pricequery = "SELECT Total_Price FROM products WHERE Cust_ID LIKE '$custID' ";
$custquery = "SELECT Cust_FName, Cust_LName, Cust_Num, Cust_Email FROM customer WHERE Cust_ID LIKE '$custID'";
/*
if (!mysql_query($recordquery)) {
	die('Error: ' . mysql_error());
}*/

$records = mysqli_query($link,$recordquery);
$prices = mysqli_query($link,$pricequery);
$cust = mysqli_query($link,$custquery);

$sum = 0;

while($row = mysqli_fetch_array($prices)) {
    $sum = $sum + $row[0];

}

/*while($row = mysql_fetch_array($records)) {
    echo $row[0];
    echo " ";
    echo $row[1];
    echo " ";
    echo $row[2];
    echo " ";
    echo $row[3];

}*/



?>



<html lang="en">
<head>
  <title>Official Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<link rel="stylesheet" href="assets/receiptsheet.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right"><?php echo "#".$custID; ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Services By:</strong><br>
    					CBC Prints <br>
    					Gorordo Ave.,<br>
    					Lahug, Cebu City 6000
    				</address>
    			</div>
    			
    		</div>

    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Purchase By:</strong><br>
    				<?php 
    					$custInfo = mysqli_fetch_array($cust);
    					echo $custInfo[0]." ".$custInfo[1]."<br>";
    					echo $custInfo[2]."<br>";
    					echo $custInfo[3]."<br>";
    				?>
    				
    				</address>
    			</div>
    			
    		</div>
    		
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order Summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>

                                <tr>
        							<td><strong>ID</strong></td>
        							<td class="text-center"><strong>Product</strong></td>
        							<td class="text-center"><strong>Description</strong></td>
        							<td class="text-center"><strong>Design Cost</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Subtotal</strong></td>

                                </tr>
    						</thead>
    						<tbody>

    							<!-- foreach ($order->lineItems as $line) or some such thing here -->


    							<?php while ($order = mysqli_fetch_array($records)) { ?>

    							<tr>
        							<td><?php echo $order[0]; ?></td>
    								<td class="text-center"><?php echo $order[1]; ?></td>
    								<td class="text-center"><?php echo $order[2]; ?></td>
    								<td class="text-center"><?php echo $order[3]; ?></td>
    								<td class="text-center"><?php echo $order[4]; ?></td>
    								<td class="text-right"><?php echo $order[5]; ?></td>
    							</tr>

    							<?php } ?>
    							
    							
                                <!-- <tr>
        							<td>BS-400</td>
    								<td class="text-center">$20.00</td>
    								<td class="text-center">3</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$60.00</td>
    							</tr>
                                <tr>
            						<td>BS-1000</td>
    								<td class="text-center">$600.00</td>
    								<td class="text-center">1</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$600.00</td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$670.99</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$15</td>
    							</tr>
    							-->

    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right"><?php echo "{$sum}"?></td>
    							</tr>

    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<div class="container">
	<footer id="footer">
	<h1> This is an official receipt. No refunds are allowed.</h1>
	<br>
	<a href="main.php"> HOME </a>
    <a href="view.php"> ORDERS </a>
	</footer>
</div>

</body>
</html>