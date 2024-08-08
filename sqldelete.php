<?php

include 'db_conn.php';

if(isset($_GET['id'])){

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_GET['id']);

    $query = "DELETE FROM users WHERE id=$id";

    $result = mysqli_query($conn,$query);

    if ($result === TRUE) 
    {
        //echo "User inserted successfully.";
        header("location: read.php?success=Successfully Deleted");

    } 
    else 
    {

        header("Location: read.php?error=Error: " . $conn->error);
        exit();

    }
}
else
{

    header("location: read.php");
    
}
?>