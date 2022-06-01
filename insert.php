<?php
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    echo "No data submitted";
    exit;
}

include "env.php";

// Insert the document into the database's collection
$result = $collection->insertOne([
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'response-required' => $_POST['response-required'] ?? "off",
    'question' => $_POST['question'],
]);

// Get the _id that MongoDB automatically created
$id = $result->getInsertedId();
if (!$id) {
    echo "Something went wrong";
    exit;
}
?>

<h1>Thanks for your feedback, <?php echo htmlentities($_POST['name']) ?></h1>
<p>Your unique ticket ID is: <?php echo (string)$id; ?></p>
<p>Thanks for your help!</p>