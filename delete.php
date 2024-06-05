<?php
require_once("sql_connect.php");

$delete_location = $_POST['location'];
$delete_id = $delete_location . "_id";
$id = $_POST['delete_id'];
$return_to = $delete_location . ".php";

$sql_delete_query = $conn->prepare("DELETE FROM $delete_location WHERE $delete_id = $id");
$sql_delete_query->execute();

if ($sql_delete_query->affected_rows > 0) {
    header("Location: $return_to");
    exit();
} else {
    echo "Error: ". $sql_delete_query->error;
}

$sql_delete_query->close();
$conn->close();
?>