<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hospital</title>
	<link rel="stylesheet" href="style.css?a=<?php echo time();?>">
</head>

<body>
	<?php require_once("header.php")?>
	<?php
		require_once("sql_connect.php");

		$sql_patient_query = $conn->query("SELECT patient_id, first_name, last_name, address_name, email FROM patient JOIN address ON address.address_id = patient.address_id ORDER BY patient_id");
		if ($sql_patient_query->num_rows > 0) {
			$rows = $sql_patient_query->fetch_all(MYSQLI_ASSOC);

			?>
			<div class="table-wrapper"><table><thead>
				<tr> 
					<th>ID</th>
					<th>First name</th>
					<th>Last name</th>
					<th>Address</th>
					<th>Email</th>
				</tr>
			<?php
			foreach ($rows as $row) {
				?><tr><?php
				foreach ($row as $data) {
					?><td><?php echo $data; ?></td><?php
				}
				?></tr><?php
			}
			?></thead></table></div><?php
		}
	?>
	<?php require_once("footer.php")?>
</body>
</html>