<?php
include 'db_conn.php';

if (isset($_POST['create'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['user_name']);
    $phone_Mobile = validate($_POST['user_mobile']);
    $email = validate($_POST['user_email']);
    $user_data = 'user_name'.$name. '&user_mobile'.$phone_Mobile .'&user_email='.$email;
    if (empty($name)) {
        header("Location: dashboard.php?error=Name is required&$user_data");
        exit();

    } else if (empty($phone_Mobile)) {
        header("Location: dashboard.php?error=Phone Number is required&$user_data");
        exit();

    } else if (empty($email)) {
        header("Location: dashboard.php?error=Email is required&$user_data");
        exit();

    } else {
        if ($conn->connect_error) {
            header("Location: dashboard.php?error=Connection failed: " . $conn->connect_error);
            exit();
            
        }

    $phonequery = "SELECT * FROM users WHERE mobile='$phone_Mobile'";
    $phonequeryans = $conn->query($phonequery);

    if ($phonequeryans->num_rows > 0) {
        header("Location: dashboard.php?error=Phone number already exists");
        exit();
    }

    $emailquery = "SELECT * FROM users WHERE email='$email'";
    $emailqueryans = $conn->query($emailquery);
    if ($emailqueryans->num_rows > 0) {
        header("Location: dashboard.php?error=Email already exists");
        exit();
    } if (is_numeric($phone_Mobile)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){ 

    $query = "INSERT INTO users (name, mobile, email) VALUES ('$name', '$phone_Mobile', '$email')";
    $result = mysqli_query($conn, $query);
    
    if ($result === TRUE) {
        header("location: read.php?success=Successfully Created");

    } else {
        header("Location: dashboard.php?error=Error: " . $conn->error);
        exit();
    }
}else {
    header("Location: dashboard.php?error=Enter a valid Email");
    exit();

}
} else {
    header("Location: dashboard.php?error=Enter a valid number");
    exit();
}

    }
    
}
?>
