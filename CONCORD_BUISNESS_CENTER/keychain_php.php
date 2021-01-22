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
// Basically we retrieve the Cust_ID of the current customer
    // DO NOT CHANGE
$custID = $_SESSION['lastCustID'];

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//$ext = $imageFileType['extension'];
$ext = pathinfo($target_file,PATHINFO_EXTENSION);
$newname = $_POST['Prod_Design'].".".$ext; 
/*echo $newname;*/
$target_file = 'img/'.$newname;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


// We retrieve the input values from the previous page, and store it to temporary variables.
// What you put inside $_POST[''] is the variable name corresponding with the <input name = ""> in the previous page.
    //TO BE CHANGED
        // Please change this accordingly, for the following represents the unique variables for each product.
$valueType = $_POST['Type'];
$valueShape = $_POST['Shape'];

// Default properties for each product
$valueDesc = $_POST['Prod_Desc'];
$valueDesign = $_POST['Prod_Design'].".".$ext;
$valuePrice = $_POST['Design_Price'];
$valueDate = $_POST['Pickup_Date'];
$valueQuantity = $_POST['Quantity'];

// Specify the name of the product
    // TO BE CHANGED
$valueName = "Keychain";

// Make a query. Specify the table column firsts, and then the php $variables that we just made, above
    // TO BE CHANGED
        // Please update the unique variables.

$sql = "INSERT INTO products (Prod_Name, Prod_Desc, Prod_Design, Design_Price, Pickup_Date, Quantity, Cust_ID, Type, Shape) VALUES ('$valueName', '$valueDesc', '$valueDesign', '$valuePrice', '$valueDate', '$valueQuantity', '$custID', '$valueType', '$valueShape')";


// Execute the query. This if statement is not necessary, but it acts like a try/catch function.
if (!mysqli_query($link,$sql)) {
	die('Error: ' . mysqli_error($link));
}

// Make a query updating the total price.
$sql2 = "UPDATE products SET Total_Price = Design_Price * Quantity";

// Execute the second query.
if (!mysqli_query($link,$sql2)) {
    die('Error: ' . mysqli_error($link));


}

/*echo "I'd like {$numbersss} waffles";*/


// Close the mysqli connection. This is really important.
mysqli_close($link);
?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Basic Form</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">

</head>

 
	<header>
		<h1>CBC Prints  | Add Order</h1>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>



    <div class="main-content">

        <form class="form-basic" method="post" >
            <div class="form-title-row">
                <h1>Confirmation</h1>
            </div>

            <div class="success">
                Order successfully added.
            </div>


            <!-- <div class="form-row">
                <button type="submit" formaction="login.php">Finish</button>
            </div>

            <div class="form-row">
                <button type="submit" formaction="main.php">Continue</button>
            </div> -->

            <ul class="actions">
                    <li><a href="rec.php" class="button special">Finish</a></li>
                    <li><a href="order_info.php" class="button special">Add</a></li>
            </ul>

        </form>

    </div>

</body>

</html>