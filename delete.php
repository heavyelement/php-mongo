<?php
include "env.php";

if (!isset($_GET['id'])) {
    echo "No document specified for deletion";
    exit;
}

$_id = new MongoDB\BSON\ObjectID($_GET['id']);

if (!$_id) {
    echo "No valid id";
    exit;
}

// Delete the document that matched the $_id from our collection
$result = $collection->deleteOne(['_id' => $_id]);

if ($result->getDeletedCount() === 1) {
    // If we managed to delete successfully, we should redirect the user to read.php
    header("Location: /database/read.php");
    exit;
}

echo "Could not delete document";
exit;
