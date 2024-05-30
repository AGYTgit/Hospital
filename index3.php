<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hospital</title>
	<link rel="stylesheet" href="style.css?a=<?php echo time();?>">
</head>

<body>
	<?php require_once("header.php")?>
	<?php require_once("sql_connect.php")?>
		

	<div class="table-wrapper"><form method="post">
		<input type="text" id="first_name" name="first_name" placeholder="First name"><br>

		<input type="text" id="last_name" name="last_name" placeholder="Last name"><br>

		<!-- <input type="text" id="address" name="address" placeholder="Address"><br> -->

		<input type="text" id="email" name="email" placeholder="Email"><br>

		<input type="submit" name="submit" value="Insert">
	</form></div>

	<?php
		$err = 0;

		if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			
			$address_sql = "SELECT address_id FROM `address` WHERE `address_name` = '123 Main St'";
			$address_result = $conn->query($address_sql);

			if ($address_result->num_rows > 0) {
				$address_row = $address_result->fetch_assoc();
				$address_id = $address_row['address_id'];
			} else {
				$err = 1;
			}

            if ($first_name == "" || $last_name == "" || $email == "") {
                $err = 2;
            } else {
                $sql = "INSERT INTO patient (first_name, last_name, email, address_id) VALUES ('$first_name', '$last_name','$email', '$address_id')";
                $isInserted = $conn->query($sql);
                if ($isInserted) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
		}
	?>
	<?php require_once("footer.php")?>
</body>
</html>