<?php
require 'db_connect.php';
require 'session_validation.php';
require 'role_check.php';

$sql = "SELECT * FROM student_detail";
$result = $conn->query($sql);

echo "<table style='border: 1px solid black; width: 100%;'>";
echo "<tr><th>ID</th><th>Name</th><th>Grade</th>";

// If the user is an admin, they can delete and update records
if ($_SESSION['role'] == 'admin') {
    echo "<th>Actions</th>";
}

echo "</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["grade"] . "</td>";

        if ($_SESSION['role'] == 'admin') {
            echo "<td>";
            echo "<a href='update.php?id=" . $row["id"] . "'>Update</a> | ";
            echo "<a href='delete.php?id=" . $row["id"] . "'>Delete</a>";
            echo "</td>";
        }

        echo "</tr>";
    }
} else {
    echo "0 results";
}
echo "</table>";
?>
