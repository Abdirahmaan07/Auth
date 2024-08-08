<?php
session_start();

include 'dbconn.php';


if (isset($_POST['login_now'])) {
    function validate($data_entry) {
        $data_entry = trim($data_entry);
        $data_entry = stripslashes($data_entry);
        $data_entry = htmlspecialchars($data_entry);

        return $data_entry;
    }
    
    $enter_email = validate($_POST['email_user']);
    $enter_password = validate($_POST['password']);

    if (!empty($enter_email) && !empty($enter_password)) {
        
        $login_query = "SELECT * FROM register_php WHERE email = '$enter_email' AND password = '$enter_password' LIMIT 1";
        $result_login_query = mysqli_query($conn, $login_query);

        if (mysqli_num_rows($result_login_query) > 0) {
            $row = mysqli_fetch_array($result_login_query);
                    
            if ($row['verify_status'] == "1") {

                if (isset($_POST['remember_me'])) {
                    
                    $_SESSION['new_email'] = $enter_email;
                    $_SESSION['new_password'] = $enter_password;

                    $encrypted_data = openssl_encrypt($enter_password, 'AES-128-CTR', $encryption_key, 0, '1234567890123456');
                   
                    setcookie('email_user', $enter_email, time() + (30 * 24 * 60 * 60), "/");
                    setcookie('password', $encrypted_data, time() + (30 * 24 * 60 * 60), "/");  
                
                } else {
                    unset($_SESSION['new_email']);
                    unset($_SESSION['new_password']);
                    setcookie('email_user', '', time() - 3600, "/");
                    setcookie('password', '', time() - 3600, "/");
                }
            
                
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['status'] = "You are Logged In Successfully.";
                
               
                header("Location: dashboard.php");
                exit(0);

            } else {
                $_SESSION['status'] = "Please verify your Email Address.";
                header("Location: login.php");
                exit(0);
            }

        } else {
            $_SESSION['status'] = "Invalid Email or Password.";
            header("Location: login.php");
            exit(0);
        }

    } else {
        $_SESSION['status'] = "All fields are Mandatory.";
        header("Location: login.php");
        exit(0);
    }
}
?>
