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
    <?php
        if ($_POST['location'] == "patient") {
            $sql_patient_query = $conn->query("SELECT first_name, last_name, address_name, email, address.address_id FROM patient JOIN address ON address.address_id = patient.address_id WHERE patient_id = $_POST[update_id]");
            if (!$sql_patient_query) {
                echo "Error: ". $conn->error;
            } else {
                if ($sql_patient_query->num_rows > 0) {
                    $rows = $sql_patient_query->fetch_all(MYSQLI_ASSOC);
                }
            }
        } else if ($_POST['location'] == "staff") {
            $sql_staff_query = $conn->query("SELECT title, first_name, last_name, email, address_id FROM staff WHERE staff_id = $_POST[update_id]");
            if (!$sql_staff_query) {
                echo "Error: ". $conn->error;
            } else {
                if ($sql_staff_query->num_rows > 0) {
                    $rows = $sql_staff_query->fetch_all(MYSQLI_ASSOC);
                }
            }
        }

        ?>


        <div class="table-wrapper"><form action="update2.php" method="post">

		<input type="hidden" name="update_id" value="<?php echo $_POST['update_id']?>"><br>
		<input type="hidden" name="location" value="<?php echo $_POST['location']?>"><br>

		<input type="text" name="first_name" placeholder="First name" value="<?php echo $rows[0]['first_name']?>"><br>

		<input type="text" name="last_name" placeholder="Last name" value="<?php echo $rows[0]['last_name']?>"><br>

		<input type="text" name="email" placeholder="Email" value="<?php echo $rows[0]['email']?>"><br>

        <?php if ($_POST['location'] == "staff") { ?>
            <select name="title">
                <option value="-1">Title</option>
                <option value="Doctor">Doctor</option>
                <option value="Nurse">Nurse</option>
                <option value="Janitor">Janitor</option>
            </select>
        <?php } ?>

		<select name="address_id" id="address_name_id">
                <option value="-1">Address</option>
                <?php
                $address_list_sql = "SELECT address_id, address_name FROM `address`";
                $address_list_result = $conn->query($address_list_sql);

                if ($address_list_result->num_rows > 0) {
                    while ($address_list_row = $address_list_result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $address_list_row['address_id']?>" <?php if ($address_list_row['address_id'] == $rows[0]['address_id']) {echo "selected";}?>>
                            <?php echo $address_list_row['address_name']?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>

		<input type="submit" name="submit" value="Update">
	</form></div>

	<?php require_once("footer.php")?>
</body>
</html>