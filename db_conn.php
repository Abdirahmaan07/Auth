<?php 

//1.Host 2.user 3.password 4.database

$conn= new mysqli("localhost","root","","my_dbuser");

if($conn->connect_error){
    echo $conn->connect_error;
}else{
    //echo "success";
}

?>