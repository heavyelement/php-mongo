<table>
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>email</th>
        <th>phone</th>
        <th>response required</th>
        <th>question</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    <?php
    require "env.php";

    // Find all documents in the collection
    $tickets = $collection->find();

    // Loop through the tickets we just found and send them to the user
    foreach ($tickets as $ticket) {
        echo "<tr>
            <td>" . (string)$ticket->_id . "</td>
            <td>" . htmlentities($ticket->name) . "</td>
            <td>" . htmlentities($ticket->email) . "</td>
            <td>" . htmlentities($ticket->phone ?? "") . "</td>
            <td>" . htmlentities($ticket->{'response-required'}) . "</td>
            <td>" . htmlentities($ticket->question) . "</td>
            <td><form action='edit.php' method='GET'><input type='hidden' name='id' value=" . (string)$ticket->_id . "><button type='submit'>Edit</button></form></td>
            <td><form action='delete.php' method='GET'><input type='hidden' name='id' value=" . (string)$ticket->_id . "><button type='submit'>Delete</button></form></td>
            <td>";
    }
    ?>
</table>