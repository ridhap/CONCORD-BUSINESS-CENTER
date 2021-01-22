<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Add Customer</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">

</head>

 
	<header>
		<h1>CBC Prints | Order Form</h1>
        <a href="searchcust.php">Search</a>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>

    

    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="addCustomerDB.php">

            <div class="form-title-row">
                <h1>Add Order :: Customer Information </h1>
            </div>

            <div class="form-row">
                <label>
                    <span>First Name</span>
                    <input required type="text" name="Cust_FName">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Last Name</span>
                    <input required type="text" name="Cust_LName">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Phone Number</span>
                    <input required type="number" name="Cust_Num">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Email Address</span>
                    <input required type="email" name="Cust_Email">
                </label>
            </div>


            <div class="form-row">
                <button type="submit">Continue</button>
            </div>

        </form>

    </div>

</body>

</html>