<?php

$conn = mysqli_connect("localhost","root","","php");
if($conn->connect_errno){
    echo "$conn->connect_errno";
}else {
    //echo "connection successfuly";
}

?>