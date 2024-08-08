<?php 
include 'dbconn.php'; 

session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token']; 
    $verify_query = "SELECT verify_token, verify_status FROM register_php WHERE verify_token = '$token' LIMIT 1";


    $result_verify_query = mysqli_query($conn, $verify_query); 

    if (mysqli_num_rows($result_verify_query) > 0) {

        $row = mysqli_fetch_array($result_verify_query);

        if ($row['verify_status'] == "0") { 

            $clicked_toked = $row['verify_token']; 
            $update_query = "UPDATE register_php SET verify_status = '1' WHERE verify_token = '$clicked_toked' LIMIT 1";
            
            $result_update_query = mysqli_query($conn, $update_query); 

            if ($result_update_query) { 
                
                $_SESSION['status'] = "Your Account has been verified Successfully.!"; 
                header("Location: login.php"); 
                exit(0); 
            } else {

                $_SESSION['status'] = "Verification Failed.!"; 
                header("Location: login.php"); 
                exit(0); 
            }
        } else { 
            
            $_SESSION['status'] = "Email Already Verified. Please Login"; 
            header("Location: login.php");
            exit(0); 
        }
    } else {
        $_SESSION['status'] = "This Token does not Exists"; 
        header("Location: login.php");
    }
} else { 
    $_SESSION['status'] = "Not Allowed"; 
    header("Location: login.php"); 
} 
?>
