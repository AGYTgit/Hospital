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

		$sql_patient_query = $conn->query("SELECT patient_id, first_name, last_name, address_name, email FROM patient JOIN address ON address.address_id = patient.address_id ORDER BY patient_id DESC LIMIT 5");
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
					<th>Update</th>
					<th>Delete</th>
				</tr>
			<?php
			foreach ($rows as $row) {
				?><tr class="<?php echo $row['patient_id'] . "-text"?>" style="display: table-row;"><?php
				foreach ($row as $data) {
					?><td><?php echo $data; ?></td><?php
				}
				?>
				<td class="update_td">
				<button onclick="updatePatient('<?php echo $row['patient_id']; ?>')" class="update">Update</button>
				</td>
				<td class="delete_td">
					<form action="delete.php" method="post" class="delete">
						<input type="hidden" name="delete_id" value="<?php echo $row['patient_id']?>">
						<input type="hidden" name="location" value="patient">
						<input type="submit" name="delete" value="Delete">
					</form>
				</td>
				</tr>


				<tr class="<?php echo $row['patient_id'] . "-input" ?>" style="display: none;"><?php
				foreach ($row as $data) {
					?><td><input type="text" value="<?php echo $data;?>"></td><?php
				}
				?>
				<td class="update_td">
					
				</td>
				<td class="delete_td">
					
				</td>
				</tr>
				<?php
			}
			?></thead></table></div><?php
		}
	?>

	<script>
		function updatePatient(patientId) {
			var textRow = document.getElementsByClassName(patientId + '-text');
			var inputRow = document.getElementsByClassName(patientId + '-input');

			if (textRow !== null) {
				textRow.style.display = 'none';
			}

			if (inputRow !== null) {
				inputRow.style.display = 'table-row';
			}
		}
	</script>
	<?php require_once("footer.php")?>
</body>
</html>