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
	// die('Could not connect: ' . mysql_error());
}

$db_selected = mysqli_select_db($link,DB_NAME);

if (!$db_selected) {
     error_log("Database selection failed: " . mysqli_error($link));
    die('Internal server error');
	// die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
}

/*echo 'Connected Successfully';*/

$valueFName = $_POST['Cust_FName'];
$valueLName = $_POST['Cust_LName'];
$valueNum = $_POST['Cust_Num'];
$valueEmail = $_POST['Cust_Email'];


$sql = "INSERT INTO customer (Cust_FName, Cust_LName, Cust_Num, Cust_Email) VALUES ('$valueFName', '$valueLName', '$valueNum', '$valueEmail' ) ";

if (!mysqli_query($link,$sql)) {
	die('Error: ' . mysqli_error());
}

$ids = mysqli_insert_id($link);
/*echo "I'd like {$ids} waffles";*/

$_SESSION['lastCustID'] = $ids;

mysqli_close($link);
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basic Form</title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">

    <script>
        function redirect(src) {
            window.location = src
        }
    </script>

</head>


    <header>
        <h1>CBC Prints | Add Order</h1>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>



    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="#">

            <div class="form-title-row">
                <h1>Add Order :: Product Selection</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Products: </span>
                    <select name="dropdown" onchange = "redirect(this.value)">

                        <option value = "">Products</option>
                        <option value = "order_bagtag.php">Bag Tag</option>
                        <option value = "order_keychain.php">Key Chain</option>
                        <option value = "order_tarpaulin.php">Tarpaulin</option>
                        <option value = "order_shirt.php">Shirts</option>
                        <option value = "order_tumbler.php">Tumbler</option>
                    </select>
                </label>
            </div>



        </form>

    </div>

</body>

</html>
