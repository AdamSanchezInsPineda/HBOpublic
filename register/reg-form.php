<?php

include '../config/config.php';

// Validate input data
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$firstname = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address1 = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$address2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$hood = filter_input(INPUT_POST, 'hood', FILTER_SANITIZE_STRING);
$zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_NUMBER_INT);

// Prepare and execute the database query
$stmt = $db->prepare("INSERT INTO tusers (username, user_fname, user_lname, password, mail, address, address2, city, hood, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssss", $username, $firstname, $lastname, $password, $email, $address1, $address2, $city, $hood, $zip);

if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}

echo "Usuari registrat";
header("Location: ../login/");
$stmt->close();
$db->close();
?>

