<?php
session_start(); 

include 'dbconn.php'; 

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'vendor/autoload.php';


function sendemail_verify($name, $email, $verify_token) {
    $mail = new PHPMailer(true); 

    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true; 
    $mail->Username = 'abdirahmanibrahim2003@gmail.com'; 
    $mail->Password = 'mqtnsvyzxsvpqphb'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port = 587; 

    $mail->setFrom('abdirahmanibrahim2003@gmail.com', $name); 
    $mail->addAddress($email); 

    $mail->isHTML(true); 
    $mail->Subject = 'Email verification from Huud Technology'; 
    $mail->Body    = "
    <h2>You have Registered with Huud Technology</h2>
    <h5>Verify your email address to login with the below given link</h5>
    <br /><br />
    <a href='http://localhost/Register-Login-With-Verification/verify-email.php?token=$verify_token'>Click Me</a>
    "; 

    $mail->send(); 
    //echo 'Message has been sent'; 
} 

if(isset($_POST['register_now'])) { 

    function validate($date) {
        $date = trim($date); 
        $date = stripslashes($date); 
        $date = htmlspecialchars($date); 
        return $date;
    }

    
    $name = validate($_POST['name']);
    $phone_number = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $confirm_password = validate($_POST['confirm_password']);
    $verify_token = md5(rand()); 

    
    if(empty($name)) {

        $_SESSION['status'] = "Name is required";
        header("location: register.php");
        exit();

    } else if(empty($phone_number)) {

        $_SESSION['status'] = "Phone Number is required";
        header("location: register.php");
        exit();

    } else if(empty($email)) {

        $_SESSION['status'] = "Email Address is required";
        header("location: register.php");
        exit();

    } else if(empty($password)) {

        $_SESSION['status'] = "Password is required";
        header("location: register.php");
        exit();

    } else if(empty($confirm_password)) {

        $_SESSION['status'] = "Confirm Password is required";
        header("location: register.php");
        exit();

    }
     
    
    $check_email_query = "SELECT email FROM register_php WHERE email = '$email'";
    $result_check_email = mysqli_query($conn, $check_email_query);
    if(mysqli_num_rows($result_check_email) > 0) {

        $_SESSION['status'] = "Email address already Exists";
        header("location: register.php");
        exit();
    }

    $check_phone_query = "SELECT phone FROM register_php WHERE phone = '$phone_number'";
    $result_phone_email = mysqli_query($conn, $check_phone_query);
    if(mysqli_num_rows($result_phone_email) > 0) {

        $_SESSION['status'] = "Phone Number already Exists";
        header("location: register.php");
        exit();
    } else {

        if($password === $confirm_password) {

            $query = "INSERT INTO register_php(name, phone, email, password, confirm_password, verify_token) 
                      VALUES ('$name', '$phone_number', '$email', '$password', '$confirm_password', '$verify_token')";
            $result_query = mysqli_query($conn, $query);
            
            if($result_query) {

                sendemail_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Registration Successful! Please verify your Email Address.";
                header("Location: register.php");
                exit();
            } else {

                $_SESSION['status'] = "Registration Failed";
                header("Location: register.php");
                exit();
            }
        } else {
            
            $_SESSION['status'] = "Passwords don't match";
            header("Location: register.php");
            exit();
        }
    }
}
?>
