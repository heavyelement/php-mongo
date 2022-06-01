<?php
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    echo "No data submitted";
    exit;
}

include "env.php";

$result = $collection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id'])], // This parameter is how we find the document we want to modify
    [
        '$set' => [ // The $set keyword tells Mongo to change the following fields
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'response-required' => $_POST['response-required'] ?? "off",
            'question' => $_POST['question'],
        ]
    ],
    [ // Do we want to insert the document if the search resturned no results?
        'upsert' => true
    ]
);

// Count how many documents were modified with the update
$count = $result->getModifiedCount();
if ($count == 0) { // If no documents were modified, we've got a problem
    echo "Something went wrong";
    exit;
}
?>

<h1>Thanks for your feedback, <?php echo htmlentities($_POST['name']) ?></h1>
<p>Your ticket was updated!</p>
<p>Thanks for your help!</p>