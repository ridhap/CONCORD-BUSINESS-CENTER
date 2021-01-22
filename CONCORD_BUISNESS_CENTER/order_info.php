<!DOCTYPE html>
<html>

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
		<h1>CBC Prints  | Add Order</h1>
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
