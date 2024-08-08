<?php
include 'db_conn.php';

$query = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($conn,$query);
?>