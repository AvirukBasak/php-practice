<?php

$RESPONSE = false;

$from = false;
$email = false;
$to = false;
$subject = false;
$message = false;

function is_valid_email($str)
{
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function evaluate_params()
{
    $flag = false;

    $from = isset($_POST['from']) ? trim($_POST['from']) : false;

    $email = isset($_POST['email']) ? trim($_POST['email']) : false;
    $email = is_valid_email($email) ? $email : false;

    $to = isset($_POST['to']) ? trim($_POST['to']) : false;
    $to = is_valid_email($to) ? $to : false;

    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : false;

    $message = isset($_POST['message']) ? trim($_POST['message']) : false;

    if (!$from) {
        $flag = true;
        $GLOBALS['from'] = 'Malformed From field';
    }
    if (!$email) {
        $flag = true;
        $GLOBALS['email'] = 'Malformed E-mail field';
    }
    if (!$to) {
        $flag = true;
        $GLOBALS['to'] = 'Malformed To field';
    }
    if (!$subject) {
        $flag = true;
        $GLOBAL['subject'] = 'Malformed Subject field';
    }
    if (!$message) {
        $flag = true;
        $GLOBALS['message'] = 'Malformed message';
    }
    if ($flag) return;
    $headers = array(
        'From' => "$from<$email>",
        'X-Mailer' => 'PHP/' . phpversion()
    );
    if (mail($to, $subject, $message, $headers)) {
        $GLOBALS['RESPONSE'] = 'Your e-mail was sent';
    } else {
        $GLOBALS['RESPONSE'] = 'An error occurred when sending your e-mail';
    }
}

if (!empty($_POST)) evaluate_params();

include_once 'form.php';
