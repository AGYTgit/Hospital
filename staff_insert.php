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
		<input type="text" name="first_name" placeholder="First name"><br>

		<input type="text" name="last_name" placeholder="Last name"><br>

		<input type="text" name="email" placeholder="Email"><br>

		<select name="title">
			<option value="-1">Title</option>
			<option value="Doctor">Doctor</option>
			<option value="Nurse">Nurse</option>
			<option value="Janitor">Janitor</option>
        </select>

		<select name="address_name" id="address_name_id">
                <option value="-1">Address</option>
                <?php
                $address_list_sql = "SELECT address_id, address_name FROM `address`";
                $address_list_result = $conn->query($address_list_sql);

                if ($address_list_result->num_rows > 0) {
                    while ($address_list_row = $address_list_result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $address_list_row['address_name']?>">
                            <?php echo $address_list_row['address_name']?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>

		<input type="submit" name="submit" value="Insert">
	</form></div>

	<?php
		if (isset($_POST['submit'])) {
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$title = $_POST['title'];
			$email = $_POST['email'];
			$address_name = $_POST['address_name'];
	
			$address_sql = "SELECT address_id FROM `address` WHERE `address_name` =?";
			$stmt = $conn->prepare($address_sql);
			$stmt->bind_param("s", $address_name);
			$stmt->execute();
			$address_result = $stmt->get_result();
	
			if ($address_result->num_rows > 0) {
				$address_row = $address_result->fetch_assoc();
				$address_id = $address_row['address_id'];
			} else {
				$err = 1;
			}
	
			if ($first_name == "" || $last_name == "" || $email == "" || $title == "" || $address_id == "") {
				$err = 2;
			} else {
				$sql = "INSERT INTO staff (first_name, last_name, title, email, address_id) VALUES ('$first_name', '$last_name', '$title', '$email', '$address_id')";
				$isInserted = $conn->query($sql);
				if ($isInserted) {
					header("Location: staff.php");
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