<?php
include "env.php";
if (!isset($_GET['id'])) {
    echo "That is not a valid id";
    exit;
}

// Find the document we want to modify
$document = $collection->findOne([
    '_id' => new MongoDB\BSON\ObjectID($_GET['id'])
]);

// Determine if the checkbox should be checked
$checked = "";
if ($document->{"response-required"} == "on") {
    $checked = "checked='checked'";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket</title>
</head>

<body>
    <h1>Submit Support Ticket</h1>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo (string)$document->_id ?>">
        <label>Name</label><br>
        <input name="name" value="<?php echo htmlentities($document->name) ?>" placeholder="Name" required><br>
        <label>Email</label><br>
        <input type="email" value="<?php echo htmlentities($document->email) ?>" name="email" placeholder="ted@example.com" required><br>
        <label>Phone</label><br>
        <input type="phone" value="<?php echo htmlentities($document->phone ?? "") ?>" name="phone" placeholder="Phone number" required><br>
        <label><input type="checkbox" name="response-required" <?php echo $checked; ?>> Does your issue require a response?</label>
        <br>
        <label>Your issue</label><br>
        <textarea name="question" placeholder="What's the issue you're experiencing?" required><?php echo htmlentities($document->question) ?></textarea><br>
        <button type="submit">Send</button>
    </form>
</body>

</html>