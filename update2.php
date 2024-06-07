<?php require_once("sql_connect.php")?>
<?php
    if ($_POST['location'] == "patient") {
        $sql = "UPDATE patient SET first_name='$_POST[first_name]', last_name='$_POST[last_name]', email='$_POST[email]', address_id='$_POST[address_id]' WHERE patient_id='$_POST[update_id]'";
        if ($conn->query($sql) === TRUE) {
                header("Location: patient.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else if ($_POST['location'] == "staff") {
        $sql = "UPDATE staff SET first_name='$_POST[first_name]', last_name='$_POST[last_name]', email='$_POST[email]', title='$_POST[title]', address_id='$_POST[address_id]' WHERE staff_id='$_POST[update_id]'";
        if ($conn->query($sql) === TRUE) {
                header("Location: staff.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>