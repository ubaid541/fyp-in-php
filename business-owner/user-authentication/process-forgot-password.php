<?php
include "../includes/header.php";
include "../config/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';
//require '../../vendor/phpmailer/phpmailer/src/SMTP.php';




function send_pass_reset($name, $get_email, $tokan)
{

    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ubaidawan633@gmail.com';                     //SMTP username
    $mail->Password   = 'Ubaidawan2000';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ubaidawan633@gmail.com', $name);
    $mail->addAddress($get_email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset password link';
    $email_template = "
                        <h2>Hello</h2>
                        <h3>Click on the link to reset your passsword.</h3> <br><br>
                        <a href='http://localhost/fatafut-mangwaen/business-owner/password-change.php?tokan=$tokan&email=$get_email'>Click me</a>";
    $mail->Body    = $email_template;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
}

if (isset($_POST['forgotPass'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $tokan = md5(rand());

    if (empty($_POST['email']) || empty($_POST['role'])) {
        $_SESSION['error'] = "All fields must be filled.";
        header("location: {$hostname}forgot-password.php");
    } else {
        // check if email is valid 
        if ($role == 0) {
            $sql = "SELECT * from user where email = '$email' limit 1";
            $query = mysqli_query($conn, $sql);
            $res = mysqli_num_rows($query);
            if ($res > 0) {
                $row = mysqli_fetch_assoc($query);
                $name = $row['username'];
                $get_email = $row['email'];

                // insert tokan into db
                $update_tokan = "UPDATE user set tokan = '$tokan' where email = '$get_email' limit 1";
                $update_tokan_run = mysqli_query($conn, $update_tokan);
                if ($update_tokan_run) {
                    send_pass_reset($name, $get_email, $tokan);
                    $_SESSION['status'] = "A password reset link sent to '$get_email'.";
                    header("location: {$hostname}forgot-password.php");
                } else {
                    $_SESSION['error'] = "Something went wrong while generating tokan.";
                    header("location: {$hostname}forgot-password.php");
                }
            } else {
                $_SESSION['error'] = "Kindly enter a valid email.";
                header("location: {$hostname}forgot-password.php");
            }
        } else if ($role == 1) {
            $sql = "SELECT * from business where email = '$email' limit 1";
            $query = mysqli_query($conn, $sql);
            $res = mysqli_num_rows($query);
            if ($res > 0) {
                $row = mysqli_fetch_assoc($query);
                $name = $row['username'];
                $get_email = $row['email'];

                // insert tokan into db
                $update_tokan = "UPDATE business set tokan = '$tokan' where email = '$get_email' limit 1";
                $update_tokan_run = mysqli_query($conn, $update_tokan);
                if ($update_tokan_run) {
                    send_pass_reset($name, $get_email, $tokan);
                    $_SESSION['status'] = "A password reset link sent to '$get_email'.";
                    header("location: {$hostname}forgot-password.php");
                } else {
                    $_SESSION['error'] = "Something went wrong while generating tokan.";
                    header("location: {$hostname}forgot-password.php");
                }
            } else {
                $_SESSION['error'] = "Kindly enter a valid email.";
                header("location: {$hostname}forgot-password.php");
            }
        }
    }
}
