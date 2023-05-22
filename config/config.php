<?php
$config = parse_ini_file('/var/www/config.ini'); // Read database configuration from an external file
$db = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);

// Check for errors in database connection
if ($db->connect_errno) {
    die("Connection failed: " . $db->connect_error);
}

?>
