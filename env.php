<?php
// Note that the two following lines are for illustrative purpose. You wouldn't want these two lines in production code.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Import MongoDB and all its dependencies
require "vendor/autoload.php";

// Establish our variables
$db_host = "lin-3652-8033.servers.linodedb.net";
$db_user = "linroot";
$db_pwd  = "xpKnwmJcDeQS3BNr";
$db_port = "27017";
$ssl_file = "cert.crt";

// Instantiate the MongoDB Client
$client = new MongoDB\Client("mongodb://${db_host}:${db_port}", [
    'username' => $db_user,
    'password' => $db_pwd,
    'ssl' => true,
    'sslCAFile' => $ssl_file,
    'sslAllowInvalidCertificates' => true
]);

$collection = $client->tickets->current;

// var_dump($client->listDatabases());
