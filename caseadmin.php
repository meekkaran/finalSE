<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "crimes";
//Create connection
$conn = new mysqli($servername,$username,$password,$db);
//To Check For Connection
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM cases";
$result = mysqli_query($conn,$query);
if (!$result) {
    die("Query to show fields from table failed");
} 

$fields_num = mysqli_num_fields($result);

echo "<table border='1'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysqli_fetch_field($result);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";
// printing table rows
while($row = mysqli_fetch_row($result))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
     foreach($row as $cell)
        echo "<td>$cell</td>";

    echo "</tr>\n";
}
mysqli_free_result($result);
?>