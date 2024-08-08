<?php
session_start(); 
include('dbconn.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 


function send_password_reset($get_name, $get_email, $token) {
    $mail = new PHPMailer(true);
   
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true; 
    $mail->Username = 'abdirahmanibrahim2003@gmail.com'; 
    $mail->Password = 'mqtnsvyzxsvpqphb'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port = 587; 

    $mail->setFrom('abdirahmanibrahim2003@gmail.com', $get_name); 
    $mail->addAddress($get_email); 

    $mail->isHTML(true); 
    $mail->Subject = 'Password Reset Requested'; 
    $mail->Body    = "
    <h2>Hi $get_name,</h2>
    <p>We received a request to reset your password for your account on [Huud Technology]. If you did not make this request, please ignore this email.</p>
    <p>To reset your password, click the link below:</p>
    <p><a href='http://localhost/Register-Login-With-Verification/password-change.php?token=$token&email=$get_email'>Reset Password</a></p>
    <p>If you have any questions or need further assistance, feel free to contact our support team.</p>
    <br />
    <p>Thank you,</p>
    <p>[Huud Technology] Team</p>
    ";

    $mail->send(); 
}


if (isset($_POST['password_reset_link'])) {
   
    function validate($data) {
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data;
    }

    $email = validate($_POST['email_reset_password']); 
    $token = md5(rand()); 

   
    $check_email = "SELECT email FROM register_php WHERE email = '$email' LIMIT 1";
    $result_check_email = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
        
        $row = mysqli_fetch_array($result_check_email);
        $get_name = $row['name'];
        $get_email = $row['email'];

       
        $update_token = "UPDATE register_php SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $result_update_token = mysqli_query($conn, $update_token);

        if ($result_update_token) {
            send_password_reset($get_name, $get_email, $token);
            
            $_SESSION['status'] = "We e-mailed you a password reset link";
            header("Location: password-reset.php"); 
            exit(0);
        } else {

            $_SESSION['status'] = "Something went wrong. #1"; 
            header("Location: password-reset.php"); 
            exit(0);
        }
    } else {

        $_SESSION['status'] = "No Email Found"; 
        header("Location: password-reset.php"); 
        exit(0);
    }
}

//update password

if (isset($_POST['password_update'])) {

    function validata($data) {
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data;
    }

    $email = validata($_POST['email']);
    $new_password = validata($_POST['new_password']);
    $confirm_password = validata($_POST['confirm_password']);
    $token = validata($_POST['password_token']);

    if (!empty($token)) {
        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            
            $check_token = "SELECT verify_token FROM register_php WHERE verify_token='$token' LIMIT 1";
            $result_check_token = mysqli_query($conn, $check_token);

            if (mysqli_num_rows($result_check_token) > 0) {
                if ($new_password === $confirm_password) {
                    
                    $update_password = "UPDATE register_php SET password ='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $result_update_password = mysqli_query($conn, $update_password);

                    if ($result_update_password) {
                        $new_token = md5(rand()); 
  
                        $update_to_new_token = "UPDATE register_php SET verify_token ='$new_token' WHERE verify_token='$token' LIMIT 1";
                        $result_update_to_new_token = mysqli_query($conn, $update_to_new_token);

                        $_SESSION['status'] = "New Password Successfully Updated."; 
                        header("Location: login.php"); 
                        exit(0);
                    } else {

                        $_SESSION['status'] = "Did not update password. Something went wrong."; 
                        header("Location: password-change.php?token=$token&email=$email"); 
                        exit(0);
                    }
                } else {

                    $_SESSION['status'] = "Password and Confirm Password does not match"; 
                    header("Location: password-change.php?token=$token&email=$email"); 
                    exit(0);
                }
            } else {

                $_SESSION['status'] = "Invalid Token"; 
                header("Location: password-change.php?token=$token&email=$email"); 
                exit(0);
            }
        } else {

            $_SESSION['status'] = "All Fields are Mandatory"; 
            header("Location: password-change.php?token=$token&email=$email"); 
            exit(0);
        }
    } else {

        $_SESSION['status'] = "No Token Available"; 
        header("Location: password-change.php"); 
        exit(0);
    }
}
?>
