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


//retrieve the product ID, store it in the variable, do not change
$valuePID = $_POST['PID'];


// TO BE CHANGED
// PLEASE change this to the unique properties per product

// If the type area is not empty, then update the tables.
    // Meaning naa siyay ganahan ichange sa type
if (!empty($_POST['Height'])) {

    // retrieve the product type and store it in a variable
    $valueHeight = $_POST['Height'];
    
    // make a query. specify the $variables that we just made above.
    // please just change the SET statement
    if (!mysqli_query($link,"UPDATE products SET Height = '$valueHeight' WHERE Prod_ID = '$valuePID' ")) {
        die('Error: ' . mysqli_error());
    }
}
if (!empty($_POST['Width'])) {

    // retrieve the product type and store it in a variable
    $valueWidth = $_POST['Width'];
    
    // make a query. specify the $variables that we just made above.
    // please just change the SET statement
    if (!mysqli_query($link,"UPDATE products SET Width = '$valueWidth' WHERE Prod_ID = '$valuePID' ")) {
        die('Error: ' . mysqli_error());
    }
}

// END TO BE CHANGED

// Default shimaroo, please dont change
if (!empty($_POST['Prod_Desc'])) {
    $valueDesc = $_POST['Prod_Desc'];
    
    if (!mysqli_query($link,"UPDATE products SET Prod_Desc = '$valueDesc' WHERE Prod_ID = '$valuePID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}

if (!empty($_POST['Prod_Design'])) {

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
    // // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
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

    
    $valueDes = $_POST['Prod_Design'] .".".$ext;
    
    if (!mysqli_query($link,"UPDATE products SET Prod_Design = '$valueDes' WHERE Prod_ID = '$valuePID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}

if (!empty($_POST['Design_Price'])) {
    $valueDesign = $_POST['Design_Price'];
    
    if (!mysqli_query($link,"UPDATE products SET Design_Price = '$valueDesign' WHERE Prod_ID = '$valuePID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}

if (!empty($_POST['Pickup_Date'])) {
    $valueDate = $_POST['Pickup_Date'];
    
    if (!mysqli_query($link,"UPDATE products SET Pickup_Date = '$valueDate' WHERE Prod_ID = '$valuePID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}


if (!empty($_POST['Quantity'])) {
    $valueQuantity = $_POST['Quantity'];
    
    if (!mysqli_query($link,"UPDATE products SET Quantity = '$valueQuantity' WHERE Prod_ID = '$valuePID' ")) {
        die('Error: ' . mysqli_error($link));
    }
}


// make a query to update the price, just in case
$sql2 = "UPDATE products SET Total_Price = Design_Price * Quantity";

// execute the query
if (!mysqli_query($link,$sql2)) {
    die('Error: ' . mysqli_error($link));
}

// close the connection, very important yo
mysqli_close($link);
?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Update</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">

</head>

 
	<header>
		<h1>CBC Prints  | Update Order</h1>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>



    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <!-- <form class="form-basic" method="post" action="order_info.php"> -->
        <form class="form-basic" method="post" >
            <div class="form-title-row">
                <h1>Confirmation</h1>
            </div>

            <div class="success">
                Order successfully updated.
            </div>


            <!-- <div class="form-row">
                <button type="submit" formaction="login.php">Finish</button>
            </div>

            <div class="form-row">
                <button type="submit" formaction="main.php">Continue</button>
            </div> -->

            <ul class="actions">
                    <li><a href="main.php" class="button special">Finish</a></li>

                    <li><a href="customer.php" class="button special">Add</a></li>
                    <li><a href="update.php" class="button special">Update</a></li>
            </ul>

        </form>

    </div>

</body>

</html>