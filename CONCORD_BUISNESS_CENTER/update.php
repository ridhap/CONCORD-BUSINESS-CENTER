<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Update</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">

    <script>
        function redirect(src) {
            window.location = src
        }
    </script>

</head>


	<header>
		<h1>CBC Prints  | Update Order</h1>
        <a href="view.php">View Orders</a>
        <a href="main.php">Home</a>
    </header>



    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="#">

            <div class="form-title-row">
                <h1>Update Order :: Product Selection</h1>
                <h2>Please select which you would like to update.</h2>
               <!--  <h2>To check the Product ID, please the <a href="view.php">Orders Page</a></h2> -->
            </div>

            <!-- <div class="form-row"> -->

                <h5><a href="searchcust.php">Customer Info</a></h5>

            <!-- </div> -->

            <!-- <div class="form-row"> -->
                <h5><a href="update_order.php">Order Info</a></h5>


            <!-- </div> -->

            <!-- <div class="form-row"> -->
                <h5><a href="update_status.php">Order Status</a></h5>


            <!-- </div> -->




        </form>

    </div>

</body>

</html>
